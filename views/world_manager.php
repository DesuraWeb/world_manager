<?php defined('BASEPATH') or exit('No direct script access allowed'); 
include_once(module_dir_path('world_manager', 'config/config.php')); ?>
<?php init_head(); ?>
<style>
/* Styles CSS directement intégrés dans la vue */
.content {
    padding: 20px;
    font-family: Arial, sans-serif;
}

.panel_s {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 20px;
    margin-bottom: 20px;
}

.panel-body {
    padding: 15px;
}

.table {
    width: 100%;
    margin-bottom: 20px;
}

.table-bordered {
    border: 1px solid #ddd;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
    background-color: #f9f9f9;
}

.table td, .table th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #ddd;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Ajoutez d'autres styles personnalisés ici si nécessaire */
</style>
<div id="wrapper">
   <div class="content">
      <div class="panel_s">
         <div class="panel-body">
            <h1>Accounts List</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Domaine</th>
                            <th>Hostname</th>
                            <th>Mode</th>
                            <th>CPU</th>
                            <th>Mémoire (RAM)</th>
                            <th>Disque IO</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.planethoster.net/world-api/get-accounts',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "X-API-USER: " . API_USER,
        "X-API-KEY: " . API_KEY
      ),
    ));

    $response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);

if ($data && isset($data['world_accounts'])) {
    foreach ($data['world_accounts'] as $account) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($account['domain']) . "</td>";
        echo "<td>" . htmlspecialchars($account['hostname']) . "</td>";
        echo "<td>" . htmlspecialchars($account['status']) . "</td>";
        echo "<td>" . htmlspecialchars($account['ressources']['cpu']) . "</td>";
        echo "<td>" . htmlspecialchars($account['ressources']['mem']) . "</td>";
        echo "<td>" . htmlspecialchars($account['ressources']['io']) . "</td>";
        echo "<td><a href='lien_vers_modification/" . htmlspecialchars($account['id']) . "'>Modifier</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Failed to decode JSON or no accounts available.</td></tr>";
}
?>
    </tbody>
                </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>