<?php

namespace WPC\Widgets;

use Foodbakery_Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Clients_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Clients extends Widget_Base {

    public function get_name() {
        return 'foodbakery_clients';
    }

    public function get_title() {
        return 'Foodbakery Clients';
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
                'foodbakery_var_clients_element_title', [
            'label' => __('Element Title', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => ''
                ]
        );

        $this->add_control(
                'foodbakery_var_client_align', [
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
                'foodbakery_var_client_view', [
            'label' => __('Style', 'foodbakery-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'simple' => __('Simple', 'foodbakery-elementor'),
                'fancy' => __('Fancy', 'foodbakery-elementor'),
            ],
            'default' => 'simple',
                ]
        );
        
        $repeater = new \Elementor\Repeater();
        
      
        $repeater->add_control(
            'foodbakery_var_clients_text', [
                'label' => __('Client Url', 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );
        
        $repeater->add_control(
            'foodbakery_var_clients_img_user_array', [
                'label' => __('Client Image', 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'clients_items',
            [
                'label' => __( 'Client Items', 'foodbakery-elementor' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ foodbakery_var_clients_text }}}',
            ]
        );
        

        $this->end_controls_section();
    }

    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Clients_Frontend = new Foodbakery_Clients_Frontend();
        $Foodbakery_Clients_Frontend->render($settings);
    }

    protected function content_template_bk() {
        //$control_uid = $this->get_control_uid( '{{settings.label_heading}}' );
        //pre($control_uid, false);
        ?>
        Foodbakery Testimonials
        <?php
    }

}
