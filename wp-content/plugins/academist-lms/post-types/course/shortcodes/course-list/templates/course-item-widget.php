<article class="eltdf-cl-item <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>" <?php echo esc_attr( $this_object->getArticleData( $params ) ); ?>>
	<div class="eltdf-cl-item-inner">
		<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'layout-collections/' . $item_layout, '', $params ); ?>
	</div>
</article>