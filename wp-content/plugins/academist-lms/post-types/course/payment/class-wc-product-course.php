<?php
defined( 'ABSPATH' ) || exit();

class WC_Product_Course extends WC_Product_Elatedf_Abstract {


    /**
     * Get the product if ID is passed, otherwise the product is new and empty.
     * This class should NOT be instantiated, but the wc_get_product() function
     * should be used. It is possible, but the wc_get_product() is preferred.
     *
     * @param int|WC_Product|object $product Product to init.
     */
    public function __construct( $product = 0 ) {
        parent::__construct( $product );

    }

    function generate_price() {
        return academist_lms_calculate_course_price($this->get_id());
    }

    function generate_sold_individually() {
        return true;
    }

    function generate_stock_status() {
        return 'instock';
    }

    function generate_stock_quantity() {
        return null;
    }

}