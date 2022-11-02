<header class="normal">
	<div style="display: flex; justify-content: center; align-items: center; background-color: yellowgreen; height: 120px; width: 100%">Spacer</div>
</header>

<div class="nav_drawer">
	<div class="drawer_bg"></div>
	<div class="inner">
		<a href="<?php echo home_url(); ?>/" class="logo">ロゴ</a>
	</div>
	<button type="button" class="drawer_button menu-trigger">
		<span></span>
		<span></span>
		<span></span>
	</button>
	<nav class="drawer_nav_wrapper" id="drawer">
		<?php get_template_part('drawer'); ?>
	</nav>
</div>

<?php get_template_part('title'); ?>
