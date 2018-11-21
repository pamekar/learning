<div class="eltdf-social-share-holder eltdf-dropdown">
	<a class="eltdf-social-share-dropdown-opener" href="javascript:void(0)">
        <span class="eltdf-social-share-title"><?php esc_html_e('Share this', 'academist-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="eltdf-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				echo wp_kses($net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				));
			} ?>
		</ul>
	</div>
</div>