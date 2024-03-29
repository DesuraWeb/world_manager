<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends AdminController {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        // Assurez-vous que le fichier de configuration soit chargé ici si ce n'est pas déjà fait globalement
        $this->load->config('world_manager/config');
    }

    public function index() {
        $data['api_user'] = $this->config->item('api_user');
        $data['api_key'] = $this->config->item('api_key');
        $this->load->view('world_manager/settings', $data);
    }

    public function update_api_settings() {
    $apiUser = $this->input->post('api_user');
    $apiKey = $this->input->post('api_key');

    // Chemin vers le fichier de configuration
    $configFilePath = realpath(APPPATH . '../modules/world_manager/config/config.php');

    if ($configFilePath) {
        // Lecture du contenu actuel du fichier
        $configContent = file_get_contents($configFilePath);

        // Remplacement des lignes pour les clés API
        $configContent = preg_replace('/define\(\'API_USER\', \'[^\']+\'\);/', "define('API_USER', '{$apiUser}');", $configContent);
        $configContent = preg_replace('/define\(\'API_KEY\', \'[^\']+\'\);/', "define('API_KEY', '{$apiKey}');", $configContent);

        // Remplacement des lignes pour les clés API sous forme de tableau
        $configContent = preg_replace('/\$config\[\'api_user\'\] = \'[^\']+\'\;/', "\$config['api_user'] = '{$apiUser}';", $configContent);
        $configContent = preg_replace('/\$config\[\'api_key\'\] = \'[^\']+\'\;/', "\$config['api_key'] = '{$apiKey}';", $configContent);

        // Écriture dans le fichier de configuration
        if (file_put_contents($configFilePath, $configContent) === false) {
            $this->session->set_flashdata('error', 'Unable to write to the config file.');
        } else {
            $this->session->set_flashdata('success', 'Configuration updated successfully.');
        }
    } else {
        $this->session->set_flashdata('error', 'Config file not found.');
    }

    redirect('world_manager/settings');
}

}
