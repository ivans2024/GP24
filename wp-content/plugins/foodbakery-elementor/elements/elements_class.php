<?php

namespace WPC;

// use Elementor\Plugin; ?????

class Widget_Loader
{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function include_widgets_files()
    {
        //Restaurnats Element
        require_once(__DIR__ . '/backend/restaurants_backend.php');
        require_once(__DIR__ . '/frontend/restaurants_frontend.php');
        
        //Restaurnats Slider Element
        require_once(__DIR__ . '/backend/restaurants_slider_backend.php');
        require_once(__DIR__ . '/frontend/restaurants_slider_frontend.php');
        
        //Restaurnats Search Element
        require_once(__DIR__ . '/backend/restaurants_search_backend.php');
        require_once(__DIR__ . '/frontend/restaurants_search_frontend.php');
        
        //Restaurnats Statics
        require_once(__DIR__ . '/backend/foodbakery_statics_backend.php');
        require_once(__DIR__ . '/frontend/foodbakery_statics_frontend.php');
        
        //Restaurnats Categories
        require_once(__DIR__ . '/backend/restaurants_categories_backend.php');
        require_once(__DIR__ . '/frontend/restaurants_categories_frontend.php');
        
        //Foodbakery Locations
        require_once(__DIR__ . '/backend/foodbakery_locations_backend.php');
        require_once(__DIR__ . '/frontend/foodbakery_locations_frontend.php');
        
        //Foodbakery Testimonials
        require_once(__DIR__ . '/backend/foodbakery_testimonials_backend.php');
        require_once(__DIR__ . '/frontend/foodbakery_testimonials_frontend.php');
        
        //Foodbakery Clients
        require_once(__DIR__ . '/backend/foodbakery_clients_backend.php');
        require_once(__DIR__ . '/frontend/foodbakery_clients_frontend.php');
        
        //Foodbakery Blog
        require_once(__DIR__ . '/backend/foodbakery_blog_backend.php');
        require_once(__DIR__ . '/frontend/foodbakery_blog_frontend.php');


    }

    public function register_widgets()
    {

        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Restaurants());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Restaurants_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Restaurants_Search());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Restaurants_Categories());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Statics());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Locations());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Testimonials());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Clients());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foodbakery_Blog());
        /*\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Candidates());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Employers());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Cv_Packages());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Job_Packages());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Apply_Job_Packages());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Job_Specialisms());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Jobs_Search());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Testimonials());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Register());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Blog());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_PriceTable());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_Newsletter());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_CallToAction());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_JobsWithMap());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Jobhunt_ListingTab());*/
    }

    public function add_elementor_widget_categories($elements_manager)
    {

        $elements_manager->add_category(
            'foodbakery' , [
                'title' => __('FOODBAKERY' , 'foodbakery-elementor') ,
                'icon' => 'eicon-font' ,
            ]
        );
    }

    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered' , [$this , 'register_widgets'] , 99);
        add_action('elementor/elements/categories_registered' , array($this , 'add_elementor_widget_categories'));
        add_action('elementor/documents/register_controls' , array($this , 'foodbakery_register_page_settings_sub_header_callback'));
    }

    function foodbakery_register_page_settings_sub_header_callback($document)
    {


        $document->start_controls_section(
            'foodbakery_page_options_sub_header' , [
                'label' => esc_html__('FOODBAKERY: Subheader Options' , 'foodbakery-elementor') ,
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS ,
            ]
        );


        $document->add_control(
            'foodbakery_var_header_banner_style' , [
                'label' => __('Choose Sub-Header' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'options' => [
                    'default_header' => __('Default Subheader' , 'foodbakery-elementor') ,
                    'breadcrumb_header' => __('Custom Subheader' , 'foodbakery-elementor') ,
                    'custom_slider' => __('Revolution Slider' , 'foodbakery-elementor') ,
                    'map' => __('Map' , 'foodbakery-elementor') ,
                    'no-header' => __('No Subheader' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'default_header' ,
            ]
        );
        

        /*
         * Custom Subheader Fields Start
         */
        
        $document->add_control(
            'foodbakery_var_sub_header_style' , [
                'label' => __('Style' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'options' => [
                    'classic' => __('classic' , 'foodbakery-elementor') ,
                    'with_bg' => __('With Background Image' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'classic' ,
            ]
        );
        
        $document->add_control(
            'foodbakery_var_subheader_padding_top' , [
                'label' => __('Padding Top' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'default' => ''
            ]
        );

        $document->add_control(
            'foodbakery_var_subheader_padding_bottom' , [
                'label' => __('Padding Bottom' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'default' => ''
            ]
        );
        
        $document->add_control(
            'foodbakery_var_subheader_margin_top' , [
                'label' => __('Margin Top' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'default' => ''
            ]
        );

        $document->add_control(
            'foodbakery_var_subheader_margin_bottom' , [
                'label' => __('Margin Bottom' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'default' => ''
            ]
        );
        
         $document->add_control(
            'foodbakery_var_page_title_switch' , [
                'label' => esc_html__('Page Title' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SWITCHER ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'label_on' => esc_html__('On' , 'foodbakery-elementor') ,
                'label_off' => esc_html__('Off' , 'foodbakery-elementor') ,
                'return_value' => 'on' ,
                'default' => 'off' ,
            ]
        );
        
        $document->add_control(
            'foodbakery_var_sub_header_align' , [
                'label' => __('Text Align' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'options' => [
                    'left' => __('Left' , 'foodbakery-elementor') ,
                    'center' => __('Center' , 'foodbakery-elementor') ,
                    'right' => __('Right' , 'foodbakery-elementor') ,
                ] ,
                'default' => 'left' ,
            ]
        );
        
        $document->add_control(
            'foodbakery_var_page_subheader_text_color' , [
                'label' => __('Text Color' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::COLOR ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
            ]
        );
        
        $document->add_control(
            'foodbakery_var_page_breadcrumbs' , [
                'label' => esc_html__('Breadcrumbs' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SWITCHER ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
                'label_on' => esc_html__('On' , 'foodbakery-elementor') ,
                'label_off' => esc_html__('Off' , 'foodbakery-elementor') ,
                'return_value' => 'on' ,
                'default' => 'off' ,
            ]
        );
        
         /*
         * Custom Subheader Fields  - With Background Image Fields Start
         */
        
        $document->add_control(
            'foodbakery_var_page_subheading_title' , [
                'label' => __('Sub Heading' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXTAREA ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                    'foodbakery_var_sub_header_style' => 'with_bg' ,
                ] ,
                'default' => ''
            ]
        );
        
        $document->add_control(
            'foodbakery_var_header_banner_image' , [
                'label' => esc_html__('Background Image' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::MEDIA ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                    'foodbakery_var_sub_header_style' => 'with_bg' ,
                ] ,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src() ,
                ] ,
            ]
        );
        
        $document->add_control(
            'foodbakery_var_page_subheader_parallax' , [
                'label' => esc_html__('Parallax' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SWITCHER ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                    'foodbakery_var_sub_header_style' => 'with_bg' ,
                ] ,
                'label_on' => esc_html__('On' , 'foodbakery-elementor') ,
                'label_off' => esc_html__('Off' , 'foodbakery-elementor') ,
                'return_value' => 'on' ,
                'default' => 'off' ,
            ]
        );
        
        /*
         * Custom Subheader Fields  - With Background Image Fields Ends
         */
        
        $document->add_control(
            'foodbakery_var_page_subheader_color' , [
                'label' => __('Background Color' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::COLOR ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'breadcrumb_header' ,
                ] ,
            ]
        );

        



        /*
         * Custom Subheader Fields Ends
         */


        /*
         * Slider Fields Starts
         */

        $sliders_array = array();
        if (class_exists('RevSlider') && class_exists('jobcareer_revSlider')) {

            $slider = new \jobcareer_revSlider();
            $arrSliders = $slider->getAllSliderAliases();

            if (is_array($arrSliders)) {
                foreach ($arrSliders as $key => $entry) {
                    $sliders_array[$entry['alias']] = $entry['title'];
                }
            }
        }

        $document->add_control(
            'cs_custom_slider_id' , [
                'label' => __('Slider' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::SELECT ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'custom_slider' ,
                ] ,
                'options' => $sliders_array ,
                'default' => '' ,
            ]
        );


        /*
         * Slider Fields Ends
         */


        /*
         * Map Fields Starts
         */

        $document->add_control(
            'cs_custom_map' , [
                'label' => __('Custom Map Short Code' , 'foodbakery-elementor') ,
                'type' => \Elementor\Controls_Manager::TEXTAREA ,
                'condition' => [
                    'foodbakery_var_header_banner_style' => 'map' ,
                ] ,
                'rows' => 5 ,
                'default' => ''
            ]
        );


        /*
         * Map Fields Ends
         */


        $document->end_controls_section();
    }

}

// Instantiate Plugin Class
Widget_Loader::instance();
