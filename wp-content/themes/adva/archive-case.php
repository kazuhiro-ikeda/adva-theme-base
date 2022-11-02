<?php get_template_part('parts/meta'); ?>
<?php get_header(); ?>


<div id="main" <?php post_class(); ?> role="main">


    <!-- 検索パネル -->
    <?php echo do_shortcode('[job_search type="research" results=false page_slug="page_search"]'); ?>
    <!-- /検索パネル -->


    <div id="case-ac" class="l-contents">
        <section class="secCase" id="archive_case">
            <div class="inner">
                <div class="wrapper">
                    <?php if (!is_paged()) : ?>
                    <!-- 1page only -->
                    <?php else : ?>

                    <?php endif; ?>

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php remove_filter('the_content', 'wpautop'); ?>

                    <?php get_template_part('loop'); ?>

                    <?php endwhile;
					else : ?>
                    <p style="text-align:center; font-size:24px; font-weight:bold; color:#ddd; margin:100px auto; line-height:200%;">申し訳ございませんが、<br>現在お探しの募集情報はありません。<br>再度検索をお試し下さい。</p>

                    <?php endif; ?>

                </div>

                <?php wp_pagenavi(); ?>

            </div><!-- /inner -->
        </section><!-- /secCase -->
    </div><!-- /l-contents -->

</div>
<!-- /#main -->


<?php get_footer(); ?>








</div><!-- /.l-contents #page-id-->