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
    /* Style pour le titre de la page */
    .page-title {
        font-size: 32px; /* Taille de police pour le titre */
        margin-bottom: 20px; /* Espace en dessous du titre */
        color: #333; /* Couleur du texte */
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
    h3 {
        margin-bottom: 20px;
    }
    
    /* Additional styles for the text blocks */
    .api-text-blocks {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .api-text-block {
        background: #fff;
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
    
    /* Style for the service status indicator */
    .status-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
    }
    .status-indicator.operational {
        background-color: #28a745;
        box-shadow: 0 0 5px #28a745;
    }
    .status-indicator.non-operational {
        background-color: #dc3545;
        box-shadow: 0 0 5px #dc3545;
    }

    /* Ajuste la largeur de tous les éléments de formulaire */
.form-control {
    width: 100%; /* Ou une autre valeur selon le besoin */
}
</style>

<div id="wrapper">
    <div class="content">
        <div class="content">
        <!-- Titre de la page -->
        <h1 class="page-title">Paramètres</h1>
        <div class="api-text-blocks">
            <!-- Block 1: API Domain State and Account Info -->
            <div class="api-text-block">
                <h3>États des Services</h3>
                <?php if (isset($service_status) && $service_status): ?>
                    <span class="status-indicator operational"></span> Opérationnel
                    <!-- Account info display -->

                    <h3>Informations</h3>
                    <p>Crédit : <?php echo isset($account_info['account_credit']) ? $account_info['account_credit'] : 'N/A'; ?>€</p>
                    <p>Nombre de domaines actifs : <?php echo isset($account_info['active_domains']) ? $account_info['active_domains'] : 'N/A'; ?></p>
                    <p>Nombre de comptes actifs ou suspendus : <?php echo $nb_active_or_suspended_accounts; ?></p>
                <?php else: ?>
                    <span class="status-indicator non-operational"></span> Non opérationnel
                <?php endif; ?>
            </div>
            
            <div class="api-text-block">
                <h3>World API</h3>
                <p>Avec l'API d'hébergement Web World Unlimited, débloquez un monde infini de possibilités. Vous pouvez créer des comptes d'hébergement World à la volée, automatiser des tâches récurrentes, intégrer des hébergements dans votre propre panneau de contrôle et bien plus encore.</p>
            </br>
                <h3>Pré-requis</h3>
                <p>Il suffit d'autoriser l'adresse IP qui fera les demandes à l'API. Ensuite, récuperer l'UserKey et l'UserApi sur votre tableau de bord planethoster et collez les ici</p>
                <a href="https://apidoc.planethoster.com/fr/" class="btn btn-primary">Documentation</a>

            </div>
        </div>

        <!-- API Settings Form -->
        <div class="row">
    <div class="col-md-12">
        <div class="panel_s">
            <div class="panel-body">
                <h4 class="no-margin"><i class="fa fa-cog"></i> Paramètres API</h4>
                <hr class="hr-panel-heading" />
                <form action="<?php echo base_url('world_manager/update_api_settings'); ?>" method="post" id="apiSettingsForm">
                    <div class="form-group">
                        <label for="api_user">Utilisateur API</label>
                        <div class="input-group">
                            <input type="password" id="api_user" name="api_user" class="form-control" value="<?php echo $api_user; ?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary reveal" type="button" onclick="toggleVisibility('api_user');"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="api_key">Clé API</label>
                        <div class="input-group">
                            <input type="password" id="api_key" name="api_key" class="form-control" value="<?php echo $api_key; ?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary reveal" type="button" onclick="toggleVisibility('api_key');"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Mettre à jour les paramètres</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleVisibility(fieldId) {
        var input = document.getElementById(fieldId);
        var button = input.nextElementSibling.getElementsByTagName('button')[0];
        if (input.type === "password") {
            input.type = "text";
            button.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Change l'icône en œil barré
        } else {
            input.type = "password";
            button.innerHTML = '<i class="fa fa-eye"></i>'; // Rechange l'icône en œil
        }
    }
</script>


<?php init_tail(); ?>
