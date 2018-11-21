<?php
namespace AcademistCore\CPT\Shortcodes\SplitScrollingSection;

use AcademistCore\Lib;

class SplitScrollingSection implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_split_scrolling_section';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Split Scrolling Section', 'academist-core'),
			'base' => $this->base,
			'icon' => 'icon-wpb-split-scrolling-section extended-custom-icon',
			'category' => esc_html__('by ACADEMIST', 'academist-core'),
			'as_parent'	=> array('only' => 'eltdf_split_scrolling_section_left_panel, eltdf_split_scrolling_section_right_panel'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array();
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content'] = $content;

		$html = academist_core_get_shortcode_module_template_part('templates/split-scrolling-section-template', 'split-scrolling-section', '', $params);

		return $html;
	}
}
