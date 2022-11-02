<?php

//ダッシュボードの不要な項目削除
add_action( 'wp_dashboard_setup', function () {
	$tmp = [
		//'wp_welcome_panel',//WordPressへようこそ！
		//'dashboard_activity',//アクティビティ
		//'dashboard_recent_comments',//最近のコメント
		//'dashboard_incoming_links',//被リンク
		//'dashboard_plugins',//プラグイン
		//'dashboard_quick_press',//クイック投稿
		//'dashboard_recent_drafts',//最近の下書き
		//'dashboard_primary',//WordPressブログ
		//'dashboard_secondary',//WordPressフォーラム
		'dashboard_site_health', //サイトヘルスステータス
	];
	foreach ( $tmp as $v ) {
		if ( $v == 'wp_welcome_panel' ) {
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
		} else {
			global $wp_meta_boxes;
			unset( $wp_meta_boxes['dashboard']['normal']['core'][ $v ] );
			unset( $wp_meta_boxes['dashboard']['side']['core'][ $v ] );
		}
	}
} );

//クイック編集非表示
function hide_inline_edit_link() {
	?>
    <style type="text/css">
        span.inline {
            display: none;
        }
    </style>
	<?php
}

add_action( 'admin_print_styles-edit.php', 'hide_inline_edit_link' );

//スラッグ強制（投稿スラッグを自動的に生成する）
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
	if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
		$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
	}

	return $slug;
}

add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );


//ビジュアルエディタの非表示
function disable_visual_editor_in_page() {
	global $typenow;
	if ( $typenow == 'mw-wp-form' ) {
		add_filter( 'user_can_richedit', 'disable_visual_editor_filter' );
	}
}

function disable_visual_editor_filter() {
	return false;
}

add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );

/*//カスタム投稿タイプ表示数
	add_action('pre_get_posts', 'xxx_pre_get_posts');
	function xxx_pre_get_posts($query) {
	    if (!is_admin() && $query->is_main_query() && is_post_type_archive('xxx')) {
	        $query->set('posts_per_page', 9);
	    }
	}*/

//コードエディターでのコメント許可
remove_filter( 'the_content', 'wptexturize' );

//管理画面スラッグ表示
function add_page_columns_name( $columns ) {
	$columns['slug'] = "スラッグ";

	return $columns;
}

function add_page_column( $column_name, $post_id ) {
	if ( $column_name == 'slug' ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;
		echo esc_attr( $slug );
	}
}

add_filter( 'manage_pages_columns', 'add_page_columns_name' );
add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2 );

//抜粋文の長さを変更する
function custom_excerpt_length( $length ) {
	return 48;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '…';
}

add_filter( 'excerpt_more', 'new_excerpt_more' );

/*//read more リンク
	function new_excerpt_more( $more ) {
	return '<br><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">続きを見る→</a>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );*/

//エディタのスタイル
add_editor_style( 'editor-style.scss' );

// サイトIDタグ
function diverge_site_id() {
	if ( is_front_page() ) {
		echo "h1";
	} else {
		echo "div";
	}
}

function diverge_tagline() {
	if ( is_front_page() ) {
		echo "h2";
	} else {
		echo "div";
	}
}

//アンカーリンクコントロール
function hashControll() {
	if ( is_front_page() ) {
		//
	} else {
		echo home_url() . '/';
	}
}

//子ページ条件判定
function is_subpage( $pagename ) {
	if ( is_page() ) { //固定ページである。
		global $post;
		if ( $post->ancestors ) { //誰かのサブページである。
			$root      = $post->ancestors[ count( $post->ancestors ) - 1 ]; //配列の一番後ろが一番上の親。
			$root_post = get_post( $root );
			$name      = esc_attr( $root_post->post_name );
			if ( $pagename == $name ) {
				return true;
			}
		}
	}

	return false;
}

// タイトルタグのテキストを出力
// function full_title()
// {
// 	if (!is_front_page()) {
// 		echo trim(wp_title('', false)) . " | ";
// 	}

// 	bloginfo('name');
// }

//body にスラッグを追加
function getLoopCount() {
	global $wp_query;

	return $wp_query->current_post + 1;
}

function pagename_class( $classes = '' ) {
	if ( is_page() ) {
		$page      = get_page( get_the_ID() );
		$classes[] = 'page-' . $page->post_name;
		if ( $page->post_parent ) {
			$classes[] = 'page-' . get_page_uri( $page->post_parent ) . '-child';
		}
	}

	return $classes;
}

add_filter( 'body_class', 'pagename_class' );

//アイキャッチ画像の有効化
add_theme_support( 'post-thumbnails' );
// add_image_size('VGA', 640, 480, true);
// add_image_size('ランドスケープM', 320, 240, true);
// add_image_size('ポートレートM', 240, 320, true);
// add_image_size('案件', 580, 340, true);
// add_image_size('案件WIDE', 910, 260, true);
// add_image_size('案件リキッド', 928, 696, true);
// add_image_size('エントリー', 1840, 500, true);
// add_image_size('メインビジュアル', 3000, 1060, true);
// add_image_size('メインビジュアルSP', 640, 530, true);

//エディタで ファイルをインクルード [inc_php file='hoge']
function include_php( $params = array() ) {
	extract( shortcode_atts( array(
		'file' => 'default'
	), $params ) );
	ob_start();
	include( get_theme_root() . '/' . get_template() . "/parts/$file.php" );

	return ob_get_clean();
}

add_shortcode( 'inc_php', 'include_php' );

function wp_hide_favicon() {
	exit;
}

add_action( 'do_faviconico', 'wp_hide_favicon' );

function my_custom_revision() {
	add_post_type_support( 'case', 'revisions' );
}

add_action( 'init', 'my_custom_revision' );

//不要なメタタグを表示しない
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//
//名探偵追加
//

// タクソノミーが日本語で登録された場合のスラッグを自動的に変換
add_action( 'create_category', 'post_taxonomy_auto_slug', 10 );
add_action( 'create_post_tag', 'post_taxonomy_auto_slug', 10 );

// create_の後にタクソノミー名を入れてください
add_action( 'create_works_category', 'post_taxonomy_auto_slug', 10 );

function post_taxonomy_auto_slug( $term_id ) {
	$tax  = str_replace( 'create_', '', current_filter() );
	$term = get_term( $term_id, $tax );
	if ( preg_match( '/(%[0-9a-f]{2})+/', $term->slug ) ) {
		$tax      = $term->taxonomy;
		$str_pos  = strpos( $tax, '_' );
		$tax_name = ( $str_pos ) ? substr( $tax, 0, $str_pos ) : $tax;
		$args     = array(
			'slug' => $tax_name . '-' . $term->term_id
		);
		wp_update_term( $term_id, $tax, $args );
	}
}

//コメント機能の停止
add_filter( 'comments_open', '__return_false' );


// カスタムフィールドクエリを有効化
function add_meta_query_vars( $public_query_vars ) {
	$public_query_vars[] = 'meta_key';
	$public_query_vars[] = 'meta_value';

	return $public_query_vars;
}

add_filter( 'query_vars', 'add_meta_query_vars' );


//表示中のページのカテゴリー（ターム）名を取得する
function get_current_term() {
	$id;
	$tax_slug;
	if ( is_category() ) {
		$tax_slug = 'category';
		$id       = get_query_var( 'cat' );

		return get_term( $id, $tax_slug );
	} else if ( is_tag() ) {
		$tax_slug = 'post_tag';
		$id       = get_query_var( 'tag_id' );

		return get_term( $id, $tax_slug );
	} else if ( is_tax() ) {
		$tax_slug  = get_query_var( 'taxonomy' );
		$term_slug = get_query_var( 'term' );
		$term      = get_term_by( 'slug', $term_slug, $tax_slug );
		$id        = $term->term_id;

		return get_term( $id, $tax_slug );
	} else {
		return false;
	}
}

/*
アーカイブページの以下で取得可能
$term = get_current_term();
$term->name; //名前
$term->slug; //スラッグ
$term->description; //説明文
$term->count; //投稿数
*/


//特定のページにてプラグインの不要なCSS/JSを無効化する
add_action( 'wp_enqueue_scripts', 'deregister_styles' );
function deregister_styles() {
	if ( is_home() || is_front_page() ) {
		//CSS
		// wp_deregister_style('pz-linkcard');
		// wp_deregister_style('ez-icomoon');
		// wp_deregister_style('ez-toc');
		// wp_deregister_style('ez-toc-inline');
		//JS
	}

	//Gutenberg用のCSS
	wp_dequeue_style( 'wp-block-library' );
	//global-styles-inline-css
	wp_dequeue_style( 'global-styles' );
}

//デフォルトのファビコン削除
add_action( "do_faviconico", "wp_favicon_delete" );
function wp_favicon_delete() {
	exit;
}

//カスタムフィールドも管理画面の検索範囲に含める
function custom_search( $search, $wp_query ) {
	global $wpdb;
	if ( ! $wp_query->is_search ) {
		return $search;
	}
	if ( ! isset( $wp_query->query_vars ) ) {
		return $search;
	}

	$search_words = explode( ' ', isset( $wp_query->query_vars['s'] ) ? $wp_query->query_vars['s'] : '' );
	if ( count( $search_words ) > 0 ) {
		$search = '';
		$search .= "AND post_type = 'news'";
		$search .= "AND post_type = 'case'";
		foreach ( $search_words as $word ) {
			if ( ! empty( $word ) ) {
				$search_word = '%' . esc_sql( $word ) . '%';
				$search      .= " AND (
{$wpdb->posts}.post_title LIKE '{$search_word}'
OR {$wpdb->posts}.post_content LIKE '{$search_word}'
OR {$wpdb->posts}.ID IN (
SELECT distinct post_id
FROM {$wpdb->postmeta}
WHERE {$wpdb->postmeta}.meta_key IN ('memo') AND meta_value LIKE '{$search_word}'
)
) ";
			}
		}
	}

	return $search;
}

add_filter( 'posts_search', 'custom_search', 10, 2 );


//メモのカスタムフィールドの値を管理画面に表示
function add_posts_columns( $columns ) {
	$columns['memo'] = 'メモ';

	return $columns;
}

function custom_posts_column( $column_name, $post_id ) {
	if ( $column_name == 'memo' ) {
		$memo = get_post_meta( $post_id, 'memo', true );
		echo ( $memo ) ? $memo : '－';
	}
}

// 固定ページ
add_filter( 'manage_pages_columns', 'add_posts_columns' );
add_action( 'manage_pages_custom_column', 'custom_posts_column', 10, 2 );


//編集者アカウントにて管理メニューを非表示
function remove_menus_user() {

	if ( current_user_can( 'editor' ) ) {
		global $menu;
		$restricted = array( // 非表示にしたいメニューを指定
			__( 'SEO' ), //yoast seo
			__( '固定ページ' ),
			__( 'コメント' ),
			__( '投稿' ),
		);
		end( $menu );
		while ( prev( $menu ) ) {
			$value = explode( ' ', $menu[ key( $menu ) ][0] );
			if ( in_array( $value[0] != null ? $value[0] : "", $restricted ) ) {
				unset( $menu[ key( $menu ) ] );
			}
		}
		remove_menu_page( 'edit.php?post_type=mw-wp-form' ); //MW WP Form
		remove_action('admin_bar_menu', 'wpseo_admin_bar_menu', 95);
		remove_menu_page('wpseo_workouts'); //Yoast SEO
		emove_menu_page('wpseo_dashboard'); //Yoast SEO
	}
}

add_action( 'admin_menu', 'remove_menus_user' );


//更新ボタンに関するメッセージHTMLの出力
add_action( 'admin_notices', 'generate_dashboard_message' );
if ( ! function_exists( 'generate_dashboard_message' ) ) :
	function generate_dashboard_message() {
		printf(
			'<p id="dashboard-message">更新ボタンは押さないでください（WordPress●●●●/今すぐ更新してください/入手する/更新する等）</p>',
			''
		);
	}
endif;
//メッセージエリアのCSS出力
add_action( 'admin_head', 'dashboard_message_css' );
if ( ! function_exists( 'dashboard_message_css' ) ) :
	function dashboard_message_css() {
		echo "
	<style type='text/css'>
	#dashboard-message {
		background: #fff;
		border: 1px solid #c3c4c7;
		border-left-width: 4px;
		border-left-color: #d63638;
		box-shadow: 0 1px 1px rgb(0 0 0 / 4%);
		margin: 10px 0 15px;
		padding: 10px 12px;
		width: calc(100% - 40px);
		color: #d63638;
	}
	</style>
	";
	}
endif;


/*--------------------------------------------------------------------------------

▲▲▲▲▲▲▲▲▲▲▲デフォルトfunctionsここまで▲▲▲▲▲▲▲▲▲▲▲

▼▼▼▼▼▼▼▼▼▼▼案件個別のfunctionsここから▼▼▼▼▼▼▼▼▼▼▼

--------------------------------------------------------------------------------*/

//募集パッケージがある場合入れる
//yoast seo 採用パッケージ詳細ページ メイン画像をOGP画像に設定
function filter_wpseo_opengraph_image( $img ) {

	global $post;
	$ogpimg = get_post_meta( $post->ID, '_yoast_wpseo_opengraph-image', true ); //YoastSEOの入力欄で指定したOGP画像を取得
	if ( $ogpimg ) { //画像が設定されていれば採用
		return $ogpimg;
	} else { //ない場合
		if ( is_singular( 'case' ) && ! has_post_thumbnail() ) {
			$post_id = $post->ID;
			$image   = get_field( 'img', $post_id );
			if ( ! empty( $image ) ) :
				$url = $image['url'];
			endif;

			return $url;
		}
	}

	return $img;
}

;
add_filter( 'wpseo_opengraph_image', 'filter_wpseo_opengraph_image', 10, 1 ); //Facebook用
add_filter( 'wpseo_twitter_image', 'filter_wpseo_opengraph_image', 10, 1 ); //Twitter用


//カスタムサイズのサムネイルを作成
add_image_size( 'works_gallery', 616, 366, true );


// メモのカスタムフィールドの値を管理画面に表示
//（「'manage_〇〇_posts」の部分をカスタム投稿スラッグに変更）
add_filter( 'manage_case_posts_columns', 'add_posts_columns' );
add_action( 'manage_case_posts_custom_column', 'custom_posts_column', 10, 2 );

add_filter( 'manage_news_posts_columns', 'add_posts_columns' );
add_action( 'manage_news_posts_custom_column', 'custom_posts_column', 10, 2 );


// カテゴリーにある「説明」を非表示にする
function remove_default_term_description() {
	?>
    <style type="text/css">
        .term-description-wrap {
            display: none !important;
        }
    </style>
	<?php
}

add_action( 'admin_head', 'remove_default_term_description' );


//アイキャッチ設定フィールドに説明文を表示
function custom_admin_post_thumbnail_html( $content ) {
	$screen = get_current_screen();      //各投稿／カスタム投稿ごとに分岐
	if ( $screen->post_type == 'works' ) {
		$content .= '<p class="description">メイン画像を登録してください。<br>推奨サイズ：1024×610px</p>';
	}

	return $content;
}

add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );



?>
