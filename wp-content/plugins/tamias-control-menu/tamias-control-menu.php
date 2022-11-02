<?php
/*
Plugin Name: TAMIAS Control Menu
Plugin URI: http://tamias.co.jp/
Description: 管理画面変更
Version: 1.0
Author: Kazuhiro Ikeda
Author URI: http://tamias.co.jp/
*/


function remove_menus()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
    //remove_menu_page('edit.php?post_type=page');
    //remove_menu_page( 'plugins.php' );
    remove_menu_page('edit.php?post_type=acf-field-group');
}

add_action('admin_menu', 'remove_menus');

function add_page_to_admin_menu()
{
    //xxに固定ページIDを入れる
    //add_menu_page('固定ページ名', '固定ページ名', 'manage_options', 'post.php?post=xx&action=edit', '', '', 3);
}

add_action('admin_menu', 'add_page_to_admin_menu');

?>