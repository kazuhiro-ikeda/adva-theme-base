<?php get_template_part('parts/meta'); ?>
<?php get_header(); ?>


<div id="main" <?php post_class(); ?> role="main">

    <?php $template_slug = get_post($wp_query->post->ID)->post_name; ?>
    <?php get_template_part('parts/' . $template_slug); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="l-contents">
        <div class="inner" style="max-width: 805px;">
            <div class="single-content">
                <?php remove_filter('the_content', 'wpautop'); ?>
                <?php the_content(); ?>
            </div>

        </div><!-- /inner -->
    </section><!-- / -->
    <?php //advanced custom fields プラグイン the_field( "prefecture", $post->ID);
			?>

    <?php endwhile;
	else : ?>
    <p style="text-align:center; font-size:24px; font-weight:bold; color:#ddd; margin:100px auto; line-height:200%;">お探しの記事は準備中です。<br>近日中に公開となります。</p>

    <?php endif; ?>

</div>
<!-- /#main -->


<?php get_footer(); ?>