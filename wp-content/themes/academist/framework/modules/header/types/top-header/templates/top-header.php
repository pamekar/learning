<?php
if($show_header_top) {
	do_action('academist_elated_action_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="eltdf-top-bar-background"></div>
	<?php } ?>
	
	<div class="eltdf-top-bar">
		<?php do_action( 'academist_elated_action_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="eltdf-grid">
		<?php endif; ?>
				
			<div class="eltdf-vertical-align-containers">
				<div class="eltdf-position-left"><!--
				 --><div class="eltdf-position-left-inner">
						<?php if(is_active_sidebar('eltdf-top-bar-left')) : ?>
							<?php dynamic_sidebar('eltdf-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="eltdf-position-right"><!--
				 --><div class="eltdf-position-right-inner">
						<?php if(is_active_sidebar('eltdf-top-bar-right')) : ?>
							<?php dynamic_sidebar('eltdf-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'academist_elated_action_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('academist_elated_action_after_header_top');
}