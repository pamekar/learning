<?php

include ELATED_FRAMEWORK_ICONS_ROOT_DIR . '/icons-pack-interface.php';

foreach ( glob( ELATED_FRAMEWORK_ICONS_ROOT_DIR . '/*/load.php' ) as $module_load ) {
	if ( academist_elated_is_customizer_item_enabled( $module_load, 'academist_performance_disable_icon_pack_' ) ) {
		include_once $module_load;
	}
}

if ( ! function_exists( 'academist_elated_get_icon_pack_collections' ) ) {
	function academist_elated_get_icon_pack_collections() {
		$options = apply_filters( 'academist_elated_filter_add_icon_pack_into_collection', $options = array() );
		
		return $options;
	}
	
	add_action( 'after_setup_theme', 'academist_elated_get_icon_pack_collections' );
}

if ( ! function_exists( 'academist_elated_get_icon_pack_options' ) ) {
	function academist_elated_get_icon_pack_options() {
		$options = apply_filters( 'academist_elated_filter_add_icon_pack_into_options', $options = array() );
		
		return $options;
	}
	
	add_action( 'after_setup_theme', 'academist_elated_get_icon_pack_options' );
}

if ( ! function_exists( 'academist_elated_get_icon_pack_social_options' ) ) {
	function academist_elated_get_icon_pack_social_options() {
		$options = apply_filters( 'academist_elated_filter_add_icon_pack_into_social_options', $options = array() );
		
		return $options;
	}
	
	add_action( 'after_setup_theme', 'academist_elated_get_icon_pack_social_options' );
}

/*
 * Class: AcademistElatedClassIconCollections
 */
class AcademistElatedClassIconCollections {
    private static $instance;
    public $iconCollections;
    public $VCParamsArray;
    public $iconPackParamName;
    
	private $iconPackCollections;
	private $iconPackOptions;
	private $iconPackSocialOptions;
	
	private function __construct() {
		$this->iconPackParamName     = 'icon_pack';
		$this->iconPackCollections   = academist_elated_get_icon_pack_collections();
		$this->iconPackOptions       = academist_elated_get_icon_pack_options();
		$this->iconPackSocialOptions = academist_elated_get_icon_pack_social_options();
		
		$this->initIconCollections();
	}

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Method that adds individual collections to set of collections
     */
	private function initIconCollections() {
		$collections = $this->getIconPackCollections();
		
		if ( ! empty( $collections ) ) {
			foreach ( $collections as $key => $value ) {
				$this->addIconCollection( $key, $value );
			}
		}
	}
	
	public function getIconsMetaBoxOrOption( $attributes ) {
		$scope            = '';
		$label            = '';
		$parent           = '';
		$name             = '';
		$defaul_icon_pack = '';
		$default_icon     = '';
		$type             = '';
		$field_type       = '';
		
		extract( $attributes );
		
		$icon_collections = $this->getCollectionsWithSocialIcons();
		$options          = $this->getIconPackSocialOptions();
		
		if ( $scope == 'regular' ) {
			$options = $this->getIconPackOptions();
		}
		
		if ( $type == 'meta-box' ) {
			academist_elated_create_meta_box_field(
				array(
					'parent'        => $parent,
					'type'          => 'select' . $field_type,
					'name'          => $name,
					'default_value' => $defaul_icon_pack,
					'label'         => $label,
					'options'       => $options
				)
			);
		} else if ( $type == 'option' ) {
			academist_elated_add_admin_field(
				array(
					'parent'        => $parent,
					'type'          => 'select' . $field_type,
					'name'          => $name,
					'default_value' => $defaul_icon_pack,
					'label'         => $label,
					'options'       => $options
				)
			);
		}
		
		foreach ( $icon_collections as $collection_key => $collection_object ) {
			if ( $scope == 'regular' ) {
				$icons_array = $collection_object->getIconsArray();
			} else {
				$icons_array = $collection_object->getSocialIconsArray();
			}
			
			$icon_collections_keys = array_keys( $icon_collections );
			
			unset( $icon_collections_keys[ array_search( $collection_key, $icon_collections_keys ) ] );
			
			$icon_hide_values = $icon_collections_keys;
			array_push( $icon_hide_values, '' ); //add empty value for icon switcher
			
			$icon_pack_container = academist_elated_add_admin_container(
				array(
					'parent'     => $parent,
					'name'       => $name . '_' . $collection_object->param . '_container',
					'simple'     => $field_type == 'simple' ? true : false,
					'dependency' => array(
						'hide' => array(
							$name => $icon_hide_values
						)
					)
				)
			);
			
			if ( $type == 'meta-box' ) {
				academist_elated_create_meta_box_field(
					array(
						'parent'        => $icon_pack_container,
						'type'          => 'select' . $field_type,
						'name'          => $name . '_' . $collection_object->param,
						'default_value' => $default_icon,
						'label'         => $collection_object->title,
						'options'       => $icons_array
					)
				);
			} else if ( $type == 'option' ) {
				academist_elated_add_admin_field(
					array(
						'parent'        => $icon_pack_container,
						'type'          => 'select' . $field_type,
						'name'          => $name . '_' . $collection_object->param,
						'default_value' => $default_icon,
						'label'         => $collection_object->title,
						'options'       => $icons_array
					)
				);
			}
		}
	}
	
	public function getVCParamsArray( $iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false ) {
		if ( $emptyIconPack ) {
			$iconCollectionsVC = $this->getIconCollectionsVCEmpty();
		} else {
			$iconCollectionsVC = $this->getIconCollectionsVC();
		}
		
		$iconPackParams = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Pack', 'academist' ),
			'param_name'  => $this->iconPackParamName,
			'value'       => $iconCollectionsVC,
			'save_always' => true
		);
		
		if ( $iconPackDependency !== "" ) {
			$iconPackParams["dependency"] = $iconPackDependency;
		}
		
		$iconPackParams = array( $iconPackParams );
		
		$iconSetParams = array();
		if ( is_array( $this->iconCollections ) && count( $this->iconCollections ) ) {
			foreach ( $this->iconCollections as $key => $collection ) {
				$iconSetParams[] = array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Icon', 'academist' ),
					'param_name'  => $iconCollectionPrefix . $collection->param,
					'value'       => $collection->getIconsArray(),
					'dependency'  => array( 'element' => $this->iconPackParamName, 'value' => array( $key ) ),
					'save_always' => true
				);
			}
		}
		
		return array_merge( $iconPackParams, $iconSetParams );
	}
	
	public function getSocialVCParamsArray( $iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false ) {
		if ( $emptyIconPack ) {
			$iconCollectionsVC = $this->getSocialIconCollectionsVCEmpty();
		} else {
			$iconCollectionsVC = $this->getSocialIconCollectionsVC();
		}
		
		$iconPackParams = array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Pack', 'academist' ),
			'param_name'  => $this->iconPackParamName,
			'value'       => $iconCollectionsVC,
			'save_always' => true
		);
		
		if ( $iconPackDependency !== "" ) {
			$iconPackParams["dependency"] = $iconPackDependency;
		}
		
		$iconPackParams = array( $iconPackParams );

        $iconSetParams = array();
        if ( is_array( $this->iconCollections ) && count( $this->iconCollections ) ) {
            foreach ( $this->iconCollections as $key => $collection ) {
                if($collection->hasSocialIcons()) {
                    $iconSetParams[] = array(
                        'type'        => 'dropdown',
                        'class'       => '',
                        'heading'     => esc_html__( 'Icon', 'academist' ),
                        'param_name'  => $iconCollectionPrefix . $collection->param,
                        'value'       => $collection->getSocialIconsArrayVC(),
                        'dependency'  => array( 'element' => $this->iconPackParamName, 'value' => array( $key ) ),
                        'save_always' => true
                    );
                }
            }
        }
		
		return array_merge( $iconPackParams, $iconSetParams );
	}
	
	public function getIconWidgetParamsArray() {
		$iconPackParams[] = array(
			'type'    => 'dropdown',
			'name'    => 'icon_pack',
			'title'   => esc_html__( 'Icon Pack', 'academist' ),
			'options' => $this->getIconPackOptions()
		);
		
		$iconSetParams = array();
		if ( is_array( $this->iconCollections ) && count( $this->iconCollections ) ) {
			foreach ( $this->iconCollections as $key => $collection ) {
				$iconSetParams[] = array(
					'type'    => 'dropdown',
					'title'   => $collection->title . esc_html__( ' Icon', 'academist' ),
					'name'    => $collection->param,
					'options' => array_flip( $collection->getIconsArray() )
				);
			}
		}
		
		return array_merge( $iconPackParams, $iconSetParams );
	}
	
	public function getSocialIconWidgetMultipleParamsArray( $count ) {
		$iconOps           = array();
		$iconCollectionsVC = $this->getCollectionsWithSocialIcons();
		
		$iconPackParams[] = array(
			'type'    => 'dropdown',
			'name'    => 'icon_pack',
			'title'   => esc_html__( 'Icon Pack', 'academist' ),
			'options' => $this->getIconPackSocialOptions()
		);
		
		for ( $n = 1; $n <= $count; $n ++ ) {
			if ( is_array( $iconCollectionsVC ) && count( $iconCollectionsVC ) ) {
				foreach ( $iconCollectionsVC as $key => $collection ) {
					$iconOps[] = array(
						'type'    => 'dropdown',
						'name'    => $collection->param . '_' . $n,
						'title'   => sprintf( esc_html__( 'Icon %s %s Icon', 'academist' ), $n, $collection->title ),
						'options' => array_flip( $collection->getSocialIconsArrayVC() )
					);
				}
			}
			
			$iconOps[] = array(
				'type'  => 'textfield',
				'name'  => 'link_' . $n,
				'title' => sprintf( esc_html__( 'Link %s', 'academist' ), $n )
			);
			
			$iconOps[] = array(
				'type'    => 'dropdown',
				'name'    => 'target_' . $n,
				'title'   => sprintf( esc_html__( 'Link Target %s', 'academist' ), $n ),
				'options' => academist_elated_get_link_target_array()
			);
		}
		
		return array_merge( $iconPackParams, $iconOps );
	}
	
	public function getSocialIconWidgetParamsArray() {
		$iconCollectionsVC = $this->getCollectionsWithSocialIcons();
		
		$iconPackParams[] = array(
			'type'    => 'dropdown',
			'title'   => esc_html__( 'Icon Pack', 'academist' ),
			'name'    => 'icon_pack',
			'options' => $this->getIconPackSocialOptions()
		);
		
		$iconSetParams = array();
		if ( is_array( $iconCollectionsVC ) && count( $iconCollectionsVC ) ) {
			foreach ( $iconCollectionsVC as $key => $collection ) {
				$iconSetParams[] = array(
					'type'    => 'dropdown',
					'title'   => $collection->title . esc_html__( ' Icon', 'academist' ),
					'name'    => $collection->param,
					'options' => array_flip( $collection->getSocialIconsArrayVC() )
				);
			}
		}
		
		return array_merge( $iconPackParams, $iconSetParams );
	}
	
	public function getCollectionsWithIcons() {
		$collectionsWithIcons = array();
		
		foreach ( $this->iconCollections as $key => $collection ) {
			$collectionsWithIcons[ $key ] = $collection;
		}
		
		return $collectionsWithIcons;
	}
	
	public function getCollectionsWithSocialIcons() {
		$collectionsWithSocial = array();
		
		foreach ( $this->iconCollections as $key => $collection ) {
			if ( $collection->hasSocialIcons() ) {
				$collectionsWithSocial[ $key ] = $collection;
			}
		}
		
		return $collectionsWithSocial;
	}
	
	public function getIconSizesArray() {
		return array(
			esc_html__( 'Tiny', 'academist' )       => 'fa-lg',
			esc_html__( 'Small', 'academist' )      => 'fa-2x',
			esc_html__( 'Medium', 'academist' )     => 'fa-3x',
			esc_html__( 'Large', 'academist' )      => 'fa-4x',
			esc_html__( 'Very Large', 'academist' ) => 'fa-5x'
		);
	}
	
	public function getIconSizeClass( $iconSize ) {
		switch ( $iconSize ) {
			case "fa-lg":
				$iconSize = "eltdf-tiny-icon";
				break;
			case "fa-2x":
				$iconSize = "eltdf-small-icon";
				break;
			case "fa-3x":
				$iconSize = "eltdf-medium-icon";
				break;
			case "fa-4x":
				$iconSize = "eltdf-large-icon";
				break;
			case "fa-5x":
				$iconSize = "eltdf-huge-icon";
				break;
			default:
				$iconSize = "eltdf-small-icon";
		}
		
		return $iconSize;
	}
	
	/**
	 * @return array
	 */
	public function getIconPackCollections() {
		return $this->iconPackCollections;
	}
	
	/**
	 * @return array
	 */
	public function getIconPackOptions() {
		return $this->iconPackOptions;
	}
	
	/**
	 * @return array
	 */
	public function getIconPackSocialOptions() {
		return $this->iconPackSocialOptions;
	}
	
	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public function getIconCollectionParamNameByKey( $key ) {
		$collection = $this->getIconCollection( $key );
		
		if ( $collection ) {
			return $collection->param;
		}
		
		return false;
	}
	
	public function getShortcodeParams( $iconCollectionPrefix = "" ) {
		$iconCollectionsParam = array();
		foreach ( $this->iconCollections as $key => $collection ) {
			$iconCollectionsParam[ $iconCollectionPrefix . $collection->param ] = '';
		}
		
		return array_merge( array( $this->iconPackParamName => '', ), $iconCollectionsParam );
	}
	
	public function addIconCollection( $key, $value ) {
		$this->iconCollections[ $key ] = $value;
	}
	
	public function getIconCollection( $key ) {
		if ( array_key_exists( $key, $this->iconCollections ) ) {
			return $this->iconCollections[ $key ];
		}
		
		return false;
	}
	
	public function getIconCollectionIcons( iAcademistElatedInterfaceIconCollection $collection ) {
		return $collection->getIconsArray();
	}
	
	public function getIconCollectionsVC() {
		$vc_array = array();
		foreach ( $this->iconCollections as $key => $collection ) {
			$vc_array[ $collection->title ] = $key;
		}
		
		return $vc_array;
	}

    public function getSocialIconCollectionsVC() {
        $vc_array = array();
        foreach ( $this->iconCollections as $key => $collection ) {
            if($collection->hasSocialIcons()) {
                $vc_array[ $collection->title ] = $key;
            }
        }

        return $vc_array;
    }
	
	public function getIconCollectionsVCExclude( $exclude ) {
		$array = $this->getIconCollectionsVC();
		
		if ( is_array( $exclude ) && count( $exclude ) ) {
			foreach ( $exclude as $key ) {
				if ( ( $x = array_search( $key, $array ) ) !== false ) {
					unset( $array[ $x ] );
				}
			}
			
		} else {
			if ( ( $x = array_search( $exclude, $array ) ) !== false ) {
				unset( $array[ $x ] );
			}
		}
		
		return $array;
	}
	
	public function getIconCollectionsKeys() {
		return array_keys( $this->iconCollections );
	}
	
	/**
	 * Method that returns an array of 'param' attribute of each icon collection
	 * @return array array of param attributes
	 */
	public function getIconCollectionsParams() {
		$paramArray = array();
		if ( is_array( $this->iconCollections ) && count( $this->iconCollections ) ) {
			foreach ( $this->iconCollections as $key => $obj ) {
				$paramArray[] = $obj->param;
			}
		}
		
		return $paramArray;
	}
	
	/**
	 * Method that returns an array of 'param' attribute of each icon collection with social icons
	 * @return array array of param attributes
	 */
	public function getSocialIconCollectionsParams() {
		$paramArray = array();
		
		if ( is_array( $this->getCollectionsWithSocialIcons() ) && count( $this->getCollectionsWithSocialIcons() ) ) {
			foreach ( $this->getCollectionsWithSocialIcons() as $key => $obj ) {
				$paramArray[] = $obj->param;
			}
		}
		
		return $paramArray;
	}
	
	public function getIconCollections() {
		$array = array();
		
		foreach ( $this->iconCollections as $key => $collection ) {
			$array[ $key ] = $collection->title;
		}
		
		return $array;
	}
	
	public function getIconCollectionsEmpty( $no_empty_key = "" ) {
		$array                  = array();
		$array[ $no_empty_key ] = esc_html__( 'No Icon', 'academist' );
		
		foreach ( $this->iconCollections as $key => $collection ) {
			$array[ $key ] = $collection->title;
		}
		
		return $array;
	}
	
	public function getIconCollectionsVCEmpty() {
		$vc_array                                           = array();
		$vc_array[ esc_html__( 'No Icon', 'academist' ) ] = '';
		
		foreach ( $this->iconCollections as $key => $collection ) {
			$vc_array[ $collection->title ] = $key;
		}
		
		return $vc_array;
	}

    public function getSocialIconCollectionsVCEmpty() {
        $vc_array                                           = array();
        $vc_array[ esc_html__( 'No Icon', 'academist' ) ] = '';

        foreach ( $this->iconCollections as $key => $collection ) {
            if($collection->hasSocialIcons()) {
                $vc_array[ $collection->title ] = $key;
            }
        }

        return $vc_array;
    }
	
	public function getIconCollectionsVCEmptyExclude( $key ) {
		$array = $this->getIconCollectionsVCEmpty();
		
		if ( ( $x = array_search( $key, $array ) ) !== false ) {
			unset( $array[ $x ] );
		}
		
		return $array;
	}
	
	public function getIconCollectionsExclude( $exclude ) {
		$array = $this->getIconCollections();
		
		if ( is_array( $exclude ) && count( $exclude ) ) {
			foreach ( $exclude as $exclude_key ) {
				if ( array_key_exists( $exclude_key, $array ) ) {
					unset( $array[ $exclude_key ] );
				}
			}
		} else {
			if ( array_key_exists( $exclude, $array ) ) {
				unset( $array[ $exclude ] );
			}
		}
		
		return $array;
	}
	
	public function hasIconCollection( $key ) {
		return array_key_exists( $key, $this->iconCollections );
	}
	
	/**
	 * Method that renders icon for given icon pack
	 *
	 * @param $icon string to render
	 * @param $iconPack string to render icon from
	 * @param $params array for icon
	 *
	 * @return mixed
	 */
	public function renderIcon( $icon, $iconPack, $params = array() ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconObject = $this->getIconCollection( $iconPack );
			
			return $iconObject->render( $icon, $params );
		}
	}
	
	public function enqueueStyles() {
		if ( is_array( $this->iconCollections ) && count( $this->iconCollections ) ) {
			foreach ( $this->iconCollections as $collection_key => $collection_obj ) {
				wp_enqueue_style( 'eltdf-' . str_replace('_', '-', $collection_key), $collection_obj->styleUrl );
			}
		}
	}
	
	# HEADER AND SIDE MENU ICONS
	public function getSearchIcon( $iconPack, $return ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getSearchIcon();
			
			if ( $return ) {
				return $iconHTML;
			} else {
				echo wp_kses_post( $iconHTML );
			}
		}
	}
	
	public function getSearchClose( $iconPack, $return ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getSearchClose();
			
			if ( $return ) {
				return $iconHTML;
			} else {
				echo wp_kses_post( $iconHTML );
			}
		}
	}
	
	public function getDropdownCartIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getDropdownCartIcon();
			
			echo wp_kses_post( $iconHTML );
		}
	}

	public function getFullScreenMenuIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getFullScreenMenuIcon();

			echo wp_kses_post( $iconHTML );
		}
	}
	
	public function getMenuIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getMenuIcon();
			
			echo wp_kses_post( $iconHTML );
		}
	}
	
	public function getMenuCloseIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getMenuCloseIcon();
			
			echo wp_kses_post( $iconHTML );
		}
	}
	
	public function getBackToTopIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getBackToTopIcon();
			
			echo wp_kses_post( $iconHTML );
		}
	}
	
	public function getMobileMenuIcon( $iconPack, $return = false ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getMobileMenuIcon();
			
			if ( $return ) {
				return $iconHTML;
			} else {
				echo wp_kses_post( $iconHTML );
			}
		}
	}
	
	public function getQuoteIcon( $iconPack, $return = false ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			$iconHTML    = $iconsObject->getQuoteIcon();
			
			if ( $return ) {
				return $iconHTML;
			} else {
				echo wp_kses_post( $iconHTML );
			}
		}
	}
	
	# SOCIAL SIDEBAR ICONS
	public function getFacebookIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getFacebookIcon();
		}
	}
	
	public function getTwitterIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getTwitterIcon();
		}
	}
	
	public function getGooglePlusIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getGooglePlusIcon();
		}
	}
	
	public function getLinkedInIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getLinkedInIcon();
		}
	}
	
	public function getTumblrIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getTumblrIcon();
		}
	}
	
	public function getPinterestIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getPinterestIcon();
		}
	}
	
	public function getVKIcon( $iconPack ) {
		if ( $this->hasIconCollection( $iconPack ) ) {
			$iconsObject = $this->getIconCollection( $iconPack );
			
			return $iconsObject->getVKIcon();
		}
	}
}