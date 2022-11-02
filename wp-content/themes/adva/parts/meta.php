<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<?php if ( wp_is_mobile() ) : ?>
		<?php if ( is_page( 'entry' ) || is_page( 'registration' ) ) : ?>
			<meta name="viewport" content="width=device-width, user-scalable=no">
		<?php else : ?>
			<meta name="viewport" content="width=device-width">
		<?php endif; ?>
	<?php else : ?>
		<meta name="viewport" content="width=device-width">
	<?php endif; ?>

	<title><?php bloginfo( 'name' ); ?></title>

	<?php
	$get_page_id = get_page_by_path( "top" );
	$get_page_id = $get_page_id->ID;
	$keyword     = get_field( 'keyword', $get_page_id );
	if ( ! empty( $keyword ) ) {
		echo '<meta name="keywords" content="' . $keyword . '">' . PHP_EOL;
	}
	?>
	<meta name="google" content="notranslate">
	<meta name="format-detection" content="telephone=no">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/styles.css" as="style">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/common.js" defer></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/nav_drawer.js" defer></script>
	<script src="https://kit.fontawesome.com/177bdb17a6.js" crossorigin="anonymous" defer></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/override.js" defer></script>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
