<?php get_template_part('parts/meta'); ?>
<?php get_header(); ?>

<?php
$get_page_id = get_page_by_path("top");
$get_page_id = $get_page_id->ID;
$text_404 = get_field('text_404', $get_page_id);
?>

<div id="main" <?php post_class(); ?> role="main">

	<div id="contact" class="l-contents">

		<div class="pageTtl">
			<div class="heading-01 heading-01--center">
				<div class="heading-01__en en">404 Not Found</div>
				<h1 class="heading-01__ja">ページが見つかりません</h1>
			</div>
		</div>

		<div class="inner">
			<div class="error404__cont">
				<p class="text_404"><?php echo $text_404; ?></p>
				<div class="btn-404">
					<a href="<?php echo esc_url(home_url('/')); ?>">トップページへ</a>
				</div>
			</div>
		</div>

	</div><!-- /.l-contents #page-id-->

</div>
<!-- /#main -->


<?php get_footer(); ?>
