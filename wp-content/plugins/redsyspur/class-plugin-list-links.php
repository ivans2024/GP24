<?php

class Plugin_List_Links {

	function __construct() {
		add_filter( 'plugin_action_links_' . REDSYSPUR_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ), 10, 1 );
//		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
	}

	public static function plugin_action_links( $links ) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '" aria-label="' . esc_attr__( 'Configurar métodos de Pago', 'woocommerce-redsys' ) . '">' . esc_html__( 'Ajustes', 'woocommerce-redsys' ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}
/*
	public static function plugin_row_meta( $links, $file ) {
		if ( REDSYSPUR_PLUGIN_BASENAME !== $file ) {
			return $links;
		}

		$row_meta = array(
			'admincanales' => '<a href="' . esc_url( apply_filters( 'redsys_admincanales_url', 'https://canales.redsys.es/' ) ) . '" aria-label="' . esc_attr__( 'Portal de Administración Canales', 'woocommerce-redsys' ) . '">' . esc_html__( 'Portal de Administración', 'woocommerce-redsys' ) . '</a>',
		);

		return array_merge( $links, $row_meta );
	}
*/
}
return new Plugin_List_Links();
