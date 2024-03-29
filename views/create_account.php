<?php defined('BASEPATH') or exit('No direct script access allowed'); 
include_once(module_dir_path('world_manager', 'config/config.php')); 
?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Create Account</h4>
                        <hr class="hr-panel-heading" />

                        <!-- Si un message existe, on l'affiche -->
                        <?php if (!empty($this->session->flashdata('message'))): ?>
                            <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
                        <?php endif; ?>

<form action="/index.php/world_manager/create_account" method="post" id="createAccountForm">
    <div class="form-group">
        <label for="domain">Domain:</label>
        <input type="text" id="domain" name="domain" class="form-control" required placeholder="exemple.com">
    </div>
    <div class="form-group">
        <label for="country">Country:</label>
        <select id="country" name="country" class="form-control" required>
            <option value="CA">Canada (CA)</option>
            <option value="FR" selected>France (FR)</option>
        </select>
    </div>
    <div class="form-group">
        <label for="cpu">CPU:</label>
        <input type="number" id="cpu" name="cpu" class="form-control" min="1" max="8" required value="1">
    </div>
    <div class="form-group">
        <label for="mem">Memory (Go):</label>
        <input type="number" id="mem" name="mem" class="form-control" min="1" max="24" required value="1">
    </div>
    <div class="form-group">
        <label for="io">E/S (I/O Mo/s):</label>
        <input type="number" id="io" name="io" class="form-control" min="1" max="24" required value="1">
    </div>
    <div class="form-group">
        <label for="ls">LiteSpeed Server:</label>
        <select id="ls" name="ls" class="form-control">
            <option value="true">Oui</option>
            <option value="false" selected>Non</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Create Account</button>
</form>

