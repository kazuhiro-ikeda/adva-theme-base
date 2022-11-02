<footer>
	<div style="display: flex; justify-content: center; align-items: center; background-color: floralwhite; height: 200px; margin: 120px 0 0">Footer</div>
</footer>

<a href="#" id="btn_top"><img src="<?php echo get_template_directory_uri(); ?>/images/common/btn_top.png" alt="Top"></a>

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.matchHeight.js"></script>
<script>
	$(function() {
		$('matchHeight').matchHeight();
	});
</script>


</body>

</html>
