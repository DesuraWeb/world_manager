<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">

<style>
    /* Existing styles... */
    body {
        font-family: 'Lato', sans-serif;
        color: #333;
    }
    .panel_s {
        background-color: #fff;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .panel-body {
        padding: 20px;
    }
    .form-control {
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 10px;
    }
    .btn-primary {
        background-color: #008255;
        border-color: #006644;
        color: #fff;
    }
    .btn-primary:hover {
        background-color: #006644;
    }
    h4 {
        margin-bottom: 20px;
    }

    /* Additional styles for the text blocks */
    .api-text-blocks {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .api-text-block {
        background: #f2f2f2;
        padding: 20px;
        border-radius: 4px;
        flex-basis: 48%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    @media (max-width: 768px) {
        .api-text-blocks {
            flex-direction: column;
        }
        .api-text-block {
            margin-bottom: 10px;
            flex-basis: auto;
        }
    }
</style>

<div id="wrapper">
    <div class="content">
        <!-- Text blocks added here -->
        <div class="api-text-blocks">
            <div class="api-text-block">
                <h4>API Domaine</h4>
                <p>Avec notre API de domaine, vous pouvez enregistrer, renouveler, transférer et gérer des noms de domaine pour vos clients...</p>
                <button class="btn btn-primary">Module WHMCS</button>
            </div>
            <div class="api-text-block">
                <h4>World API</h4>
                <p>Avec l'API d'hébergement Web World Unlimited, débloquez un monde infini de possibilités...</p>
                <button class="btn btn-primary">Ajouter des fonds</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><i class="fa fa-cog"></i> API Settings</h4>
                        <hr class="hr-panel-heading" />
                        <form action="<?php echo base_url('world_manager/update_api_settings'); ?>" method="post" id="apiSettingsForm">
                            <div class="form-group">
                                <label for="api_user">API User</label>
                                <input type="text" id="api_user" name="api_user" class="form-control" value="<?php echo $api_user; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="api_key">API Key</label>
                                <input type="text" id="api_key" name="api_key" class="form-control" value="<?php echo $api_key; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
