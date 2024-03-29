<?php defined('BASEPATH') or exit('No direct script access allowed'); 


class Create_account extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        // Charger le fichier de configuration spécifique au module
        // Assurez-vous que le chemin soit correct et corresponde à l'emplacement de votre fichier de configuration
        $this->load->config('world_manager/config');

        // Récupérer les éléments de configuration
        $api_user = $this->config->item('api_user');
        $api_key = $this->config->item('api_key');

        // Vous pouvez maintenant utiliser $api_user et $api_key dans vos méthodes
    }

    public function index()
    {
        $data = [];

        if ($this->input->post()) {
            // Appel à createaccount() et stockage du message de retour dans $data['message']
            $data['message'] = $this->createaccount();
        }

        // Chargement de la vue avec le tableau $data qui contient le message de retour
        $this->load->view('world_manager/create_account', $data);
    }

    private function createaccount()
    {
        $domain = $this->input->post('domain');
        $country = $this->input->post('country');
        $cpu = (int)$this->input->post('cpu');
        $mem = (int)$this->input->post('mem');
        $io = (int)$this->input->post('io');
        $ls = $this->input->post('ls') === 'on' ? true : false;

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.planethoster.net/world-api/create-account',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "domain" => $domain,
                "country" => $country,
                "cpu" => $cpu,
                "mem" => $mem,
                "io" => $io,
                "ls" => $ls
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-API-USER: ' . API_USER,
                'X-API-KEY: ' . API_KEY
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl); // Capture des erreurs cURL
        curl_close($curl);

        if (!$err) {
            $responseData = json_decode($response, true);
            if (isset($responseData['account_created']) && $responseData['account_created']) {
                return "Compte créé avec succès. Hostname: " . $responseData['server_hostname'] . 
                       ", IP: " . $responseData['server_ip'] . ", Username: " . $responseData['username'] .
                       ", Password: " . $responseData['password'];
            } else {
                return "Erreur lors de la création du compte.";
            }
        } else {
            return "Erreur cURL: " . $err;
        }
    }
}
