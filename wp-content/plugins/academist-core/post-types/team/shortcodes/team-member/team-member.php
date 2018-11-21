<?php
namespace AcademistCore\CPT\Shortcodes\Team;

use AcademistCore\Lib;

class TeamMember implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'eltdf_team_member';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Portfolio project id filter
	    add_filter( 'vc_autocomplete_eltdf_team_member_member_id_callback', array( &$this, 'teamMemberIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio project id render
	    add_filter( 'vc_autocomplete_eltdf_team_member_member_id_render', array( &$this, 'teamMemberIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
	        vc_map( array(
			        'name'                      => esc_html__( 'Team Member', 'academist-core' ),
			        'base'                      => $this->getBase(),
			        'category'                  => esc_html__( 'by ACADEMIST', 'academist-core' ),
			        'icon'                      => 'icon-wpb-team-member extended-custom-icon',
			        'allowed_container_element' => 'vc_row',
			        'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'team_member_layout',
                            'heading'     => esc_html__('Team Layout', 'academist-core'),
                            'value'       => array(
                                esc_html__('Info Bellow', 'academist-core')   => 'info-bellow',
                                esc_html__('Info on Hover', 'academist-core') => 'info-hover'
                            )
                        ),
                        array(
					        'type'       => 'autocomplete',
					        'param_name' => 'member_id',
					        'heading'    => esc_html__( 'Select Team Member', 'academist-core' ),
					        'settings'   => array(
						        'sortable'      => true,
						        'unique_values' => true
					        ),
					        'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'academist-core' )
				        )
			        )
		        )
	        );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'team_member_layout'    => 'info-bellow',
	        'member_id'             => 'title'
        );

		$params = shortcode_atts($args, $atts);
		extract($params);
	    
	    $params['member_id'] = !empty($params['member_id']) ? $params['member_id'] : get_the_ID();
        $params['image'] = get_the_post_thumbnail($params['member_id']);
        $params['title'] = get_the_title($params['member_id']);
        $params['position'] = get_post_meta($params['member_id'], 'eltdf_team_member_position', true);
        $params['birth_date'] = get_post_meta($params['member_id'], 'eltdf_team_member_birth_date', true);
        $params['email'] = get_post_meta($params['member_id'], 'eltdf_team_member_email', true);
        $params['phone'] = get_post_meta($params['member_id'], 'eltdf_team_member_phone', true);
        $params['address'] = get_post_meta($params['member_id'], 'eltdf_team_member_address', true);
        $params['social'] = get_post_meta($params['member_id'], 'eltdf_team_member_social', true);
        $params['resume'] = get_post_meta($params['member_id'], 'eltdf_team_member_resume', true);
        $params['excerpt'] = get_the_excerpt($params['member_id']);
        $params['team_social_icons'] = $this->getTeamSocialIcons($params['member_id']);

        $html = academist_core_get_cpt_shortcode_module_template_part('team', 'team-member', $params['team_member_layout'], '', $params);

        return $html;
	}

    private function getTeamSocialIcons($id) {
        $social_icons = array();

        for($i = 1; $i < 6; $i++) {
            $team_icon_pack = get_post_meta($id, 'eltdf_team_member_social_icon_pack_'.$i, true);
            if($team_icon_pack) {
                $team_icon_collection = academist_elated_icon_collections()->getIconCollection(get_post_meta($id, 'eltdf_team_member_social_icon_pack_' . $i, true));
                $team_social_icon = get_post_meta($id, 'eltdf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
                $team_social_link = get_post_meta($id, 'eltdf_team_member_social_icon_' . $i . '_link', true);
                $team_social_target = get_post_meta($id, 'eltdf_team_member_social_icon_' . $i . '_target', true);

                if ($team_social_icon !== '') {

                    $team_icon_params = array();
                    $team_icon_params['icon_pack'] = $team_icon_pack;
                    $team_icon_params[$team_icon_collection->param] = $team_social_icon;
                    $team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

                    $social_icons[] = academist_elated_execute_shortcode('eltdf_icon', $team_icon_params);
                }
            }
        }

        return $social_icons;
    }

	/**
	 * Filter team by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamMemberIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'team-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'academist-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'academist-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamMemberIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$team = get_post( (int) $query );
			if ( ! is_wp_error( $team ) ) {

				$team_id = $team->ID;
                $team_title = $team->post_title;

                $team_title_display = '';
				if ( ! empty( $team_title ) ) {
                    $team_title_display = ' - ' . esc_html__( 'Title', 'academist-core' ) . ': ' . $team_title;
				}

                $team_id_display = esc_html__( 'Id', 'academist-core' ) . ': ' . $team_id;

				$data          = array();
				$data['value'] = $team_id;
				$data['label'] = $team_id_display . $team_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}