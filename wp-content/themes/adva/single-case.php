<?php get_template_part('parts/meta'); ?>
<?php get_header(); ?>

<?php get_template_part('google_for_jobs'); ?>

<?php
//電話番号表示
$link_tel = get_field('link_tel');

//パラメーター
$param = '?post_id=' . $post->ID;
?>

<div id="main" <?php post_class(); ?> role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="case">
        <div class="wrapper">
            <div class="contents">
                <div class="primary">
                    <div class="label_term">
                        <?php
								$term  = wp_get_object_terms($post->ID, 'area');
								$term_slug = $term[0]->slug;
								$term_name = $term[0]->name;
								?>
                        <div class="label">
                            <div class="inner_text <?php echo $term_slug; ?>"><?php echo $term_name; ?></div>
                        </div>
                    </div>
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>

                <div class="information">
                    <?php
							$lead = get_field('lead');
							if (!empty($lead)) :
							?>
                    <h2 class="lead <?php echo $term_slug; ?>"><?php echo $lead; ?></h2>
                    <?php endif; ?>

                    <?php
							$text = get_field('text');
							if (!empty($text)) :
							?>
                    <div class="single-content">
                        <?php echo $text; ?>
                    </div>
                    <?php endif; ?>

                    <?php
							$image = get_field('img');
							if (!empty($image)) :

								// vars
								$url = $image['url'];
								$alt = $image['alt'];

								// thumbnail
								$size = '案件リキッド';
								$thumb = $image['sizes'][$size];

							?>

                    <figure class="photo_information"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"></figure>

                    <?php else : ?>

                    <?php endif; ?>
                </div>

                <div class="btns_s">
                    <a href="#requirements_anc" class="btn-case btn-case--detail">募集要項を見る</a>
                    <a href="<?php echo esc_url(home_url('/entry/' . $param)); ?>" class="btn-case btn-case--entry">応募する</a>
                </div>

                <?php if (have_rows('pr')) : ?>
                <div class="pr">
                    <?php while (have_rows('pr')) : the_row();
									// vars
									$image = get_sub_field('img');
									$ttl = get_sub_field('ttl');
									$text = get_sub_field('text');

									// vars img
									if ($image) {
										$url = $image['url'];
										$alt = $image['alt'];
										$size = '案件リキッド';
										$thumb = $image['sizes'][$size];
									}
								?>
                    <div class="box_pr<?php if (!empty($image)) : ?> narrow<?php endif; ?>">
                        <div class="data">
                            <h3 class="ttl_pr"><?php echo $ttl; ?></h3>
                            <p class="text"><?php echo $text; ?></p>
                        </div>

                        <?php
										if (!empty($image)) :
										?>
                        <figure><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"></figure>
                        <?php endif; ?>

                    </div>
                    <?php endwhile; ?>

                </div>

                <?php endif; ?>

                <?php
						$images = get_field('gallery');
						if ($images) : ?>
                <div class="gallery">
                    <ul>
                        <?php foreach ($images as $image) : ?>
                        <li>
                            <img src="<?php echo esc_url($image['sizes']['案件リキッド']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <p class="caption"><?php echo esc_html($image['caption']); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div id="requirements_anc" class="anc"></div>
                <!-- /#requirements_anc.anc -->
                <div class="requirements">
                    <h2 class="ttl_requirements">募集要項</h2>
                    <table class="table_requirements">
                        <?php
								$job = get_field('job');
								if (!empty($job)) :
								?>
                        <tr>
                            <th>職種</th>
                            <td><?php echo $job; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$employment_status = get_field('employment-status');
								if (!empty($employment_status)) :
								?>
                        <tr>
                            <th>雇用形態</th>
                            <td><?php echo $employment_status; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$job_description = get_field('job-description');
								if (!empty($job_description)) :
								?>
                        <tr>
                            <th>仕事内容</th>
                            <td><?php echo $job_description; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$application_requirements = get_field('application-requirements');
								if (!empty($application_requirements)) :
								?>
                        <tr>
                            <th>対象となる方</th>
                            <td><?php echo $application_requirements; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$license = get_field('license');
								if (!empty($license)) :
								?>
                        <tr>
                            <th>資格</th>
                            <td><?php echo $license; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$location = get_field('location');
								if (!empty($location)) :
								?>
                        <tr>
                            <th>勤務地</th>
                            <td><?php echo $location; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$time = get_field('time');
								if (!empty($time)) :
								?>
                        <tr>
                            <th>勤務時間</th>
                            <td><?php echo $time; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$salary = get_field('salary');
								if (!empty($salary)) :
								?>
                        <tr>
                            <th>給与</th>
                            <td><?php echo $salary; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$holiday_vacation = get_field('holiday_vacation');
								if (!empty($holiday_vacation)) :
								?>
                        <tr>
                            <th>休日休暇</th>
                            <td><?php echo $holiday_vacation; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$benefit = get_field('benefit');
								if (!empty($benefit)) :
								?>
                        <tr>
                            <th>待遇・福利厚生</th>
                            <td><?php echo $benefit; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$entry = get_field('entry');
								if (!empty($entry)) :
								?>
                        <tr>
                            <th>応募方法</th>
                            <td><?php echo $entry; ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php
								$memo = get_field('memo');
								if (!empty($memo)) :
								?>
                        <tr>
                            <th>その他</th>
                            <td><?php echo $memo; ?></td>
                        </tr>
                        <?php endif; ?>

                    </table>

                    <?php
							$google_iframe = get_field('google_iframe');
							if (!empty($google_iframe)) :
							?>
                    <div class="google">
                        <h3 class="ttl_map">勤務地・所在地</h3>
                        <div class="map">
                            <?php echo $google_iframe; ?>

                        </div>
                        <?php
									$google_url = get_field('google_url');
									if (!empty($google_url)) :
									?>

                        <div class="url">
                            <a target="_blank" href="<?php echo $google_url; ?>">GoogleMAPで見る<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/case/icon_external.svg" alt=""></span></a>
                        </div>

                        <?php endif; ?>
                    </div>

                    <?php endif; ?>

                </div>
                <!-- /.requirements -->

                <div id="btn_none"></div>
                <!-- /#btn_none -->

                <div class="btn_entry">
                    <a href="<?php echo esc_url(home_url('/entry/' . $param)); ?>">応募する</a>
                </div>

                <?php if ($link_tel == 'on') : ?>
                <div class="display_tel">
                    <div class="tel">
                        <div class="label">お電話でのご応募</div>
                        <div class="number"><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/case/icon_phone.svg" alt=""></span>000-000-0000</div>
                    </div>

                    <a class="tel_s" href="tel:000-000-0000">
                        <div class="label">お電話でのご応募</div>
                        <div class="number"><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/case/icon_phone.svg" alt=""></span>000-000-0000</div>
                    </a>
                </div>
                <?php endif; ?>

                <div id="historyback">
                    <script>
                    var ref = document.referrer;
                    var hereHost = window.location.hostname;

                    var sStr = "^https?://" + hereHost;
                    var rExp = new RegExp(sStr, "i");

                    if (ref.length == 0) {
                        // リファラなし
                        document.write('<a href="<?php echo home_url(); ?>/case">募集一覧を見る</a>');
                    } else if (ref.match(rExp)) {
                        // マッチした場合
                        document.write('<a href="javascript:window.history.back()">戻る</a>');
                    } else {
                        // マッチしない場合
                        document.write('<a href="<?php echo home_url(); ?>/case">募集一覧を見る</a>');
                    }
                    </script>
                </div>
            </div>

            <div class="links_wrap">
                <div class="links">
                    <div class="ttl">エントリー</div>
                    <div class="inner">
                        <a href="#requirements_anc" class="btn n1">募集要項を見る</a>
                        <a href="<?php echo esc_url(home_url('/entry/' . $param)); ?>" class="btn n2">応募する</a>
                        <?php if ($link_tel == 'on') : ?>
                        <div class="tel">
                            <div class="title"><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/case/icon_phone.svg" alt=""></span>お電話でのご応募</div>
                            <div class="number">000-000-0000</div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

    </article>

    <?php endwhile;
	else : ?>
    <p style="text-align:center; font-size:24px; font-weight:bold; color:#ddd; margin:100px auto; line-height:200%;">お探しの記事は準備中です。<br>近日中に公開となります。</p>

    <?php endif; ?>


    <script>
    $(function() {
        $(window).on('load resize', function() {
            var winW = $(window).width();
            var devW = 750;
            if (winW <= devW) {
                //Under 750px
            } else {

                $(window).scroll(function() {
                    var s = $(this).scrollTop();
                    var a = 0;
                    var b = $("#btn_none").offset();
                    var c = b.top;
                    if (s >= a && s <= (c - $(window).height())) {
                        $(".links_wrap").fadeIn("slow");
                    } else if (s <= a || s > (c - $(window).height())) {
                        $(".links_wrap").fadeOut("slow");
                    }
                });


            }
        });
    });
    </script>


</div><!-- /#main post_class -->

<?php get_footer(); ?>