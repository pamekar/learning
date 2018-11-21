<?php
defined( 'ABSPATH' ) || exit();

abstract class WC_Product_Elatedf_Abstract extends WC_Abstract_Legacy_Product {

    /**
     * BY ELATED
     *
     * This is the name of this object type.
     * @var string
     */
    protected $object_type;

    private function set_object_type($type) {
        $this->object_type = $type;
    }

    public function get_object_type() {
        return $this->object_type;
    }

    /**
     * BY ELATED
     *
     * Post type.
     * @var string
     */
    protected $post_type;

    private function set_post_type($type) {
        $this->post_type = $type;
    }

    public function get_post_type() {
        return $this->post_type;
    }

    /**
     * BY ELATED
     *
     * Cache group.
     * @var string
     */
    protected $cache_group;

    private function set_cache_group() {
        $this->cache_group = 'eltdf-products';
    }

    public function get_cache_group() {
        return $this->cache_group;
    }

    protected $data = array(
        'name'               => '',
        'price'              => '',
        'sold_individually'  => false,
        'status'             => true,
        'stock_status'       => 'instock',
        'stock_quantity'     => null,
    );

    /**
     * Get the product if ID is passed, otherwise the product is new and empty.
     * This class should NOT be instantiated, but the wc_get_product() function
     * should be used. It is possible, but the wc_get_product() is preferred.
     *
     * @param int|WC_Product|object $product Product to init.
     */
    public function __construct( $product = 0 ) {
        parent::__construct( $product );
        if ( is_numeric( $product ) && $product > 0 ) {
            $this->set_id( $product );
        } elseif ( $product instanceof self ) {
            $this->set_id( absint( $product->get_id() ) );
        } elseif ( ! empty( $product->ID ) ) {
            $this->set_id( absint( $product->ID ) );
        } else {
            $this->set_object_read( true );
        }

        /* BY ELATED */
        $post_type = get_post_type($this->get_id());
        $this->set_prop('name', get_the_title($this->get_id()));
        $this->set_prop('price', $this->generate_price());
        $this->set_prop('sold_individually', $this->generate_sold_individually());
        $this->set_prop('stock_status', $this->generate_stock_status());
        $this->set_prop('stock_quantity', $this->generate_stock_quantity());

        $this->set_post_type($post_type);
        $this->set_object_type($post_type);
        $this->set_cache_group();

        /* BY ELATED */
        $this->data_store = WC_Data_Store::load( $this->get_object_type() );
        if ( $this->get_id() > 0 ) {
            $this->data_store->read( $this );
        }
    }

    /**
     *  BY ELATED
     * @param id - id of product
     *
     */
    abstract protected function generate_price();
    abstract protected function generate_sold_individually();
    abstract protected function generate_stock_status();
    abstract protected function generate_stock_quantity();



    public function get_type() {
        return $this->get_object_type();
    }

    public function is_type( $type ) {
        return ( $this->get_object_type() === $type || ( is_array( $type ) && in_array( $this->get_object_type(), $type ) ) );
    }

    public function get_parent_id( $context = 'view' ) {
        return $this->get_prop( 'parent_id', $context );
    }

    public function add_to_cart_url() {
        return apply_filters( 'academist_checkout_add_to_cart_url', $this->get_permalink(), $this );
    }

    /**
     * Product permalink.
     * @return string
     */
    public function get_permalink() {
        return get_permalink( $this->get_id() );
    }

    /**
     * Get product status.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_status( $context = 'view' ) {
        return $this->get_prop( 'status', $context );
    }

    /**
     * Check if a product is sold individually (no quantities).
     *
     * @return bool
     */
    public function is_sold_individually() {
        return apply_filters( 'academist_checkout_is_sold_individually', true === $this->get_sold_individually(), $this );
    }

    /**
     * Return if should be sold individually.
     *
     * @param  string $context
     * @since 3.0.0
     * @return boolean
     */
    public function get_sold_individually( $context = 'view' ) {
        return $this->get_prop( 'sold_individually', $context );
    }

    /**
     * Returns false if the product cannot be bought.
     *
     * @return bool
     */
    public function is_purchasable() {
        return apply_filters( 'academist_checkout_is_purchasable', $this->exists(), $this );
    }

    /**
     * Returns whether or not the product is in stock.
     *
     * @return bool
     */
    public function is_in_stock() {
        return apply_filters( 'academist_checkout_is_in_stock', 'instock' === $this->get_stock_status(), $this );
    }

    /**
     * Return the stock status.
     *
     * @param  string $context
     * @since 3.0.0
     * @return string
     */
    public function get_stock_status( $context = 'view' ) {
        return $this->get_prop( 'stock_status', $context );
    }

    /**
     * Returns whether or not the product has enough stock for the order.

     * @return bool
     */
    public function has_enough_stock() {
        return true;
    }

    /**
     * Returns whether or not the product is stock managed.
     *
     * @return bool
     */
    public function managing_stock() {
        return false;
    }

    /**
     * Returns the tax class.
     *
     * @return string
     */
    public function get_tax_class() {
        return '';
    }

    /**
     * Returns the tax status.
     *
     * @return string
     */
    public function get_tax_status() {
        return 'none';
    }

    /**
     * If the stock level comes from another product ID, this should be modified.
     * @since  3.0.0
     * @return int
     */
    public function get_stock_managed_by_id() {
        return $this->get_id();
    }

    /**
     * Returns whether or not the product is visible in the catalog.
     *
     * @return bool
     */
    public function is_visible() {
        return true;
    }

    /**
     * Get SKU (Stock-keeping unit) - product unique ID.
     *
     * @return string
     */
    public function get_sku() {
        return '';
    }

    /**
     * Returns whether or not the product needs to notify the customer on backorder.
     *
     * @return bool
     */
    public function backorders_require_notification() {
        return false;
    }

    /**
     * Get max quantity which can be purchased at once.
     *
     * @since  3.0.0
     * @return int Quantity or -1 if unlimited.
     */
    public function get_max_purchase_quantity() {
        return $this->is_sold_individually() ? 1 : $this->get_stock_quantity();
    }

    /**
     * Returns number of items available for sale.
     *
     * @param  string $context
     * @return int|null
     */
    public function get_stock_quantity( $context = 'view' ) {
        return $this->get_prop( 'stock_quantity', $context );
    }

	/**
	 * Checks if an order needs display the shipping address, based on shipping method.
	 * @return bool
	 */

	public function needs_shipping() {
		return false;
	}

    /**
     * Returns the main product image.
     *
     * @param string $size (default: 'shop_thumbnail')
     * @param array $attr
     * @param bool $placeholder True to return $placeholder if no image is found, or false to return an empty string.
     * @return string
     */
    public function get_image( $size = 'shop_thumbnail', $attr = array(), $placeholder = true ) {
        if ( has_post_thumbnail( $this->get_id() ) ) {
            $image = get_the_post_thumbnail( $this->get_id(), $size, $attr );
        } elseif ( ( $parent_id = wp_get_post_parent_id( $this->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
            $image = get_the_post_thumbnail( $parent_id, $size, $attr );
        } elseif ( $placeholder ) {
            $image = wc_placeholder_img( $size );
        } else {
            $image = '';
        }
        
        return apply_filters( 'academist_checkout_get_image', wc_get_relative_url( $image ), $this, $size, $attr, $placeholder );
    }

    /**
     * Get main image ID.
     *
     * @since 3.0.0
     * @param  string $context What the value is for. Valid values are view and edit.
     * @return string
     */
    public function get_image_id( $context = 'view' ) {
        return academist_elated_get_attachment_id_from_url($this->get_image());
    }

    /**
     * Checks if a product is downloadable.
     *
     * @return bool
     */
    public function is_downloadable() {
        return false;
    }

    /**
     * Returns whether or not the product is taxable.
     *
     * @return bool
     */
    public function is_taxable() {
        return false;
    }

    /**
     * Get cross sell IDs.
     *
     * @since 3.0.0
     * @return array
     */
    public function get_cross_sell_ids() {
        return array();
    }

    /**
     * Get product name.
     *
     * @since 3.0.0
     * @param  string $context
     * @return string
     */
    public function get_name( $context = 'view' ) {
        return $this->get_prop( 'name', $context );
    }

    /**
     * Returns whether or not the product post exists.
     *
     * @return bool
     */
    public function exists() {
        return false !== $this->get_status();
    }

    /**
     * Returns the product's active price.
     *
     * @param  string $context
     * @return string price
     */
    public function get_price( $context = 'view' ) {
        return $this->get_prop( 'price', $context );
    }

    /**
     * Get purchase note.
     *
     * @since 3.0.0
     * @return string
     */
    public function get_purchase_note() {
        return '';
    }


    /**
     * BY ELATED
     *
     * Get the add to cart button text for the single page.
     *
     * @return string
     */
    public function single_add_to_cart_text() {
        return apply_filters( 'academist_checkout_' . $this->get_object_type() . '_single_add_to_cart_text', esc_html__( 'Add to cart', 'eltdf-checkout' ), $this );
    }

    /**
     * BY ELATED
     *
     * Get the add to cart button text.
     *
     * @return string
     */
    public function add_to_cart_text() {
        return apply_filters( 'academist_checkout_' . $this->get_object_type() . '_product_add_to_cart_text', esc_html__( 'Read more', 'eltdf-checkout' ), $this );
    }

}