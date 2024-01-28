<?php

/**
 * Foodbakery_Category_Meta Class
 *
 * @package Foodbakery
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
  Foodbakery_Category_Meta class used to implement the category meta fields.
 */
class Foodbakery_Category_Meta {

    /**
     * Set up foodbakery category meta fields.
     */
    public function __construct() {
        // add extra fields to category add/edit form callback function.
        add_action( 'category_add_form_fields', array( $this, 'add_category_meta_fields' ) );
        add_action( 'category_edit_form_fields', array( $this, 'edit_category_meta_fields' ), 10, 2 );
        // save extra category extra fields hook.
        add_action( 'edited_category', array( $this, 'save_extra_category_fileds' ), 10, 2 );
    }

    /**
     * Adding category meta fields.
     */
    public function add_category_meta_fields() {
        global $foodbakery_var_form_fields, $foodbakery_var_static_text;
        echo '<div class="form-field">';
        echo '<label for="cat_icon">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_icon' ) . '</label>';
        echo foodbakery_var_icomoon_icons_box( '', '', 'cat_meta[cat_icon]' );
        echo '<p class="description">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_icon_hint' ) . '</p>';
        echo '</div>';
        echo '<div class="form-field">';
        echo '<label for="cat_color">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_color' ) . '</label>';
        $foodbakery_opt_array = array(
            'std' => '#c33332',
            'cust_id' => 'cat_meta[cat_color]',
            'cust_name' => 'cat_meta[cat_color][]',
            'classes' => 'bg_color',
        );
        $foodbakery_var_form_fields->foodbakery_var_form_text_render( $foodbakery_opt_array );
        echo '<p class="description">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_color_hint' ) . '</p>';
        echo '</div>';
    }

    /**
     * Updating category meta fields.
     *
     * @param array  $cat_data category data.
     * @param string $cat_slug category.
     */
    public function edit_category_meta_fields( $cat_data = '', $cat_slug = '') {
        global $foodbakery_var_form_fields, $foodbakery_var_static_text;
        $cat_meta = array();
        if ( $cat_data ) {
            $cat_id = $cat_data->term_id;
            $cat_meta = get_term_meta( $cat_id, 'cat_meta_data', true );
        }
        $cat_color = isset( $cat_meta['cat_color'] ) ? $cat_meta['cat_color'] : '#c33332';
        $cat_icon = isset( $cat_meta['cat_icon'] ) ? $cat_meta['cat_icon'] : '';

        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="cat_icon">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_icon' ) . '</label></th>';
        echo '<td>';
        echo foodbakery_var_icomoon_icons_box( $cat_icon, '', 'cat_meta[cat_icon]' );
        echo '<br />';
        echo '<span class="description">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_icon_hint' ) . '</span>';
        echo '</td>';
        echo '</tr>';
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="cat_color">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_color' ) . '</label></th>';
        echo '<td>';
        $foodbakery_opt_array = array(
            'std' => $cat_color,
            'cust_id' => 'cat_meta[cat_color]',
            'cust_name' => 'cat_meta[cat_color][]',
            'classes' => 'bg_color',
        );
        $foodbakery_var_form_fields->foodbakery_var_form_text_render( $foodbakery_opt_array );
        echo '<br />';
        echo '<span class="description">' . foodbakery_var_theme_text_srt( 'foodbakery_var_cat_color_hint' ) . '</span>';
        echo '</td>';
        echo '</tr>';
    }

    /**
     * Saving category meta fields.
     *
     * @param int    $cat_id category id.
     * @param string $cat_slug category slug.
     */
    public function save_extra_category_fileds( $cat_id, $cat_slug ) {
        $post_data = foodbakery_get_input( 'cat_meta', false, false );
        if ( isset( $post_data ) ) {
            $cat_meta = get_term_meta( $cat_slug . '_' . $cat_id );
            $cat_keys = array_keys( $post_data );
            foreach ( $cat_keys as $key ) {
                if ( isset( $post_data[$key] ) ) {
                    $cat_meta[$key] = $post_data[$key][0];
                }
            }
            update_term_meta( $cat_id, 'cat_meta_data', $cat_meta );
        }
    }

}

new Foodbakery_Category_Meta();
