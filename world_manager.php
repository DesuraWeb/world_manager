<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: World Manager
Description: Manage your world planet hoster hosting
Version: 1.0
Requires at least: 2.3.*
Author: Desura
Author URI: https://desura.fr
*/

hooks()->add_action('admin_init', 'world_manager_module_init');

function world_manager_module_init()
{
    $CI = &get_instance();
    $CI->app_menu->add_sidebar_menu_item('world_manager', [
        'name'     => 'World Manager', // Nom de votre module
        'href'     => admin_url('world_manager'), // Lien vers le contrôleur de votre module
        'position' => 6, // La position dans le menu
        'icon'     => 'fa fa-globe', // Icône (optionnel)
    ]);

    $CI->app_menu->add_sidebar_children_item('world_manager', [
        'slug'     => 'list_account', // ID/slug UNIQUE pour le sous-menu
        'name'     => 'List Account', // Le nom de l'élément de sous-menu
        'href'     => admin_url('world_manager/list_account'), // URL de l'élément de sous-menu
        'position' => 5, // La position dans le sous-menu
        'icon'     => 'fa fa-list', // Icône Font Awesome pour le sous-menu, corrigée
    ]);

    $CI->app_menu->add_sidebar_children_item('world_manager', [
        'slug'     => 'create_account', // ID/slug UNIQUE pour le sous-menu
        'name'     => 'Create Account', // Le nom de l'élément de sous-menu
        'href'     => admin_url('world_manager/create_account'), // URL de l'élément de sous-menu
        'position' => 10, // La position dans le sous-menu
        'icon'     => 'fa fa-plus', // Icône Font Awesome pour le sous-menu, corrigée
    ]);

    // Ajout de l'élément de menu "Settings"
    $CI->app_menu->add_sidebar_children_item('world_manager', [
        'slug'     => 'settings', // ID/slug UNIQUE pour le sous-menu
        'name'     => 'Settings', // Le nom de l'élément de sous-menu
        'href'     => admin_url('world_manager/settings'), // URL de l'élément de sous-menu
        'position' => 15, // La position dans le sous-menu
        'icon'     => 'fa fa-cogs', // Icône Font Awesome pour le sous-menu
    ]);
}
