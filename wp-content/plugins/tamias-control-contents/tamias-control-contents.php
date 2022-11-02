<?php
/*
Plugin Name: TAMIAS Control Contents
Plugin URI: http://tamias.co.jp/
Description: コンテンツ登録
Version: 1.0
Author: Kazuhiro Ikeda
Author URI: http://tamias.co.jp/
*/


//採用情報登録
function case_post_type()
{
    register_post_type('case', array(
        'labels'        => array('name' => '採用情報'),
        'public'        => true,
        'menu_position' => 6,
        //'hierarchical'  => true ,
        'supports'      => array('title'/*,'editor','custom-fields','thumbnail'*/),
        'can_export'    => true,
        'has_archive'   => true,
    ));

    register_taxonomy('genre', 'case', array(
        'labels'            => array('name' => '雇用形態'),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_nav_menus' => true,
    ));

    register_taxonomy('area', 'case', array(
        'labels'            => array('name' => '地域'),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_nav_menus' => true,
    ));
}
add_action('init', 'case_post_type', 1);


// カスタム投稿の追加
function add_post_type()
{
    // 新着情報
    register_post_type(
        'news',
        array(
            'label'         => '新着情報',
            'public'         => true,
            'menu_position' => 5,
            'has_archive'     => true,
            'supports'         => array('editor', 'title', 'author', 'thumbnail')
        )
    );

    // 新着情報カテゴリー
    register_taxonomy(
        'news_category',
        'news',
        array(
            'label'         => '新着情報カテゴリー',
            'hierarchical'     => true,
            'rewrite'         => true
        )
    );
}

add_action('init', 'add_post_type');