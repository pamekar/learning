<?php

if ( ! function_exists( 'academist_elated_loading_spinners' ) ) {
	function academist_elated_loading_spinners() {
		$id           = academist_elated_get_page_id();
		$spinner_type = academist_elated_get_meta_field_intersect( 'smooth_pt_spinner_type', $id );
		
		$spinner_html = '';
		if ( ! empty( $spinner_type ) ) {
			switch ( $spinner_type ) {
				case 'academist_loader':
					$spinner_html = academist_elated_loading_spinner_academist();
					break;
				case 'rotate_circles':
					$spinner_html = academist_elated_loading_spinner_rotate_circles();
					break;
				case 'pulse':
					$spinner_html = academist_elated_loading_spinner_pulse();
					break;
				case 'double_pulse':
					$spinner_html = academist_elated_loading_spinner_double_pulse();
					break;
				case 'cube':
					$spinner_html = academist_elated_loading_spinner_cube();
					break;
				case 'rotating_cubes':
					$spinner_html = academist_elated_loading_spinner_rotating_cubes();
					break;
				case 'stripes':
					$spinner_html = academist_elated_loading_spinner_stripes();
					break;
				case 'wave':
					$spinner_html = academist_elated_loading_spinner_wave();
					break;
				case 'two_rotating_circles':
					$spinner_html = academist_elated_loading_spinner_two_rotating_circles();
					break;
				case 'five_rotating_circles':
					$spinner_html = academist_elated_loading_spinner_five_rotating_circles();
					break;
				case 'atom':
					$spinner_html = academist_elated_loading_spinner_atom();
					break;
				case 'clock':
					$spinner_html = academist_elated_loading_spinner_clock();
					break;
				case 'mitosis':
					$spinner_html = academist_elated_loading_spinner_mitosis();
					break;
				case 'lines':
					$spinner_html = academist_elated_loading_spinner_lines();
					break;
				case 'fussion':
					$spinner_html = academist_elated_loading_spinner_fussion();
					break;
				case 'wave_circles':
					$spinner_html = academist_elated_loading_spinner_wave_circles();
					break;
				case 'pulse_circles':
					$spinner_html = academist_elated_loading_spinner_pulse_circles();
					break;
				default:
					$spinner_html = academist_elated_loading_spinner_pulse();
			}
		}
		
		echo wp_kses( $spinner_html, array(
			'div' => array(
				'class' => true,
				'style' => true,
				'id'    => true
			),
			'svg' => array(
                'version'  => true,
                'x'        => true,
                'y'        => true,
                'width'    => true,
                'height'   => true,
                'viewBox'  => true,
			),
			'path' => array(
                'class'  => true,
                'fill'   => true,
			    'd'      => true
            )
		) );
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_academist' ) ) {
	function academist_elated_loading_spinner_academist() {
		$html = '';
		$html .= '<div class="eltdf-loading-academist">';
		$html .= '<div class="eltdf-loading-academist-background"></div>';
		$html .= '<div class="eltdf-loading-academist-loader">';
		$html .= '<div class="eltdf-loading-text">' . academist_elated_get_meta_field_intersect( 'smooth_pt_spinner_text', academist_elated_get_page_id() ) . ' </div>';
		$html .= '<div class="eltdf-loading-checkmark">';
		$html .= '<svg version="1.1" x="0px" y="0px"
		width="60px" height="48.685px" viewBox="0 0 60 48.685" >
   <g>
	   <path class="eltdf-checkmark-svg-path-1" fill="#FF1949" d="M11.929,47.489c-0.016,0.208,0.291,0.397,0.617,0.532c0.308-0.099,0.615-0.206,0.917-0.326
		   c0.496-0.22,0.995-0.461,1.446-0.757c0.157-0.144,0.303-0.296,0.441-0.456c0.58-0.831,1.015-1.748,1.416-2.676
		   c0.361-0.885,0.672-1.787,0.845-2.729c0.108-1.246-0.05-2.494-0.194-3.734c-0.111-0.581-0.282-1.17-0.41-1.763
		   c-0.041-0.052-0.082-0.117-0.135-0.188c-0.199-0.278-0.387-0.595-0.617-0.846c-0.507-0.553-2.892-3.428-3.651-4.243
		   c-0.46-0.493-6.25-5.63-6.856-6.033c-0.297-0.197-0.704-0.562-1.079-0.591c-0.087-0.004-0.586-0.209-1.066,0.401
		   c-0.153,0.193-0.39,0.466-0.555,0.66c-0.33,0.391-1.185,1.977-1.369,2.337c-0.138,0.271-1.278,2.654-1.362,2.817
		   c-0.191,0.371-0.346,1.526-0.315,1.737c0.062,0.414,0.484,0.912,0.59,1.102c0.395,0.696,3.811,4.105,3.969,4.337
		   c0.122,0.181,3.895,4.745,4.145,5.146C9.318,43.2,11.957,47.097,11.929,47.489z"/>
	   <path class="eltdf-checkmark-svg-path-2" fill="#FF1949" d="M59.983,0.002c-0.058-0.052-1.246,0.729-1.303,0.764c-0.603,0.353-6.72,4.257-7.037,4.489
		   c-0.186,0.138-5.435,3.866-5.683,4.053c-0.452,0.342-4.029,3.245-4.215,3.398c-1.215,1.01-5.398,4.701-6.337,5.468
		   c-1.137,0.927-2.073,2.048-3.118,3.09c-0.497,0.496-10.65,9.654-10.82,9.808c-0.186,0.169-3.268,3.702-4.097,4.507
		   c-0.197,0.191-0.278,0.123-0.398-0.043c-0.204,0.339-0.483,0.643-0.82,0.891c-0.2,0.178-0.385,0.372-0.559,0.578
		   c-0.318,0.445-0.608,0.91-0.907,1.368c-0.437,0.664-0.889,1.315-1.31,1.99c-0.872,1.399-1.675,2.839-2.455,4.291
		   c-0.094,0.174-0.208,0.33-0.336,0.469c0.719,1.128,1.354,2.174,1.34,2.366c-0.027,0.378,1.011,0.694,1.295,0.735
		   c0.271,0.039,1.286,0.308,1.406,0.429c0.114,0.113,3.053-0.087,3.229-0.404c0.051-0.095,3.297-4.079,3.387-4.196
		   c0.648-0.865,3.896-3.606,4.701-4.168c0.299-0.209,1.292-0.993,1.524-1.171c1.125-0.869,2.159-1.814,3.205-2.773
		   c0.359-0.328,4.164-4.141,4.639-4.723c0.332-0.405,5.779-6.44,6.245-6.898c0.115-0.112,8.245-10.029,8.408-10.217
		   c0.139-0.159,1.111-1.127,1.202-1.268c0.156-0.238,1.699-2.5,1.822-2.708c0.021-0.036,1.418-1.591,1.449-1.615
		   c0.185-0.137,3.052-3.913,2.94-3.913c-0.071,0-0.567,0.143-0.645,0.165c-0.124,0.038-1.724,1.131-1.732,1.132
		   C54.9,5.9,55.239,5.647,55.253,5.639c0.146-0.099,2.286-1.731,2.513-1.885c0.189-0.127,0.438-0.421,0.651-0.481
		   c0.136-0.038,1.078-0.684,1.076-0.743c0-0.002-0.654,0.314-0.71,0.341C58.495,3.01,58.2,3.018,57.925,3.152
		   c-0.641,0.31-2.312,1.563-2.797,1.878c-0.278,0.179-0.884,0.728-1.248,0.728c-0.022,0,0.34-0.334,0.375-0.361
		   c0.168-0.128,0.37-0.207,0.542-0.334c0.145-0.109,1.19-0.683,1.19-0.792c-0.023-0.004-0.048-0.011-0.07-0.022
		   c0-0.092,1.995-1.559,2.299-1.76c0.169-0.112,0.413-0.205,0.179-0.286c-0.183-0.063-0.218-0.089-0.473-0.029
		   c-0.199,0.049-0.301-0.196-0.172-0.33C57.983,1.604,60.212,0.287,59.983,0.002z"/>
   </g>
   </svg>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_rotate_circles' ) ) {
	function academist_elated_loading_spinner_rotate_circles() {
		$html = '';
		$html .= '<div class="eltdf-rotate-circles">';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_pulse' ) ) {
	function academist_elated_loading_spinner_pulse() {
		$html = '<div class="pulse"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_double_pulse' ) ) {
	function academist_elated_loading_spinner_double_pulse() {
		$html = '';
		$html .= '<div class="double_pulse">';
		$html .= '<div class="double-bounce1"></div>';
		$html .= '<div class="double-bounce2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_cube' ) ) {
	function academist_elated_loading_spinner_cube() {
		$html = '<div class="cube"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_rotating_cubes' ) ) {
	function academist_elated_loading_spinner_rotating_cubes() {
		$html = '';
		$html .= '<div class="rotating_cubes">';
		$html .= '<div class="cube1"></div>';
		$html .= '<div class="cube2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_stripes' ) ) {
	function academist_elated_loading_spinner_stripes() {
		$html = '';
		$html .= '<div class="stripes">';
		$html .= '<div class="rect1"></div>';
		$html .= '<div class="rect2"></div>';
		$html .= '<div class="rect3"></div>';
		$html .= '<div class="rect4"></div>';
		$html .= '<div class="rect5"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_wave' ) ) {
	function academist_elated_loading_spinner_wave() {
		$html = '';
		$html .= '<div class="wave">';
		$html .= '<div class="bounce1"></div>';
		$html .= '<div class="bounce2"></div>';
		$html .= '<div class="bounce3"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_two_rotating_circles' ) ) {
	function academist_elated_loading_spinner_two_rotating_circles() {
		$html = '';
		$html .= '<div class="two_rotating_circles">';
		$html .= '<div class="dot1"></div>';
		$html .= '<div class="dot2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_five_rotating_circles' ) ) {
	function academist_elated_loading_spinner_five_rotating_circles() {
		$html = '';
		$html .= '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_atom' ) ) {
	function academist_elated_loading_spinner_atom() {
		$html = '';
		$html .= '<div class="atom">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_clock' ) ) {
	function academist_elated_loading_spinner_clock() {
		$html = '';
		$html .= '<div class="clock">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_mitosis' ) ) {
	function academist_elated_loading_spinner_mitosis() {
		$html = '';
		$html .= '<div class="mitosis">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_lines' ) ) {
	function academist_elated_loading_spinner_lines() {
		$html = '';
		$html .= '<div class="lines">';
		$html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_fussion' ) ) {
	function academist_elated_loading_spinner_fussion() {
		$html = '';
		$html .= '<div class="fussion">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_wave_circles' ) ) {
	function academist_elated_loading_spinner_wave_circles() {
		$html = '';
		$html .= '<div class="wave_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'academist_elated_loading_spinner_pulse_circles' ) ) {
	function academist_elated_loading_spinner_pulse_circles() {
		$html = '';
		$html .= '<div class="pulse_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}
