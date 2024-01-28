<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Statics_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Statics extends Widget_Base {

    public function get_name() {
        return 'statics';
    }

    public function get_title() {
        return 'Restaurants Statics';
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
                'statics_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );
        $this->add_control(
                'statics_subtitle', [
            'label' => __('Section Sub Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );


        $this->add_control(
                'foodbakery_var_statics_align', [
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
                'foodbakery_statics_text_color', [
            'label' => __('Text Color', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Statics_Frontend = new Foodbakery_Statics_Frontend();
        $Foodbakery_Statics_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Restaurants Search
        <?php
    }

}
