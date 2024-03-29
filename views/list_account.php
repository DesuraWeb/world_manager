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
                            <th>Domain</th>
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
        echo "<td><button type='button' class='btn btn-default modify-resources-btn' data-id='".$account['id']."'>Modifier</button></td>";
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
<!-- Modal pour modifier les ressources -->
<div class="modal fade" id="modifyResourcesModal" tabindex="-1" role="dialog" aria-labelledby="modifyResourcesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyResourcesModalLabel">Modifier les Ressources</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Le contenu du formulaire sera chargé ici via AJAX -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="saveResourceChanges">Sauvegarder</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('.modify-resources-btn').click(function() {
    var accountId = $(this).data('id');
    $.ajax({
      url: '<?php echo admin_url("modify_resources/index/"); ?>' + accountId,
      type: 'GET',
      success: function(response) {
        $('#modifyResourcesModal .modal-body').html(response);
        $('#modifyResourcesModal').modal('show');
      }
    });
  });

  $('#saveResourceChanges').click(function() {
    // Ici, ajoutez le code pour soumettre les modifications.
    // Cela peut être une autre requête AJAX qui envoie les données modifiées au serveur.
  });
});
</script>
<?php init_tail(); ?>
</body>
</html>