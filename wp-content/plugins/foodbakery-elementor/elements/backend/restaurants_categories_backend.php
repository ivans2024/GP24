<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Restaurants_Categories_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Restaurants_Categories extends Widget_Base {

    public function get_name() {
        return 'restaurant_categories';
    }

    public function get_title() {
        return 'Restaurants Categories';
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
                'restaurant_categories_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );
        $this->add_control(
                'restaurant_categories_subtitle', [
            'label' => __('Section Sub Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );

        $this->add_control(
                'foodbakery_var_categories_align', [
            'label' => __('Title Alignment', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'align-left' => __('Align Left', 'foodbakery-elementor'),
                'align-right' => __('Align Right', 'foodbakery-elementor'),
                'align-center' => __('Align Center', 'foodbakery-elementor'),
            ],
            'default' => 'align-left',
                ]
        );

        $this->add_control(
                'foodbakery_var_categories_style', [
            'label' => __('Style', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'default' => __('Default', 'foodbakery-elementor'),
                'fancy' => __('Fancy', 'foodbakery-elementor'),
                'modern' => __('Modern', 'foodbakery-elementor'),
            ],
            'default' => 'default',
                ]
        );

        $this->add_control(
                'foodbakery_title_color', [
            'label' => __('Category Colour', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
                ]
        );

        $location_obj = get_terms('restaurant-category', array(
            'hide_empty' => false,
        ));
        $foodbakery_cat_list = array();
        if (is_array($location_obj) && sizeof($location_obj) > 0) {
            foreach ($location_obj as $dir_cat) {
                $foodbakery_cat_list[$dir_cat->slug] = $dir_cat->name;
            }
        }

        $this->add_control(
                'foodbakery_types', [
            'label' => __('Restaurant Categories', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'options' => $foodbakery_cat_list,
            'multiple' => true,
            'default' => '',
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Restaurants_Categories_Frontend = new Foodbakery_Restaurants_Categories_Frontend();
        $Foodbakery_Restaurants_Categories_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Restaurants Search
        <?php
    }

}
