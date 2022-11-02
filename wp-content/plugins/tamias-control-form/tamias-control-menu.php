<?php
/*
Plugin Name: TAMIAS Control Form
Plugin URI: http://tamias.co.jp/
Description: 管理画面変更
Version: 1.0
Author: Kazuhiro Ikeda
Author URI: http://tamias.co.jp/
*/

//ダッシュボード
function remove_menus_form()
{
	remove_menu_page('edit.php?post_type=mw-wp-form');
}
add_action('admin_menu', 'remove_menus_form');


//お問い合わせデータのみ表示
// function remove_menus_form()
// {
// 	remove_submenu_page('edit.php?post_type=mw-wp-form', 'edit.php?post_type=mw-wp-form');	// MW WP Form (一覧)
// 	remove_submenu_page('edit.php?post_type=mw-wp-form', 'post-new.php?post_type=mw-wp-form');	// 新規作成
// 	remove_submenu_page('edit.php?post_type=mw-wp-form', 'mw-wp-form-chart'); // グラフ
// }
// add_action('admin_menu', 'remove_menus_form');