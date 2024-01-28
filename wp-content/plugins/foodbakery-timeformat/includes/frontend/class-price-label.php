<?php
// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Price Label Change
 */
class class_price_label
{

    /**
     * Constructor
     */
    public function __construct(){
       add_filter('after_price_label', array($this, 'after_price_label_callback'));
    }
    
    public function after_price_label_callback(){
        
        return ' Inc. Tax.';
    }

}

new class_price_label();
