<div class="box_case">
	<div class="wrap">
		<div class="data">
			<div class="inner_s">
				<div class="info">
					<div class="label_term">
						<div class="label">
							<div class="inner_text">
								<?php
									$term  = wp_get_object_terms($post->ID, 'genre');
									$term_slug = $term[0]->slug;
									$term_name = $term[0]->name;
								?>
								<?php echo $term_name; ?>
							</div>
						</div>
					</div>
					<h1 class="title"><?php the_title(); ?></h1>
				</div>
				<?php
				$image   = get_field( 'img' );
				if ( ! empty( $image ) ):

					// vars
					$url = $image['url'];
					$alt = $image['alt'];

					// thumbnail
					$size  = '案件リキッド';
					$thumb = $image['sizes'][ $size ];

					?>

					<figure><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"></figure>

				<?php else: ?>
					<figure><img src="<?php echo get_template_directory_uri(); ?>/images/case/img.jpg" alt=""></figure>

				<?php endif; ?>
			</div>

			<div class="inner_data">
				<div class="job-description">
					<?php
					$string = get_field( 'job-description' );
					echo strip_tags( $string );
					?>
				</div>

				<table class="table_job-information">
					<tr>
						<th>勤務地</th>
						<td>
							<div class="n3">
								<?php
								$string = get_field( 'location' );
								echo strip_tags( $string );
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th>給与</th>
						<td>
							<div class="n3">
								<?php
								$string = get_field( 'salary' );
								echo strip_tags( $string );
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th>対象となる方</th>
						<td>
							<div class="n3">
								<?php
								$string = get_field( 'application-requirements' );
								echo strip_tags( $string );
								?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
		$image   = get_field( 'img' );
		if ( ! empty( $image ) ):

			// vars
			$url = $image['url'];
			$alt = $image['alt'];

			// thumbnail
			$size  = '案件リキッド';
			$thumb = $image['sizes'][ $size ];

			?>

			<figure><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"></figure>

		<?php else: ?>
			<figure><img src="<?php echo get_template_directory_uri(); ?>/images/case/image_liquid.jpg" alt=""></figure>

		<?php endif; ?>
	</div>
	<div class="btns">
		<a class="n1" href="<?php the_permalink(); ?>">募集詳細を見る<i class="fas fa-angle-right"></i></a>
		<a class="n2" href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=88&post_id=<?php echo $post->ID; ?>">応募する<i class="fas fa-angle-right"></i></a>
	</div>
</div>
