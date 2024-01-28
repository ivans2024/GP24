<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Restaurants_Search_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Restaurants_Search extends Widget_Base {

    public function get_name() {
        return 'restaurant_search';
    }

    public function get_title() {
        return 'Restaurants Search';
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return ['foodbakery'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => 'Settings',
                ]
        );

        $this->add_control(
                'restaurant_search_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );
        $this->add_control(
                'restaurant_search_subtitle', [
            'label' => __('Section Sub Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );

        $this->add_control(
                'restaurant_search_result_page', [
            'label' => __('Result Page', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => Foodbakery_Elementor::get_pages_list(),
            'default' => 'simple',
                ]
        );


        $this->add_control(
                'restaurant_search_view', [
            'label' => __('Default View', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'fancy' => __('Fancy', 'foodbakery-elementor'),
                'modern' => __('Modern', 'foodbakery-elementor'),
                'simple' => __('Simple', 'foodbakery-elementor'),
                'classic' => __('Classic', 'foodbakery-elementor'),
            ],
            'default' => 'simple',
                ]
        );

        $this->add_control(
                'restaurant_search_show_location_field', [
            'label' => __('Show Location Field', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'yes' => __('Yes', 'foodbakery-elementor'),
                'no' => __('No', 'foodbakery-elementor'),
            ],
            'default' => 'no',
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Restaurants_Search_Frontend = new Foodbakery_Restaurants_Search_Frontend();
        $Foodbakery_Restaurants_Search_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Restaurants Search
        <?php
    }

}
