<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends AdminController {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->config('world_manager/config');
    }

    public function index() {
        $data['api_user'] = $this->config->item('api_user');
        $data['api_key'] = $this->config->item('api_key');
        $data['service_status'] = $this->check_service_status();
        if ($data['service_status']) {
            $data['account_info'] = $this->get_account_info();
        }
        $this->load->view('world_manager/settings', $data);
    }

    private function check_service_status() {

        $url = 'https://api.planethoster.net/reseller-api/test-connection';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'X-API-KEY: ' . $this->config->item('api_key'),
            'X-API-USER: ' . $this->config->item('api_user')
        ));
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        // Affichez temporairement la réponse brute pour le débogage
        var_dump($result);
        var_dump($httpCode);
        
        if ($httpCode == 200) {
            $response = json_decode($result, true);
            return !empty($response['successful_connection']);
        }
        return false;
    }

    private function get_account_info() {
        $url = 'https://api.planethoster.net/reseller-api/account-info';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'X-API-KEY: ' . $this->config->item('api_key'),
            'X-API-USER: ' . $this->config->item('api_user')
        ));
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200 && $result) {
            $response = json_decode($result, true);
            return $response;
        }
        return false;
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
