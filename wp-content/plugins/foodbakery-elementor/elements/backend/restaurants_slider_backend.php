<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Restaurants_Slider_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Restaurants_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'foodbakery_restaurants_slider';
    }

    public function get_title()
    {
        return 'Restaurants Slider';
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
            'restaurant_sort_by' , [
                'label' => __('Sort By' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'recent' => __('Recent' , 'foodbakery-elementor') ,
                    'alphabetical' => __('Alphabetical' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'recent' ,
            ]
        );
        
        $this->add_control(
            'restaurant_slider_style' , [
                'label' => __('Choose Style' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'default' => __('Default' , 'foodbakery-elementor') ,
                    'fancy' => __('Fancy' , 'foodbakery-elementor') ,
                    'simple' => __('Simple' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'default' ,
            ]
        );
        
        $this->add_control(
            'restaurant_featured' , [
                'label' => __('Featured' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'all' => __('All' , 'foodbakery-elementor') ,
                    'only-featured' => __('Only Featured' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'all' ,
            ]
        );
        
        
        //Location Field
        


        $this->end_controls_section();
    }

    protected function render()
    {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Restaurants_Slider_Frontend = new Foodbakery_Restaurants_Slider_Frontend();
        $Foodbakery_Restaurants_Slider_Frontend->render($settings);
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
