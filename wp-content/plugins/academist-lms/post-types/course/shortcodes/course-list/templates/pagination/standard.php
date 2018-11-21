<?php if ( $query_results->max_num_pages > 1 ) { ?>
	<div class="eltdf-cl-loading">
		<div class="eltdf-cl-loading-bounce1"></div>
		<div class="eltdf-cl-loading-bounce2"></div>
		<div class="eltdf-cl-loading-bounce3"></div>
	</div>
	<?php
	$pages = $query_results->max_num_pages;
	$paged = $query_results->query['paged'];
	
	if ( $pages > 1 ) { ?>
		<div class="eltdf-cl-standard-pagination">
			<ul>
				<li class="eltdf-cl-pag-prev">
					<a href="#" data-paged="1"><span class="icon dripicons-chevron-left"></span></a>
				</li>
				<?php for ( $i = 1; $i <= $pages; $i ++ ) { ?>
					<?php
					$active_class = '';
					if ( $paged == $i ) {
						$active_class = 'eltdf-cl-pag-active';
					}
					?>
					<li class="eltdf-cl-pag-number <?php echo esc_attr( $active_class ); ?>">
						<a href="#" data-paged="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
					</li>
				<?php } ?>
				<li class="eltdf-cl-pag-next">
					<a href="#" data-paged="2"><span class="icon dripicons-chevron-right"></span></a>
				</li>
			</ul>
		</div>
	<?php }
	?>
<?php }