<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Testimonials_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Testimonials extends Widget_Base {

    public function get_name() {
        return 'foodbakery_testimonials';
    }

    public function get_title() {
        return 'Foodbakery Testimonials';
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
                'foodbakery_var_testimonial_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );

        $this->add_control(
                'foodbakery_var_testimonial_align', [
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
                'foodbakery_var_testimonial_style', [
            'label' => __('Style', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'default' => __('Default', 'foodbakery-elementor'),
                'fancy' => __('Fancy', 'foodbakery-elementor'),
                'simple' => __('Simple', 'foodbakery-elementor'),
            ],
            'default' => 'default',
                ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'foodbakery_var_testimonial_content', [
                'label' => __('Text', 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => ''
            ]
        );
        
        $repeater->add_control(
            'foodbakery_var_testimonial_author', [
                'label' => __('Author', 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );
        
        $repeater->add_control(
            'foodbakery_var_testimonial_author_image_array', [
                'label' => __('Image', 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'testimonial_item',
            [
                'label' => __( 'Testimonial Items', 'foodbakery-elementor' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ foodbakery_var_testimonial_author }}}',
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Testimonials_Frontend = new Foodbakery_Testimonials_Frontend();
        $Foodbakery_Testimonials_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Foodbakery Testimonials
        <?php
    }

}
