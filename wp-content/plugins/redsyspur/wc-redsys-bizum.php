<?php

/**
 * NOTA SOBRE LA LICENCIA DE USO DEL SOFTWARE
 *
 * El uso de este software está sujeto a las Condiciones de uso de software que
 * se incluyen en el paquete en el documento "Aviso Legal.pdf". También puede
 * obtener una copia en la siguiente url:
 * http://www.redsys.es/wps/portal/redsys/publica/areadeserviciosweb/descargaDeDocumentacionYEjecutables
 *
 * Redsys es titular de todos los derechos de propiedad intelectual e industrial
 * del software.
 *
 * Quedan expresamente prohibidas la reproducción, la distribución y la
 * comunicación pública, incluida su modalidad de puesta a disposición con fines
 * distintos a los descritos en las Condiciones de uso.
 *
 * Redsys se reserva la posibilidad de ejercer las acciones legales que le
 * correspondan para hacer valer sus derechos frente a cualquier infracción de
 * los derechos de propiedad intelectual y/o industrial.
 *
 * Redsys Servicios de Procesamiento, S.L., CIF B85955367
 */

if(!function_exists("escribirLog")) {
	require_once('apiRedsys/redsysLibrary.php');
}
if(!class_exists("RedsysAPI")) {
	require_once('apiRedsys/apiRedsysFinal.php');
}
if(!class_exists("WC_Redsys_Refund")) {
	require_once('wc-redsys-refund.php');
}

class WC_Redsys_Bizum extends WC_Payment_Gateway {

    public $id;
    public $logString;
    public $method_title;
    public $method_description;
    public $notify_url;
    public $log;
    public $has_fields;
    public $supports;
    public $title;
    public $description;
    public $entorno;
    public $nombre;
    public $fuc;
    public $tipopago;
    public $clave256;
    public $terminal;
    public $activar_log;
    public $estado;
    public $genPedido;
    public $pedidoExtendido;
    public $mantener_carrito;
    public $urlok;
    public $urlko;
    public $moduleComent;
    public $moneda;

    public function __construct() {
        $this->id                 = 'redsys_bizum';
        $this->logString          = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

        //$this->icon               = home_url() . '/wp-content/plugins/redsys/pages/assets/images/Redsys.png';
        $this->method_title       = __( 'Bizum · Pasarela Unificada de Redsys para WooCommerce', 'woocommerce' );
        $this->method_description = __( 'Permita a sus clientes pagar con Bizum redirigiéndoles a los servicios de Redsys.', 'woocommerce' );
        $this->notify_url         = add_query_arg( 'wc-api', 'WC_redsys_bizum', home_url( '/' ) );
        $this->log                =  new WC_Logger();

        $this->has_fields         = false;

        // Load the settings
        $this->init_settings();
        $this->init_form_fields();

        $this->supports           = array( 'refunds' );

        $this->title              = $this->get_option( 'title' );
        $this->description        = $this->get_option( 'description' );

        // Get settings
        $this->entorno            = $this->get_option( 'entorno' );
        $this->nombre             = $this->get_option( 'name' );
        $this->fuc                = $this->get_option( 'fuc' );
        $this->tipopago           = $this->get_option( 'tipopago' );
        $this->clave256           = $this->get_option( 'clave256' );
        $this->terminal           = $this->get_option( 'terminal' );
        $this->activar_log	      = $this->get_option( 'activar_log' );
        $this->estado             = $this->get_option( 'estado' );
        $this->genPedido	      = $this->get_option( 'genPedido' );
        $this->pedidoExtendido	  = $this->get_option( 'pedidoExtendido' );
        $this->mantener_carrito   = $this->get_option( 'mantener_carrito' );
        $this->urlok              = $this->get_option( 'urlok' );
		$this->urlko              = $this->get_option( 'urlko' );

        $this->moduleComent = "Pasarela Unificada de Redsys para WooCommerce";

        //moneda a usar
        $this->moneda = currency_code(get_option('woocommerce_currency'));

        //idLog
        $this->logString          = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Actions
        add_action( 'woocommerce_receipt_redsys_bizum', array( $this, 'receipt_page' ) );
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        //Payment listener/API hook
        add_action( 'woocommerce_api_wc_redsys_bizum', array( $this, 'check_rds_response' ) );
        add_action( 'woocommerce_before_checkout_form', array( $this, 'advertencia_sandbox' ) );
    }

    function init_form_fields() {
        global $woocommerce;

        $this->form_fields = array(
                'enabled' => array(
                        'title'       => __( 'Activación del Módulo', 'woocommerce' ),
                        'type'        => 'select',
                        'description' => __( 'Activa o desactiva el Módulo de BIZUM', 'woocommerce' ),
                        'default'     => 'no',
                        'options'     => array(
                                'yes' => __( 'Activado', 'woocommerce' ),
                                'no'  => __( 'Desactivado', 'woocommerce' )
                        ),
                        'desc_tip'    => true,
                ),
                'title' => array(
                        'title'       => __( 'Título del método de Pago', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'Título del método de Pago que el cliente verá en la página de compra.', 'woocommerce' ),
                        'default'     => __( 'Pagar con BIZUM', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'description' => array(
                        'title'       => __( 'Descripción del método de Pago', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'Descripción del método de Pago que el cliente verá en la página de compra.', 'woocommerce' ),
                        'default'     => __( 'Pague con BIZUM usando los servicios de Redsys.', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'entorno' => array(
                        'title'       => __( 'Entorno de Operación', 'woocommerce' ),
                        'type'        => 'select',
                        'description' => __( 'Entorno donde procesar el pago. <br>Recuerde no activar el modo "Sandbox" en su entorno de producción, de lo contrario podrían producirse ventas no deseadas. Dispone de más información sobre cómo realizar pruebas <a href=https://pagosonline.redsys.es/entornosPruebas.html target="_blank" rel="noopener noreferrer">aquí</a>.', 'woocommerce' ),
                        'default'     => 'Sis-t',
                        'options'     => array(
                                0 => __( 'Sandbox', 'woocommerce' ),
                                1 => __( 'Producción', 'woocommerce' )
                        )
                ),
                'name' => array(
                        'title'       => __( 'Nombre del Comercio', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'Nombre de su comercio que se establecerá a la hora de enviar las operaciones.', 'woocommerce' ),
                        'default'     => __( '', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'fuc' => array(
                        'title'       => __( 'Número de Comercio', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'El número de comercio, también denominado FUC, es un número que identifica a su comercio y debe habérselo provisto su Entidad Bancaria.', 'woocommerce' ),
                        'default'     => __( '', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'terminal' => array(
                        'title'       => __( 'Número de Terminal', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'El número de terminal es el número que identifica el terminal dentro de su comercio y debe habérselo provisto su Entidad Bancaria.', 'woocommerce' ),
                        'default'     => __( '', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'clave256' => array(
                        'title'       => __( 'Clave de Encriptación SHA-256', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'Esta clave permite firmar todas las operaciones enviadas por el módulo y ha debido ser provista de ella por su Entidad Bancaria. Recuerde guardarla en un lugar seguro. <br> Para realizar pruebas en el entorno Sandbox, puede usar: sq7HjrUOBfKmC576ILgskD5srU870gJ7 o la provista por su Entidad Bancaria.', 'woocommerce' ),
                        'default'     => __( '', 'woocommerce' ),
                ),
                'mantener_carrito' => array(
                    'title'       => __( 'Manetener carrito si se produce un error', 'woocommerce'),
                    'type'        => 'select', //checkbox
    //                'label'       => 'Si activa esta opción, el carrito no se borrará si la operación no es correcta y el cliente podrá intentarlo de nuevo',
                    'description' => __( 'Esta función está desactivada temporalmente', 'woocommerce' ),
                    'default'     => 'no',
                    'options'     => array(
                            'no' => __( 'Desactivado', 'woocommerce' ),
                            'si' => __( 'Activado', 'woocommerce' )
                    ),
                    'desc_tip'    => true,
                    'disabled'    => true,
               ),
                'estado' => array(
                        'title'       => __( 'Estado del pedido al verificarse el pago', 'redsys_wc' ),
                        'type'        => 'select',
                        'description' => __( 'Aquí puede configurar el estado en el que se mostrará el pedido en el apartado "Pedidos" de su backoffice una vez el módulo reciba la notificación de que el pago ha sido correcto.', 'redsys_wc' ),
                        'default'     => 'processing',
                        'options'     => array(),
                        'desc_tip'    => true,
                ),
                'estado_autenticacion' => array(
                    'title'       => __( 'Estado del pedido al verificarse el proceso de autenticación', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Aquí puede configurar el estado en el que se mostrará el pedido en el apartado "Pedidos" de su backoffice al realizar una autenticación.', 'woocommerce' ),
                    'default'     => 'on-hold',
                    'options'     => array(),
                    'desc_tip'    => true,
                ),
                'activar_log' => array(
                        'title'       => __( 'Guardar registros de comportamiento', 'woocommerce' ),
                        'type'        => 'select',
                        'description' => __( 'Si activa esta opción, se guardarán registros (logs) de los procesos que realice el módulo. <br> A la hora de notificar cualquier incidencia, los logs completos son de gran utilidad para poder detectar el problema.', 'woocommerce' ),
                        'default'     => 'no',
                        'options'     => array(
                                '0' => __( 'No', 'woocommerce' ),
                                '1' => __( 'Sí, sólo informativos', 'woocommerce' ),
                                '2' => __( 'Sí, todos los registros', 'woocommerce' )
                        ),
                        'desc_tip'    => true,
                ),
                'tipopago' => array(
                    'title'       => __( 'Tipo de transacción', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Esta opción permite enviar información adicional del cliente que está realizando la compra, proporcionando más seguirdad a la hora de autenticar la operación<br>ATENCIÓN: Si selecciona "preautorización", deberá realizar las confirmaciones desde el Portal de Administración del TPV Virtual.', 'woocommerce' ),
                    'default'     => '0',
                    'options'     => array(
                            '0' => __( 'Autorización', 'woocommerce' ),
                            '7' => __( 'Autenticación', 'woocommerce' )
                    ),
                ),
                'genPedido' => array(
                    'title' => __( 'Método de generación del número de pedido', 'redsys_wc' ),
                    'type' => 'select',
                    'description' => __( 'Esta opción no modifica la forma en la que se identifica la orden en su Backoffice, sino el número de pedido (adaptado para que siempre ocupe doce dígitos) que se envía a Redsys para identificar la operación.<br>Recuerde que en los detalles de cada orden puede ver el número de pedido que identifica la operación en el Portal de Administración del TPV Virtual.', 'redsys_wc' ),
                    'default' => '0',
                    'options' => array(
                            '0' => __( 'Híbrido (recomendado)', 'woocommerce' ),
                            '1' => __( 'Sólo ID del carrito', 'woocommerce' ),
                            '2' => __( 'Aleatorio', 'woocommerce' )
                    ),
                ),
                'pedidoExtendido' => array(
                    'title'       => __( 'El terminal permite número de pedido extendido', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Marque esta opción si su terminal está configurado para admitir números de pedidos extendidos. Esto es útil para tiendas cuyos número de pedidos podrían exceder las doce posiciones que tiene como máximo un número de pedido estándar.<br>Recuerde que debe solicitar a su entidad bancaria que activen esta configuración en su terminal antes de marcar esta opción.', 'woocommerce' ),
                    'default'     => '0',
                    'options'     => array(
                        '0' => __( 'No', 'woocommerce' ),
                        '1' => __( 'Si', 'woocommerce' )
                    )
                ),
                'urlok' => array(
                    'title'       => __( 'URL para operaciones correctas', 'woocommerce' ),
                    'type'        => 'text',
                    'description' => __( 'Este campo, denominado URL_OK, establece a qué página se redirigirá al cliente al volver de Redsys una vez la operación haya finalizado y esta sea correcta. Si este campo se rellena, se ignorará la configuración del parámetro establecida en el Portal de Administración del TPV Virtual.', 'woocommerce' ),
                    'default'     => __( '', 'woocommerce' ),
                    'desc_tip'    => true,
                ),
                'urlko' => array(
                    'title'       => __( 'URL para operaciones erróneas', 'woocommerce' ),
                    'type'        => 'text',
                    'description' => __( 'Este campo, denominado URL_KO, establece a qué página se redirigirá al cliente al volver de Redsys una vez la operación haya finalizado y esta haya tenido algún error. Si este campo se rellena, se ignorará la configuración del parámetro establecida en el Portal de Administración del TPV Virtual.', 'woocommerce' ),
                    'default'     => __( '', 'woocommerce' ),
                    'desc_tip'    => true,
                ));
				
				$tmp_estados=wc_get_order_statuses();
				foreach($tmp_estados as $est_id=>$est_na){
					$this->form_fields['estado']['options'][substr($est_id,3)]=$est_na;
                    $this->form_fields['estado_autenticacion']['options'][substr($est_id,3)]=$est_na;
				}
    }

    function process_payment( $order_id ) {
        global $woocommerce;
        $order = new WC_Order($order_id);

        $orderIdLog = $order_id . $this->fuc;
        $idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);

        $isLogged = is_user_logged_in();
		$userId=get_post_meta($order, '_customer_user', true);
        
        escribirLog("DEBUG", $idLog, "**************************");
		escribirLog("INFO ", $idLog, "****** NUEVO PEDIDO ******");
		escribirLog("INFO ", $idLog, "****** ". $numpedido ." ******");
		escribirLog("DEBUG", $idLog, "**************************");

		escribirLog("INFO ", $idLog, "Pago con Bizum", null, __METHOD__);
		escribirLog("INFO ", $idLog, "ID del usuario cargado: " . $userId, null, __METHOD__);

        if ($isLogged == true)
			escribirLog("INFO ", $idLog, "El usuario que hace el pedido está logueado en la página", null, __METHOD__);
		else
			escribirLog("INFO ", $idLog, "El usuario que hace el pedido no está logueado en la página", null, __METHOD__);

        escribirLog("DEBUG", $idLog, "Redireccionando a " . $order->get_checkout_payment_url(true) . " para continuar...", null, __METHOD__);

        // Return receipt_page redirect
        return array(
            'result' 	=> 'success',
            'redirect'	=> $order->get_checkout_payment_url( true )
        );
    }

    function generate_redsys_form( $order_id ) {
            // Version

        $orderIdLog = $order_id . $this->fuc;
        $idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);
        escribirLog("DEBUG", $idLog, "Generando formulario para el pedido " . $order_id);
    
        $merchantModule = 'WO-PUR v' . MODULE_VERSION;

        escribirLog("DEBUG", $idLog, "Versión del módulo: " . $merchantModule, null, __METHOD__);
        escribirLog("DEBUG", $idLog, "Versión de Wordpress: " . $GLOBALS['wp_version'], null, __METHOD__);
		escribirLog("DEBUG", $idLog, "Versión de WooCommerce: " . WC_VERSION, null, __METHOD__);
		escribirLog("DEBUG", $idLog, "Versión de PHP: " . phpversion(), null, __METHOD__);

        //Recuperamos los datos de config.
        $logActivo=$this->get_option('activar_log');
        $nombre=$this->get_option('name');
        $codigo=$this->get_option('fuc');
        $terminal=$this->get_option('terminal');
        $moneda = currency_code(get_option('woocommerce_currency'));
        $clave256=$this->get_option('clave256');
        $tipopago=intval($this->get_option('tipopago'));
        $entorno=$this->get_option('entorno');

        //Callback
        $urltienda = $this -> notify_url;
        $urlok=$this->get_option('urlok');
		$urlko=$this->get_option('urlko');

        //Objeto tipo pedido
        $order = new WC_Order($order_id);

        //Calculo del precio total del pedido
        $transaction_amount = number_format( (float) ($order->get_total()), 2, '.', '' );
        $transaction_amount = str_replace('.','',$transaction_amount);
        $transaction_amount = floatval($transaction_amount);

        // Descripción de los productos
        $productos="";
        $products = WC()->cart->cart_contents;
        foreach ($products as $product) {
            $productos .= $product['quantity'].'x'.$product['data']->post->post_title.'/';
        }

        $numpedido = generaNumeroPedido($order_id, $this->get_option('genPedido'), $this->get_option('pedidoExtendido') == 1);
        escribirLog("INFO ", $idLog, "Numero de pedido enviado a Redsys ─ [Ds_Merchant_Order]: " . $numpedido, null, __METHOD__); 

        $idioma_web = substr(get_locale(),0,2);
        switch ($idioma_web) {
            case 'es':
            $idiomaFinal='001';
            break;
            case 'en':
            $idiomaFinal='002';
            break;
            case 'ca':
            $idiomaFinal='003';
            break;
            case 'fr':
            $idiomaFinal='004';
            break;
            case 'de':
            $idiomaFinal='005';
            break;
            case 'nl':
            $idiomaFinal='006';
            break;
            case 'it':
            $idiomaFinal='007';
            break;
            case 'sv':
            $idiomaFinal='008';
            break;
            case 'pt':
            $idiomaFinal='009';
            break;
            case 'pl':
            $idiomaFinal='011';
            break;
            case 'gl':
            $idiomaFinal='012';
            break;
            case 'eu':
            $idiomaFinal='013';
            break;
            default:
            $idiomaFinal='002';
        }

        // Generamos la firma	
        $miObj = new RedsysAPI;
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$transaction_amount);
        $miObj->setParameter("DS_MERCHANT_ORDER",$numpedido);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$codigo);
        $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $tipopago);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$urltienda);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlok ? $urlok : $this->get_return_url($order));
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlko ? $urlko : $order->get_cancel_order_url());
        $miObj->setParameter("Ds_Merchant_ConsumerLanguage",$idiomaFinal);
        $miObj->setParameter("Ds_Merchant_ProductDescription",$productos);
        $miObj->setParameter("Ds_Merchant_Titular",$order -> billing_first_name." ".$order -> billing_last_name);
        $miObj->setParameter("Ds_Merchant_MerchantName",$nombre);
        $miObj->setParameter("Ds_Merchant_PayMethods", "z");
        $miObj->setParameter("Ds_Merchant_Module",$merchantModule);

        $merchantData = createMerchantData($this->moduleComent, $order_id);
        $miObj->setParameter ( "Ds_Merchant_MerchantData", b64url_encode($merchantData) );
        
        //Datos de configuración
        $version = getVersionClave();

        //Clave del comercio que se extrae de la configuración del comercio
        // Se generan los parámetros de la petición
        $request = "";
        $paramsBase64 = $miObj->createMerchantParameters();
        $signatureMac = $miObj->createMerchantSignature($this->clave256);

        $resys_args = array(
            'Ds_SignatureVersion' => $version,
            'Ds_MerchantParameters' => $paramsBase64,
            'Ds_Signature' => $signatureMac
            //, 'this_path' => $this->_path
        );

        escribirLog("DEBUG", $idLog, "Parámetros de la solicitud: " . $resys_args['Ds_MerchantParameters'], null, __METHOD__ );
        escribirLog("DEBUG", $idLog, "Firma calculada y enviada : " . $resys_args['Ds_Signature'], null, __METHOD__ );

          //Se establecen los input del formulario con los datos del pedido y la redirección
        $resys_args_array = array();
        foreach($resys_args as $key => $value){
          $resys_args_array[] = "<input type='hidden' name='$key' value='$value'/>";
        }

        //Se establece el entorno del SIS
        if($entorno==0) {
            $env="https://sis-t.redsys.es:25443/sis/realizarPago/utf-8";
        }
        else{
            $env="https://sis.redsys.es/sis/realizarPago/utf-8";
        }	

        //Formulario que envía los datos del pedido y la redirección al formulario de acceso al TPV

		echo __("Gracias por confiar en nosotros. En breves segundos será redirigido a la plataforma de pago.")."<br/>";
		echo __("Si su navegador no le redirecciona automáticamente pulse")." <a href='javascript:void(0)' onclick='document.getElementById('redsys_payment_form').submit();'>".__("aquí")."</a> ".__("para llevar a cabo el pago.");

        return '<form action="'.$env.'" method="post" id="redsys_payment_form">'. 
                    implode('', $resys_args_array) . 
                    //'<input type="submit" class="button-alt" id="submit_redsys_payment_form" value="'.__('Pagar con Bizum', 'redsys').'" />'.
                    //'<a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Cancelar Pedido', 'redsys').'</a>
                '</form>
                <script  type="text/javascript">
	                document.getElementById("redsys_payment_form").submit();
                </script>';
    }

    function check_rds_response() {

        
        if (!empty( $_REQUEST ) ) {
            if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
                
                /** Recoger datos de respuesta **/
                $version      = $_POST["Ds_SignatureVersion"];
                $datos        = $_POST["Ds_MerchantParameters"];
                $firma_remota = $_POST["Ds_Signature"];
                
                // Se crea Objeto
                $miObj = new RedsysAPI;
                
                /** Se decodifican los datos enviados y se carga el array de datos **/
                $decodec = $miObj->decodeMerchantParameters($datos);
                
                /** Clave **/
                $kc = $this->get_option( 'clave256' );
                
                /** Se calcula la firma **/
                $firma_local = $miObj->createMerchantSignatureNotif($kc,$datos);	
                
                /** Extraer datos de la notificación **/
                $total     = $miObj->getParameter('Ds_Amount');
                $pedido    = $miObj->getParameter('Ds_Order');
                $codigo    = $miObj->getParameter('Ds_MerchantCode');
                $moneda    = $miObj->getParameter('Ds_Currency');
                $respuesta = $miObj->getParameter('Ds_Response');
                $id_trans  = $miObj->getParameter('Ds_AuthorisationCode');
                
                $merchantData = b64url_decode($miObj->getParameter('Ds_MerchantData'));
                $merchantData = json_decode( $merchantData );         
                
                $estadoFinal = $this->get_option( 'estado' );
                switch($miObj->getParameter('Ds_TransactionType')){
                    case 0:
                        $estadoFinal = $this->get_option( 'estado' );
                        break;
                    case 7:
                        $estadoFinal = $this->get_option( 'estado_autenticacion' );
                        break;
                }
                
                $idCart = $merchantData->idCart;
                $orderIdLog = $idCart . $this->fuc;
                $idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);
                
                escribirLog("INFO ", $idLog, "***** VALIDACIÓN DE LA NOTIFICACIÓN  ──  PEDIDO " . $pedido . " *****", null, __METHOD__);
                escribirLog("DEBUG", $idLog, "Parámetros de la respuesta del SIS: " . $datos, null, __METHOD__);
                escribirLog("DEBUG", $idLog, "Firma de los parámetros recibida  : " . $firma_remota, null, __METHOD__);
                escribirLog("DEBUG", $idLog, "Respuesta del SIS ─ [Ds_Response]: " . $respuesta, null, __METHOD__);

                /** Análisis de respuesta del SIS. */
                $erroresSIS = array();
                $errorBackofficeSIS = "";

                include 'erroresSIS.php';

                if (array_key_exists($respuesta, $erroresSIS)) {
                    
                    $errorBackofficeSIS  = $respuesta;
                    $errorBackofficeSIS .= ' - '.$erroresSIS[$respuesta] . '.';
                
                } else {

                    $errorBackofficeSIS = "Código de respuesta " . $respuesta . " no registrado en el módulo. Consulte el Portal de Administración del TPV Virtual.";
                }

                escribirLog("INFO ", $idLog, $errorBackofficeSIS, null, __METHOD__);

                if ($firma_local === $firma_remota 
                    && checkRespuesta($respuesta)
                    && checkMoneda($moneda)
                    && checkFuc($codigo)
                    && checkPedidoAlfaNum($pedido, $this->pedidoExtendido == 1)
                    && checkImporte($total)
                ) {
                    // Formatear variables
                    $respuesta = intval($respuesta);

                    if ($respuesta < 101 && checkAutCode($id_trans)) {
                        $order = new WC_Order($idCart);
                        $order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $errorBackofficeSIS);
                        $order->update_status($estadoFinal,__( '[REDSYS] El pedido es válido y se ha registrado correctamente. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $pedido);

                        WC_Redsys_Refund::saveOrderId($idCart, $pedido);
                        
                        escribirLog("INFO ", $idLog, "El pedido con ID de carrito " . $idCart . " (" . $pedido . ") es válido y se ha registrado correctamente.", null, __METHOD__);

                        $order->reduce_order_stock();
                        WC()->cart->empty_cart();
                    }
                    else {
                        $order = new WC_Order($idCart);
                        $order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuesta);
                        $order->update_status('cancelled',__( '[REDSYS] El pedido ha finalizado con errores. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $pedido);
                        
                        escribirLog("INFO ", $idLog, "El pedido con ID de carrito " . $idCart . " (" . $pedido . ") es válido pero ha finalizado con errores.", null, __METHOD__);
                    }
                }// if (firma_local=firma_remota)
                else {
                    // Fallo de firma o algún otro parámetro
                    // Se vacía siempre el carro por motivos de seguridad
                    $order = new WC_Order($idCart);
                    $order->add_order_note( __('[REDSYS] La validación del pedido no se ha realizado correctamente. Acceda al Portal de Administración del TPV Virtual para comprobar el estado del pago. Respuesta del SIS: ', 'woocommerce') . $errorBackofficeSIS);
                    
                    if ($respuesta < 101) {
                        if(WC_Redsys_Refund::cancellation($this, $pedido, $total, $miObj->getParameter('Ds_TransactionType') == 0)){
                            $order->update_status('cancelled',__( '[REDSYS] Se ha producido un error al validar alguno de los parámetros. Compruebe el Log generado en wp_content/uploads/wc-logs/REDSYS{fecha}{id}.log o en el Backoffice de WooCommerce. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $pedido);
                            escribirLog("ERROR", $idLog, "ERROR VALIDANDO EL PEDIDO, PERO SE HA RECIBIDO RESPUESTA OK POR PARTE DE REDSYS ── El pedido ha podido ser cobrado y anulado.", null, __METHOD__ );
                        }else{
                            $order->update_status('failed',__( '[REDSYS] ATENCIÓN: Se ha producido un error validando el pedido, pero la respuesta recibida de Redsys es OK - 0000. El pedido ha podido ser cobrado aunque figure como cancelado. Compruebe el Log generado en wp_content/uploads/wc-logs/REDSYS{fecha}{id}.log o en el Backoffice de WooCommerce. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $pedido);
                            escribirLog("ERROR", $idLog, "ERROR VALIDANDO EL PEDIDO, PERO SE HA RECIBIDO RESPUESTA OK POR PARTE DE REDSYS ── El pedido ha podido ser cobrado aunque figure como cancelado.", null, __METHOD__ );
                        }
                    } else {
                        $order->update_status('cancelled',__( '[REDSYS] Se ha producido un error al validar alguno de los parámetros. Compruebe el Log generado en wp_content/uploads/wc-logs/REDSYS{fecha}{id}.log o en el Backoffice de WooCommerce. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $pedido);                      
                    }

                    WC()->cart->empty_cart();
                    escribirLog("INFO ", $idLog, "La validación del pedido con ID de carrito " . $idCart . " (" . $pedido . ") no se ha realizado correctamente. Acceda al Portal de Administración del TPV Virtual para comprobar el estado del pago.", null, __METHOD__);
                    escribirLog("ERROR", $idLog, "Error validando el pedido con ID de carrito " . $idCart . " (" . $pedido . "). Resultado de las validaciones [Firma|Respuesta|Moneda|FUC|Pedido|Importe]: [" . checkFirma($firma_local, $firma_remota) . "|" . checkRespuesta($respuesta) . "|" . checkMoneda($moneda) . "|" . checkFuc($codigo) . "|" . checkPedidoAlfaNum($pedido, $this->pedidoExtendido == 1) . "|" . checkImporte($total) . "]", null, __METHOD__ );
                    //wp_redirect(WC()->plugin_url()."/includes/gateways/redsys/pages/failure.php?pedido=".$idCart);
                }		
            }
            else{
                wp_die( '<img src="'.home_url().'/wp-content/plugins/redsys/pages/assets/images/cross.png" alt="Desactivado" title="Desactivado" />
                Fallo en el proceso de pago.<br>Su pedido ha sido cancelado.' );
            }
        } 
        else{
            wp_die( '<img src="'.home_url().'/wp-content/plugins/redsys/pages/assets/images/cross.png" alt="Desactivado" title="Desactivado" />
            Fallo en el proceso de pago.<br>Su pedido ha sido cancelado.' );
        }

    }

    function receipt_page( $order ) {

        $orderIdLog = $order . $this->fuc;
        $idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);
        escribirLog("DEBUG", $idLog, "Acceso a la página de confirmación (intermedia) de pago con tarjeta de Redsys.", null, __METHOD__);
        
        echo '<p>'.__('Gracias por su pedido, por favor pulsa el botón para pagar con Bizum.', 'redsys').'</p>';
        echo $this -> generate_redsys_form($order);
    }

    function advertencia_sandbox() {
        if ( $this->entorno == 0 && $this->enabled == 'yes' ) {
            wc_print_notice( sprintf(
                __("%s El método de pago '%s' está configurado para operar en entorno de pruebas, por lo que los %s de esta orden no tendrán efecto contable si este método de pago es utilizado.", "woocommerce"),
                '<strong>' . __("Advertencia:", "woocommerce") . '</strong>',
                $this->title,
                strip_tags( wc_price( WC()->cart->get_subtotal() ) )
            ), 'notice' );
        }
    }

    function escribirLog_wc($texto,$activo) {
        if($activo=="si"){
            // Log
            $this->log->add( 'redsys', $texto."\r\n");
        }
    }

	public function process_refund($order_id, $amount = 0, $reason = '', $idLog = null){
		$idLog = generateIdLog($this->activar_log, $this->logString, $order_id);

		return WC_Redsys_Refund::refund($this, $order_id, $amount, $reason);
    }
}