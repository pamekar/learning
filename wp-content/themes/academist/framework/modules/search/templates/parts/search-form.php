<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="eltdf-search-page-form" method="get">
	<h2 class="eltdf-search-title"><?php esc_html_e( 'New search:', 'academist' ); ?></h2>
	<div class="eltdf-form-holder">
		<div class="eltdf-column-left">
			<input type="text" name="s" class="eltdf-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Type here', 'academist' ); ?>"/>
		</div>
		<div class="eltdf-column-right">
			<button type="submit" class="eltdf-search-submit"><span class="icon_search"></span></button>
		</div>
	</div>
	<div class="eltdf-search-label">
		<?php esc_html_e( 'If you are not happy with the results below please do another search', 'academist' ); ?>
	</div>
</form>