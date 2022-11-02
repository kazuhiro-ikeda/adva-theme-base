<?php echo do_shortcode('[mwform_formkey key="38"]'); ?>

<div id="contact" class="l-contents">

    <section class="sec-form form_complete">
        <div class="inner">
            <div class="steps_form">
                <picture class="img">
                    <source media="(min-width: 751px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_3@2x.png">
                    <source media="(max-width: 750px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_3_s@2x.png">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_3@2x.png" alt="受付完了" width="700" height="65">
                </picture>
            </div>
            <!-- /.steps_form -->

            <div class="wrap_form">
                <p class="thanks-text">この度は、お問合せいただきまして誠にありがとうございます。<br class="pc">自動返信メールをお送りしております。届かない場合はお手数ですがご連絡頂けますと幸いです。<br class="pc">３営業日以内を目安にご連絡をさしあげますのでもうしばらくお待ちくださいませ。</p>
                <p class="thanks-text">株式会社〇〇〇<br>
                    〒〇〇〇<br>
                    〇〇〇<br>
                    TEL <a href="tel:〇〇〇">〇〇〇</a></p>

                <p class="thanks_btn">
                    <a href="<?php echo esc_url(home_url('/')); ?>">トップページに戻る</a>
                </p>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php remove_filter('the_content', 'wpautop'); ?>
                <?php the_content(); ?>

                <?php endwhile;
				else : ?>
                <p style="text-align:center; font-size:24px; font-weight:bold; color:#ddd; margin:100px auto; line-height:200%;">お探しの記事は準備中です。<br>近日中に公開となります。</p>

                <?php endif; ?>

            </div>


        </div><!-- /inner -->
    </section><!-- /sec-form -->



</div><!-- /.l-contents #page-id-->