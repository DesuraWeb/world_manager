<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">API Settings</h4>
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
                            <button type="submit" class="btn btn-primary">Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
