<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Modify Account Resources</h4>
                        <hr class="hr-panel-heading" />

                        <!-- Affichage des messages -->
                        <?php if (!empty($this->session->flashdata('message'))): ?>
                            <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
                        <?php endif; ?>

                        <!-- Formulaire de modification des ressources -->
                        <form action="<?= admin_url('world_manager/modify_resources_action'); ?>" method="post" id="modifyResourcesForm">
                            <input type="hidden" name="account_id" value="<?= $account_id; // Assurez-vous que cette variable est définie ?>">                            
                            <div class="form-group">
                                <label for="cpu">CPU:</label>
                                <input type="number" id="cpu" name="cpu" class="form-control" min="1" max="8" required value="<?= $cpu; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mem">Memory (Go):</label>
                                <input type="number" id="mem" name="mem" class="form-control" min="1" max="24" required value="<?= $mem; ?>">
                            </div>
                            <div class="form-group">
                                <label for="io">Disk I/O (I/O Mo/s):</label>
                                <input type="number" id="io" name="io" class="form-control" min="1" max="24" required value="<?= $io; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ls">LiteSpeed Server:</label>
                                <select id="ls" name="ls" class="form-control">
                                    <option value="true" <?= $ls ? 'selected' : ''; ?>>Yes</option>
                                    <option value="false" <?= !$ls ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
