<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Restaurants_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Restaurants extends Widget_Base
{

    public function get_name()
    {
        return 'foodbakery_restaurants';
    }

    public function get_title()
    {
        return 'Restaurants';
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['foodbakery'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content' , [
                'label' => 'Settings' ,
            ]
        );

        $this->add_control(
            'restaurants_title' , [
                'label' => __('Element Title' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        $this->add_control(
            'restaurants_subtitle' , [
                'label' => __('Section Sub Title' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        
        $this->add_control(
            'foodbakery_var_restaurants_align' , [
                'label' => __('Title Alignment' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'align-left' => __('Align Left' , 'foodbakery-elementor') ,
                    'align-right' => __('Align Right' , 'foodbakery-elementor') ,
                    'align-center' => __('Align Center' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'align-left' ,
            ]
        );
        
        $this->add_control(
            'foodbakery_var_restaurants_total_num' , [
                'label' => __('Show Restaurant Count' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );

        $this->add_control(
            'restaurant_view' , [
                'label' => __('Default View' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'fancy' => __('Fancy' , 'foodbakery-elementor') ,
                    'grid' => __('Grid' , 'foodbakery-elementor') ,
                    'list' => __('List' , 'foodbakery-elementor') ,
                    'simple' => __('Simple' , 'foodbakery-elementor') ,
                    'fancy-grid' => __('Fancy Grid' , 'foodbakery-elementor') ,
                    'classic-grid' => __('Classic Grid' , 'foodbakery-elementor') ,
                    'grid-slider' => __('Grid Slider' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'simple' ,
            ]
        );
        
        $this->add_control(
            'search_box' , [
                'label' => __('Left Filters' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'left_filter_count' , [
                'label' => __('Left Filters Counts' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'open_close_show_labels' , [
                'label' => __('Show Open/Close Labels' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'open_close_filter_switch' , [
                'label' => __('Open/Close Filter' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'open_close_default_filter' , [
                'label' => __('Default Open/Close Filter' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'all' => __('All' , 'foodbakery-elementor') ,
                    'open' => __('Open' , 'foodbakery-elementor') ,
                    'close' => __('Close' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'all' ,
            ]
        );
        
        $this->add_control(
            'pre_order_filter_switch' , [
                'label' => __('Pre Orders Filter' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'restaurant_sort_by' , [
                'label' => __('Sort By' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'restaurant_search_keyword' , [
                'label' => __('Search Keyword' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'restaurant_featured' , [
                'label' => __('Featured' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'all' => __('All' , 'foodbakery-elementor') ,
                    'only-featured' => __('Only Featured' , 'foodbakery-elementor') ,
                    'top-category' => __('Top Category' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'all' ,
            ]
        );
        
        $this->add_control(
            'restaurant_ads_switch' , [
                'label' => __('Ads Switch' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        
        
        //Locatins
        
        
        $this->add_control(
            'pagination' , [
                'label' => __('Pagination' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'no' => __('No' , 'foodbakery-elementor') ,
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                ] ,
                'default' => '' ,
            ]
        );

        $this->add_control(
            'posts_per_page' , [
                'label' => __('Post Per Page' , 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        


        $this->end_controls_section();
    }

    protected function render()
    {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Restaurants_Frontend = new Foodbakery_Restaurants_Frontend();
        $Foodbakery_Restaurants_Frontend->render($settings);
    }

    protected function content_template_bk()
    {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Restaurants Listing
        <?php
    }

}
