<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Locations_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Locations extends Widget_Base {

    public function get_name() {
        return 'locations';
    }

    public function get_title() {
        return 'Foodbakery Locations';
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
                'locations_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );
        $this->add_control(
                'locations_subtitle', [
            'label' => __('Section Sub Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );

        $this->add_control(
                'foodbakery_var_location_align', [
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
                'foodbakery_var_location_style', [
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


        $location_obj = get_terms('foodbakery_locations', array(
            'hide_empty' => false,
        ));
        $foodbakery_loc_list = array();
        if (is_array($location_obj) && sizeof($location_obj) > 0) {
            foreach ($location_obj as $dir_loc) {
                $foodbakery_loc_list[$dir_loc->slug] = $dir_loc->name;
            }
        }

        $this->add_control(
                'foodbakery_location', [
            'label' => __('Restaurant Locations', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'options' => $foodbakery_loc_list,
            'multiple' => true,
            'default' => '',
                ]
        );

        $this->add_control(
                'locations_button_url', [
            'label' => __('Button Link', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Locations_Frontend = new Foodbakery_Locations_Frontend();
        $Foodbakery_Locations_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Restaurants Search
        <?php
    }

}
