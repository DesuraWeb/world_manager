<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modify_resources extends AdminController {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->config('world_manager/config'); // Assurez-vous que ce chemin est correct
    }

    public function index($accountId = null) {
        if (!$accountId) {
            show_404();
            return;
        }

        $accountDetails = $this->getAccountDetailsById($accountId);
        
        if (empty($accountDetails)) {
            show_404();
            return;
        }

        $data['accountDetails'] = $accountDetails;
        $this->load->view('world_manager/modify_resources', $data);
    }

    public function update_resources() {
        $accountId = $this->input->post('accountId');
        $cpu = $this->input->post('cpu');
        $mem = $this->input->post('mem');
        $io = $this->input->post('io');
        
        $updateStatus = $this->updateAccountResources($accountId, $cpu, $mem, $io);
        
        if ($updateStatus) {
            $this->session->set_flashdata('message', 'Ressources mises à jour avec succès.');
        } else {
            $this->session->set_flashdata('message', 'Erreur lors de la mise à jour des ressources.');
        }
        
        redirect('world_manager/view_account/'.$accountId);
    }

    private function getAccountDetailsById($accountId) {
    // Récupération des clés API depuis la configuration
    $apiUser = $this->config->item('api_user', 'world_manager');
    $apiKey = $this->config->item('api_key', 'world_manager');
    
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.planethoster.net/world-api/get-account?account_id=" . $accountId, // Ajustez cette URL
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            "X-API-USER: $apiUser",
            "X-API-KEY: $apiKey"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if (!$err) {
        $responseData = json_decode($response, true);
        // Assurez-vous que la structure de $responseData correspond à ce que vous attendez
        // et ajustez les clés d'accès aux données en conséquence
        if (isset($responseData['success']) && $responseData['success'] === true && isset($responseData['data'])) {
            return $responseData['data']; // Supposons que 'data' contient les détails du compte
        }
    }
    
    log_message('error', "Erreur lors de la récupération des détails du compte avec ID $accountId: " . $err);
    return null; // Retournez null si une erreur survient ou si les détails ne peuvent être récupérés
}


    private function updateAccountResources($accountId, $cpu, $mem, $io) {
        $apiUser = $this->config->item('api_user');
        $apiKey = $this->config->item('api_key');
        
        $postData = json_encode([
            "id" => $accountId,
            "cpu" => $cpu,
            "mem" => $mem,
            "io" => $io
        ]);

        $curl = curl_init('https://api.planethoster.net/world-api/modify-resources');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "X-API-USER: $apiUser",
            "X-API-KEY: $apiKey"
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', "cURL Error #: " . $err);
            return false;
        } else {
            $responseData = json_decode($response, true);
            // Assurez-vous que cette condition de succès correspond à la structure de la réponse de l'API
            return isset($responseData['success']) && $responseData['success'];
        }
    }
}
