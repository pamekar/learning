<?php
namespace AcademistCore\CPT\Shortcodes\SplitScrollingSectionRightPanel;

use AcademistCore\Lib;

class SplitScrollingSectionRightPanel implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'eltdf_split_scrolling_section_right_panel';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(
			array(
				'name' => esc_html__('Right Scrolling Panel', 'academist-core'),
				'base' => $this->base,
				'as_parent'	=> array('only' => 'eltdf_split_scrolling_section_content_item'),
				'as_child'	=> array('only' => 'eltdf_split_scrolling_section'),
				'content_element' => true,
				'category' => esc_html__('by ACADEMIST', 'academist-core'),
				'icon' => 'icon-wpb-split-scrolling-section-right-panel extended-custom-icon',
				'show_settings_on_create' => false,
				'js_view' => 'VcColumnView'
			)
		);
	}

	public function render($atts, $content = null) {
		$args = array();

		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '<div class="eltdf-sss-ms-right">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
