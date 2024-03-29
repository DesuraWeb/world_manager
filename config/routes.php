<?php
$route['world_manager/create_account'] = 'create_account/index';
$route['world_manager/list_account'] = 'world_manager/list_account';
$route['world_manager/modify_resources/(:num)'] = 'world_manager/modify_resources/index/$1';
$route['world_manager/update_resources'] = 'world_manager/update_resources';
$route['world_manager/settings'] = 'settings/index';
$route['world_manager/update_api_settings'] = 'settings/update_api_settings';
