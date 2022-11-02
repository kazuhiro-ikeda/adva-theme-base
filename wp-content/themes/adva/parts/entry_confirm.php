<div id="entry" class="l-contents">

    <section class="sec-form form_confirm">
        <div class="inner">
            <div class="steps_form">
                <picture class="img">
                    <source media="(min-width: 751px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_2@2x.png">
                    <source media="(max-width: 750px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_2_s@2x.png">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_2@2x.png" alt="入力内容の確認" width="700" height="65">
                </picture>
            </div>
            <!-- /.steps_form -->

            <?php echo do_shortcode('[mwform_formkey key="96"]'); ?>

        </div><!-- /inner -->
    </section><!-- /sec-form -->



</div><!-- /.l-contents #page-id-->