<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Foodbakery_Blog_Frontend;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Foodbakery_Blog extends Widget_Base
{

    public function get_name()
    {
        return 'foodbakery_blog';
    }

    public function get_title()
    {
        return 'Blog';
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
            'foodbakery_blog_element_title' , [
                'label' => __('Element Title' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
       
        $a_options = foodbakery_show_all_cats( '', '', '', "category", true );
        
        $this->add_control(
            'foodbakery_blog_cat' , [
                'label' => __('Choose Category' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT2 ,
                'multiple' => true,
                'options' => $a_options ,
                'default' => '' ,
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_view' , [
                'label' => __('Blog Design Views' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'view1' => __('Large' , 'foodbakery-elementor') ,
                    'view2' => __('Masonry' , 'foodbakery-elementor') ,
                    'view3' => __('Medium' , 'foodbakery-elementor') ,
                    'view4' => __('Grid' , 'foodbakery-elementor') ,
                    
                ] ,
                'default' => 'view1' ,
            ]
        );
        
        
        $this->add_control(
            'foodbakery_blog_size' , [
                'label' => __('Column' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    '1' => __('One Column' , 'foodbakery-elementor') ,
                    '2' => __('Two Column' , 'foodbakery-elementor') ,
                    '3' => __('Three Column' , 'foodbakery-elementor') ,
                    '4' => __('Four Column' , 'foodbakery-elementor') ,
                    '6' => __('Six Column' , 'foodbakery-elementor') ,
                    
                ] ,
                'default' => '2' ,
            ]
        );
        
         $this->add_control(
            'foodbakery_var_post_order_by' , [
                'label' => __('Order By' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'id' => __('Post ID' , 'foodbakery-elementor') ,
                    'date' => __('Date' , 'foodbakery-elementor') ,
                    'title' => __('Title' , 'foodbakery-elementor') ,
                    
                ] ,
                'default' => 'id' ,
            ]
        );
         
        $this->add_control(
            'foodbakery_blog_order_by_dir' , [
                'label' => __('Post Order' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'ASC' => __('ASC' , 'foodbakery-elementor') ,
                    'DESC' => __('DESC' , 'foodbakery-elementor') ,
                    
                ] ,
                'default' => 'ASC' ,
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_description' , [
                'label' => __('Post Description' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_excerpt' , [
                'label' => __('Length of Excerpt' , 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_posts_title_length' , [
                'label' => __('Post Title Length' , 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_num_post' , [
                'label' => __('No. of Post Per Page' , 'foodbakery-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT ,
                'default' => ''
            ]
        );
        
        $this->add_control(
            'blog_pagination' , [
                'label' => __('Pagination' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'yes' => __('Yes' , 'foodbakery-elementor') ,
                    'no' => __('No' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'no' ,
            ]
        );
        
        $this->add_control(
            'foodbakery_blog_all_posts' , [
                'label' => __('All Posts' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'all' => __('All Posts' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'all' ,
            ]
        );
        


        $this->end_controls_section();
    }

    protected function render()
    {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $Foodbakery_Blog_Frontend = new Foodbakery_Blog_Frontend();
        $Foodbakery_Blog_Frontend->render($settings);
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
