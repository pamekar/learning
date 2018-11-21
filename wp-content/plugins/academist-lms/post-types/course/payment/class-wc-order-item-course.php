<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WC_Order_Item_Course extends WC_Order_Item_Elatedf {

    public function __construct($product = 0) {
        $this->set_post_type();
        parent::__construct($product);
    }

    function set_post_type() {
        $this->custom_post_type = 'course';
    }
}