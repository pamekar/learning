<li class="eltdf-bl-item eltdf-item-space">
	<div class="eltdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			academist_elated_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_category == 'yes' && $post_info_date == 'yes') { ?>
                <div class="eltdf-bli-info eltdf-post-info-top">
	                <?php
		                if ( $post_info_category == 'yes' ) {
			                academist_elated_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
						if ( $post_info_date == 'yes' ) {
							academist_elated_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
						}
	                ?>
                </div>
            <?php } ?>

	        <?php academist_elated_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="eltdf-bli-excerpt">
		        <?php academist_elated_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params );?>

		        <?php
				if ( $post_read_more == 'yes' ) {
					academist_elated_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params );
				}
				?>
	        </div>
			<?php if ($post_info_section == 'yes') { ?>
				<div class="eltdf-post-info-bottom clearfix">
					<div class="eltdf-post-info-bottom-left">
						<?php
						if ( $post_info_tag == 'yes' ) {
							academist_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $params);
						}
						?>

					</div>
					<div class="eltdf-post-info-bottom-right">
						<?php
							if ( $post_info_share == 'yes' ) {
								academist_elated_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
							}
						?>
					</div>
				</div>
				<div class="eltdf-post-info-bottom2 clearfix">
					<div class="eltdf-post-info-bottom-left">
						<?php
							if ( $post_info_author == 'yes' ) {
							academist_elated_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
							}
						?>
					</div>
					<div class="eltdf-post-info-bottom-right">
						<?php
						if ( $post_info_comments == 'yes' ) {
							academist_elated_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
						}
						if ( $post_info_like == 'yes' ) {
							academist_elated_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
						}
						?>
					</div>
				</div>
			<?php } ?>
        </div>
	</div>
</li>