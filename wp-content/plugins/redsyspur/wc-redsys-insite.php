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
if(!class_exists("WC_Redsys_Ref")) {
	require_once('wc-redsys-ref.php');
}
if(!class_exists("WC_Redsys_Refund")) {
	require_once('wc-redsys-refund.php');
}

include_once ABSPATH.'/wp-content/plugins/redsyspur/ApiRedsysREST/initRedsysApi.php';

class WC_Redsys_Insite extends WC_Payment_Gateway {

	public $id;
    public $method_title;
    public $method_description;
    public $process_url;
    public $ref_process_url;
    public $secure_redir_url;
    public $secure_redir_v2_url;
    public $secure_back_url;
    public $secure_back_v2_url;
    public $has_fields;
    public $version;
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
    public $with3ds;
    public $withref;
    public $button_text;
    public $button_style;
    public $body_style;
    public $form_style;
    public $form_text_style;
    public $moneda;
    public $logString;

    public function __construct() {
        $this->id                 = 'redsys_insite';
        //$this->icon               = home_url() . '/wp-content/plugins/redsyspur/pages/assets/images/Redsys.png';
        $this->method_title       = __( 'inSite · Pasarela Unificada de Redsys para WooCommerce', 'woocommerce' );
        $this->method_description = __( 'Permita a sus clientes pagar con tarjeta sin salir de su web usando los servicios de Redsys.', 'woocommerce' );
        
		$this->process_url         = add_query_arg( 'wc-api', 'WC_redsys_process', home_url( '/' ) );
        $this->ref_process_url     = add_query_arg( 'wc-api', 'WC_redsys_ref_process', home_url( '/' ) );
        $this->secure_redir_url    = add_query_arg( 'wc-api', 'WC_redsys_secure_redir', home_url( '/' ) );
		$this->secure_redir_v2_url = add_query_arg( 'wc-api', 'WC_redsys_secure_redir_v2', home_url( '/' ) );
        $this->secure_back_url     = add_query_arg( 'wc-api', 'WC_redsys_secure_back', home_url( '/' ) );
		$this->secure_back_v2_url  = add_query_arg( 'wc-api', 'WC_redsys_secure_back_v2', home_url( '/' ) );

        $this->has_fields         = false;
        $this->version			  = MODULE_VERSION;
        
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
        $this->activar_log	  	  = $this->get_option( 'activar_log' );
        $this->estado             = $this->get_option( 'estado' );
		$this->genPedido	      = $this->get_option( 'genPedido' );
//         $this->withdcc            = $this->get_option( 'withdcc' );
        $this->with3ds            = $this->get_option( 'with3ds' );
        $this->withref            = $this->get_option( 'withref' );

        $this->button_text        = $this->get_option( 'button_text' );
        $this->button_style       = $this->get_option( 'button_style' );
        $this->body_style         = $this->get_option( 'body_style' );
        $this->form_style         = $this->get_option( 'form_style' );
        $this->form_text_style    = $this->get_option( 'form_text_style' );

		//moneda a usar
        $this->moneda = currency_code(get_option('woocommerce_currency'));

		//idLog
        $this->logString          = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Actions
        add_action( 'woocommerce_receipt_redsys_insite', array( $this, 'receipt_page' ) );
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        //Payment listener/API hook
        add_action( 'woocommerce_api_wc_redsys_process', array( $this, 'process_usual_order' ) );
        add_action( 'woocommerce_api_wc_redsys_ref_process', array( $this, 'process_reference_order' ) );
        add_action( 'woocommerce_api_wc_redsys_secure_redir', array( $this, 'redirect_to_tdsecure_v1' ) );
		add_action( 'woocommerce_api_wc_redsys_secure_redir_v2', array( $this, 'redirect_to_tdsecure_v2' ) );
        add_action( 'woocommerce_api_wc_redsys_secure_back', array( $this, 'back_from_tdsecure' ) );
		add_action( 'woocommerce_api_wc_redsys_secure_back_v2', array( $this, 'back_from_tdsecure_v2' ) );
    }

	public static function createEndpointParams($endpoint, $object, $idCart, $protocolVersion = null, $idLog = null) {

		$endpoint .= "&order=".$object->getOrder();
		$endpoint .= "&currency=".$object -> getCurrency();
		$endpoint .= "&amount=".$object -> getAmount();
		$endpoint .= "&merchant=".$object -> getMerchant();
		$endpoint .= "&terminal=".$object -> getTerminal();
		$endpoint .= "&transactionType=".$object -> getTransactionType();
		$endpoint .= "&idCart=".$idCart;
	   
		if (!empty($protocolVersion))
			$endpoint .= "&protocolVersion=".$protocolVersion;
		
		if (!empty($idLog))
			$endpoint .= "&idLog=".$idLog;
	   
		return $endpoint;
	}
    
    function process_usual_order() {

		$origIdCart=$_POST["origIdCart"];

		$orderIdLog = $origIdCart . $this->fuc;
    	$idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);

    	$order=new WC_Order($origIdCart);

		$this->moneda = currency_code(get_option('woocommerce_currency'));

		$merchantModule = 'WO-PUR v' . MODULE_VERSION;

		escribirLog("DEBUG", $idLog, "Versión del módulo: " . $merchantModule, null, __METHOD__);
        escribirLog("DEBUG", $idLog, "Versión de Wordpress: " . $GLOBALS['wp_version'], null, __METHOD__);
		escribirLog("DEBUG", $idLog, "Versión de WooCommerce: " . WC_VERSION, null, __METHOD__);
		escribirLog("DEBUG", $idLog, "Versión de PHP: " . phpversion(), null, __METHOD__);

        //Calculo del precio total del pedido
        $currency_decimals = get_option('woocommerce_price_num_decimals');

        $transaction_amount = number_format( (float) ($order->get_total()), intval($currency_decimals), '.', '' );
        $transaction_amount = str_replace('.','',$transaction_amount);
        $transaction_amount = floatval($transaction_amount);
        
        $productos="";
        $products = WC()->cart->cart_contents;
        foreach ($products as $product) {
            $productos .= $product['quantity'].'x'.$product['data']->post->post_title.'/';
        }
		
		//Peticion de datos de tarjeta. (IniciaPeticion)
		$initialRequest = new RESTInitialRequestMessage();
		$initialRequest->setAmount ( $transaction_amount );
    	$initialRequest->setCurrency ( $this->moneda );
    	$initialRequest->setMerchant ( $this->fuc  );
    	$initialRequest->setTerminal ( $this->terminal  );
    	$initialRequest->setOrder ( $_POST["idCart"] );
    	$initialRequest->setOperID ( $_POST["operID"] );
    	$initialRequest->setTransactionType ( $this->tipopago );
		$initialRequest->demandCardData();

		$service = new RESTInitialRequestService ( $this->clave256, $this->entorno );
		$initialResult = $service -> sendOperation($initialRequest, $idLog);
    	
		//Creación de objeto para la petición.
    	$request = new RESTOperationMessage ();
    	$request->setAmount ( $transaction_amount );
    	$request->setCurrency ( $this->moneda );
    	$request->setMerchant ( $this->fuc  );
    	$request->setTerminal ( $this->terminal  );
    	$request->setOrder ( $_POST["idCart"] );
    	$request->setOperID ( $_POST["operID"] );
    	$request->setTransactionType ( $this->tipopago );
		$request->addParameter ( "DS_MERCHANT_TITULAR", $order -> billing_first_name." ".$order -> billing_last_name );
		$request->addParameter ( "DS_MERCHANT_PRODUCTDESCRIPTION", $productos );
		$request->addParameter ( "DS_MERCHANT_MODULE", $merchantModule );
		$ip = $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'];
		$request->addParameter ( "DS_MERCHANT_CLIENTIP", $ip );
		$ThreeDSParams = $_POST["valores3DS"];
		$ThreeDSInfo = $initialResult->protocolVersionAnalysis();
		

		if ($this->with3ds) {

			$version = explode( '.', $ThreeDSInfo);			
			if ($version[0] == "1") {

				escribirLog("DEBUG", $idLog, "Versión de 3DSecure: " . $ThreeDSInfo, null, __METHOD__);
				$request -> setEMV3DSParamsV1();
	
			} else {

				escribirLog("DEBUG", $idLog, "Versión de 3DSecure: " . $ThreeDSInfo, null, __METHOD__);
				$decoded3DS = json_decode(str_replace("\\","",$ThreeDSParams));

				$browserAcceptHeader = "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8,application/json";
				$browserUserAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36";
				$browserJavaEnable = $decoded3DS->browserJavaEnabled;
				$browserJavaScriptEnabled = $decoded3DS->browserJavascriptEnabled;
				$browserLanguage = $decoded3DS->browserLanguage;
				$browserColorDepth = $decoded3DS->browserColorDepth;
				$browserScreenHeight = $decoded3DS->browserScreenHeight;
				$browserScreenWidth = $decoded3DS->browserScreenWidth;
				$browserTZ = $decoded3DS->browserTZ;
				$threeDSCompInd = "N";
				$threeDSServerTransID = $initialResult -> getThreeDSServerTransID();
				$notificationURL = WC_Redsys_Insite::createEndpointParams($this->secure_back_v2_url, $request, $origIdCart, $ThreeDSInfo, $idLog);
				
				$request -> setEMV3DSParamsV2($ThreeDSInfo, $browserAcceptHeader, $browserUserAgent, $browserJavaEnable, $browserJavaScriptEnabled, $browserLanguage, $browserColorDepth, $browserScreenHeight, $browserScreenWidth, $browserTZ, $threeDSServerTransID, $notificationURL, $threeDSCompInd);
	
			}

		} else {

			$request->useDirectPayment ();
		}
		
		if($this->withref && $_POST["save"] === "true"  && is_user_logged_in()) {
			$request->createReference ();
			escribirLog("INFO ", $idLog, "Se ha recibido una petición para guardar la referencia del cliente.", null, __METHOD__);
		}

		$service = new RESTOperationService ( $this->clave256, $this->entorno );
		$result = $service->sendOperation ( $request, $idLog );

		$estadoFinal = $this->get_option( 'estado' );
		switch($result->getOperation()->getTransactionType()){
			case 0:
				$estadoFinal = $this->get_option( 'estado' );
				break;
			case 1:
				$estadoFinal = $this->get_option( 'estado_preautorizacion' );
				break;
			case 7:
				$estadoFinal = $this->get_option( 'estado_autenticacion' );
				break;
		}

		$ThreeDSInfo = $result->protocolVersionAnalysis();
		
		$resultCode = $result->getResult ();
		$apiCode = $result->getApiCode ();
		$authCode = $result->getAuthCode ();

		$respuestaSIS = WC_Redsys_Insite::checkRespuestaSIS($apiCode, $authCode);

		if ($result->getResult () == RESTConstants::$RESP_LITERAL_OK) {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->add_order_note( __('[REDSYS] Este pedido ha implicado un pago frictionless', 'woocommerce'));
			$order->update_status($estadoFinal,__( '[REDSYS] El pedido es válido y se ha registrado correctamente. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);

			WC_Redsys_Refund::saveOrderId($origIdCart, $_POST["idCart"]);
			
			$reference=$result->getOperation()->getMerchantIdentifier();
			if($reference!=null){
				$idCustomer=get_post_meta($origIdCart, '_customer_user', true);
				$cardNumber=$result->getOperation()->getCardNumber();
				$brand=$result->getOperation()->getCardBrand();
				$cardType=$result->getOperation()->getCardType();
				
				WC_Redsys_Ref::saveReference($idCustomer, $reference, $cardNumber, $brand, $cardType);
			}
			
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);
	    	header('Content-Type: application/json');
			die(json_encode(array("redir"=>true, "url"=>$this->get_return_url($order))));
		}
		else{
			if ($result->getResult () == RESTConstants::$RESP_LITERAL_AUT) {

		    	header('Content-Type: application/json');

				if ($ThreeDSInfo == "1.0.2") {

					$termURL = WC_Redsys_Insite::createEndpointParams($this->secure_back_url, $result->getOperation (), $origIdCart, null, $idLog);

					WC()->session->set('REDSYS_pareq', $result->getPAReqParameter ());
					WC()->session->set('REDSYS_urlacs', $result->getAcsURLParameter ());
					WC()->session->set('REDSYS_md', $result->getMDParameter ());
					WC()->session->set('REDSYS_termURL', $termURL);

					escribirLog("DEBUG", $idLog, "URL con parámetros: " . $termURL, null, __METHOD__);

					die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_url)));

				} else {

					WC()->session->set('REDSYS_creq', $result->getCreqParameter ());
					WC()->session->set('REDSYS_urlacs', $result->getAcsURLParameter ());

					die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_v2_url)));
				}
				
			} else {
				$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
				$order->update_status('cancelled',__( '[REDSYS] El pedido ha finalizado con errores. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
				
				escribirLog("INFO ", $idLog, $respuestaSIS[0]);
		    	header('Content-Type: application/json');
				die(json_encode(array("redir"=>true, "url"=>str_replace("&amp;","&",$order->get_cancel_order_url()))));
			}
		}
    }

    function process_reference_order() {

    	$origIdCart=$_POST["origIdCart"];
    	$order=new WC_Order($origIdCart);

		$orderIdLog = $origIdCart . $this->fuc;
    	$idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);
    	
		$userId=get_post_meta($origIdCart, '_customer_user', true);
		$ref=WC_Redsys_Ref::getCustomerRef($userId);

		$merchantModule = 'WO-PUR v' . MODULE_VERSION;
    
        //Calculo del precio total del pedido
        $currency_decimals = get_option('woocommerce_price_num_decimals');

        $transaction_amount = number_format( (float) ($order->get_total()), intval($currency_decimals), '.', '' );
        $transaction_amount = str_replace('.','',$transaction_amount);
        $transaction_amount = floatval($transaction_amount);
    
    	$productos="";
    	$products = WC()->cart->cart_contents;
    	foreach ($products as $product) {
    		$productos .= $product['quantity'].'x'.$product['data']->post->post_title.'/';
    	}

		//Peticion de datos de tarjeta. (IniciaPeticion)
		$initialRequest = new RESTInitialRequestMessage();
		$initialRequest->setAmount ( $transaction_amount );
    	$initialRequest->setCurrency ( $this->moneda );
    	$initialRequest->setMerchant ( $this->fuc  );
    	$initialRequest->setTerminal ( $this->terminal  );
    	$initialRequest->setOrder ( $_POST["idCart"] );
    	$initialRequest->useReference($ref[0]);
    	$initialRequest->setTransactionType ( $this->tipopago );
		$initialRequest->demandCardData();

		$service = new RESTInitialRequestService ( $this->clave256, $this->entorno );
		$initialResult = $service -> sendOperation($initialRequest, $idLog);
    	 
    	$request = new RESTOperationMessage ();
    	$request->setAmount ( $transaction_amount );
    	$request->setCurrency ( $this->moneda );
    	$request->setMerchant ( $this->fuc  );
    	$request->setTerminal ( $this->terminal  );
    	$request->setOrder ( $_POST["idCart"] );
    	$request->setTransactionType ( $this->tipopago );
    	$request->addParameter ( "DS_MERCHANT_TITULAR", $order -> billing_first_name." ".$order -> billing_last_name );
    	$request->addParameter ( "DS_MERCHANT_PRODUCTDESCRIPTION", $productos );
    	$request->addParameter ( "DS_MERCHANT_MODULE", $merchantModule );
    	$request->useReference($ref[0]);
    	$ip = $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'];
		$request->addParameter ( "DS_MERCHANT_CLIENTIP", $ip );
		$ThreeDSParams = $_POST["valores3DS"];
		$ThreeDSInfo = $initialResult->protocolVersionAnalysis();

		if ($this->with3ds) {

			$version = explode( '.', $ThreeDSInfo);			
			if ($version[0] == "1") {

				escribirLog("DEBUG", $idLog, "Versión de 3DSecure: " . $ThreeDSInfo, null, __METHOD__);
				$request -> setEMV3DSParamsV1();
	
			} else {

				escribirLog("DEBUG", $idLog, "Versión de 3DSecure: " . $ThreeDSInfo, null, __METHOD__);
				$decoded3DS = json_decode(str_replace("\\","",$ThreeDSParams));

				$browserAcceptHeader = "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8,application/json";
				$browserUserAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36";
				$browserJavaEnable = $decoded3DS->browserJavaEnabled;
				$browserJavaScriptEnabled = $decoded3DS->browserJavascriptEnabled;
				$browserLanguage = $decoded3DS->browserLanguage;
				$browserColorDepth = $decoded3DS->browserColorDepth;
				$browserScreenHeight = $decoded3DS->browserScreenHeight;
				$browserScreenWidth = $decoded3DS->browserScreenWidth;
				$browserTZ = $decoded3DS->browserTZ;
				$threeDSCompInd = "N";
				$threeDSServerTransID = $initialResult -> getThreeDSServerTransID();
				$notificationURL = WC_Redsys_Insite::createEndpointParams($this->secure_back_v2_url, $request, $origIdCart, $ThreeDSInfo, $idLog);
				
				$request -> setEMV3DSParamsV2($ThreeDSInfo, $browserAcceptHeader, $browserUserAgent, $browserJavaEnable, $browserJavaScriptEnabled, $browserLanguage, $browserColorDepth, $browserScreenHeight, $browserScreenWidth, $browserTZ, $threeDSServerTransID, $notificationURL, $threeDSCompInd);
	
			}

		} else {

			$request->useDirectPayment ();
		}
		
    	$service = new RESTOperationService ( $this->clave256, $this->entorno );
    	$result = $service->sendOperation ( $request, $idLog );

		$estadoFinal = $this->get_option( 'estado' );
		switch($result->getOperation()->getTransactionType()){
			case 0:
				$estadoFinal = $this->get_option( 'estado' );
				break;
			case 1:
				$estadoFinal = $this->get_option( 'estado_preautorizacion' );
				break;
			case 7:
				$estadoFinal = $this->get_option( 'estado_autenticacion' );
				break;
		}

		$ThreeDSInfo = $result->protocolVersionAnalysis();
		
		$resultCode = $result->getResult ();
		$apiCode = $result->getApiCode ();
		$authCode = $result->getAuthCode ();

		$respuestaSIS = WC_Redsys_Insite::checkRespuestaSIS($apiCode, $authCode);
		
    	if ($result->getResult () == RESTConstants::$RESP_LITERAL_OK) {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->add_order_note( __('[REDSYS] Este pedido se ha pagado usando pago por referencia', 'woocommerce'));
			$order->update_status($estadoFinal,__( '[REDSYS] El pedido es válido y se ha registrado correctamente. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);

			WC_Redsys_Refund::saveOrderId($origIdCart, $_POST["idCart"]);
    			
    		$reference=$result->getOperation()->getMerchantIdentifier();
    		if($reference!=null){
    			$idCustomer=get_post_meta($origIdCart, '_customer_user', true);
    			$cardNumber=$result->getOperation()->getCardNumber();
    			$brand=$result->getOperation()->getCardBrand();
    			$cardType=$result->getOperation()->getCardType();
    
    			WC_Redsys_Ref::saveReference($idCustomer, $reference, $cardNumber, $brand, $cardType);
    		}
			
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);
    		header('Content-Type: application/json');
    		die(json_encode(array("redir"=>true, "url"=>$this->get_return_url($order))));
    	}
    	else{
			if ($result->getResult () == RESTConstants::$RESP_LITERAL_AUT) {
		    	header('Content-Type: application/json');

				if ($ThreeDSInfo == "1.0.2") {

					$termURL = WC_Redsys_Insite::createEndpointParams($this->secure_back_url, $result->getOperation (), $origIdCart, null, $idLog);

					WC()->session->set('REDSYS_pareq', $result->getPAReqParameter ());
					WC()->session->set('REDSYS_urlacs', $result->getAcsURLParameter ());
					WC()->session->set('REDSYS_md', $result->getMDParameter ());
					WC()->session->set('REDSYS_termURL', $termURL);

					escribirLog("DEBUG", $idLog, "URL con parámetros: " . $termURL, null, __METHOD__);

					die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_url)));

				} else {

					WC()->session->set('REDSYS_creq', $result->getCreqParameter ());
					WC()->session->set('REDSYS_urlacs', $result->getAcsURLParameter ());

					die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_v2_url)));
				}

			} else {
				$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
				$order->add_order_note( __('[REDSYS] Este pedido se ha pagado usando pago por referencia', 'woocommerce'));
				$order->update_status('cancelled',__( '[REDSYS] El pedido ha finalizado con errores. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
				
				escribirLog("INFO ", $idLog, $respuestaSIS[0]);

				header('Content-Type: application/json');
				die(json_encode(array("redir"=>true, "url"=>str_replace("&amp;","&",$order->get_cancel_order_url()))));
			}
    	}
    }
    
    function redirect_to_tdsecure_v1() {

    	$form='<iframe name="redsys_iframe_acs" name="redsys_iframe_acs" src=""
	    		id="redsys_iframe_acs"
	    		sandbox="allow-same-origin allow-scripts allow-top-navigation allow-forms"
	    		height="95%" width="100%" style="border: none; display: none;"></iframe>
	    	
    	<form name="redsysAcsForm" id="redsysAcsForm"
    		action="'.WC()->session->get( "REDSYS_urlacs" ).'" method="POST"
    		target="redsys_iframe_acs" style="border: none;">
    		<table name="dataTable" border="0" cellpadding="0">
    			<input type="hidden" name="PaReq"
    				value="'.WC()->session->get( "REDSYS_pareq" ).'">
    			<input type="hidden" name="TermUrl"
    				value="'.WC()->session->get( "REDSYS_termURL" ).'">
    			<input type="hidden" name="MD"
    				value="'.WC()->session->get( "REDSYS_md" ).'">
    			<br>
    			<p
    				style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
    				Conectando con el emisor...</p>
    		</table>
    	</form>
	    	
    	<script>
    		window.onload = function () {
    		    document.getElementById("redsys_iframe_acs").onload = function() {
    		    	document.getElementById("redsysAcsForm").style.display="none";
    		    	document.getElementById("redsys_iframe_acs").style.display="inline";
    		    }
    			document.redsysAcsForm.submit();
    		}
    	</script>';


    	WC()->session->set('REDSYS_pareq', null);
    	WC()->session->set('REDSYS_urlacs', null);
    	WC()->session->set('REDSYS_md', null);
		WC()->session->set('REDSYS_termURL', null);

    	die($form);
    }

	function redirect_to_tdsecure_v2() {

    	$form='<iframe name="redsys_iframe_acs" name="redsys_iframe_acs" src=""
		id="redsys_iframe_acs" target="_parent" referrerpolicy="origin"
		sandbox="allow-same-origin allow-scripts allow-top-navigation allow-forms"
		height="95%" width="100%" style="border: none; display: none;"></iframe>

		<form name="redsysAcsForm" id="redsysAcsForm"
			action="'.WC()->session->get( "REDSYS_urlacs" ).'" method="POST"
			target="redsys_iframe_acs" style="border: none;">
			<table name="dataTable" border="0" cellpadding="0">
				<input type="hidden" name="creq"
					value="'.WC()->session->get( "REDSYS_creq" ).'">
				<br>
				<p
					style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
					Conectando con el emisor...</p>
			</table>
		</form>
				
		<script>
			window.onload = function () {
				document.getElementById("redsys_iframe_acs").onload = function() {
					document.getElementById("redsysAcsForm").style.display="none";
					document.getElementById("redsys_iframe_acs").style.display="inline";
				}
				document.redsysAcsForm.submit();
			}
		</script>';

		$idCart = WC()->session->get("REDSYS_idCart");

    	WC()->session->set('REDSYS_creq', null);
    	WC()->session->set('REDSYS_urlacs', null);
		WC()->session->set('REDSYS_idCart', null);

    	die($form);
    }
    
    function back_from_tdsecure() {

		$origIdCart = $_GET["idCart"];

		$orderIdLog = $origIdCart . $this->fuc;
    	$idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);

		$request = new RESTAuthenticationRequestMessage ();

		$request->setOrder ( $_GET['order'] );
		$request->setAmount ( $_GET['amount'] );
		$request->setCurrency ( $_GET['currency'] );
		$request->setMerchant ( $_GET['merchant'] );
		$request->setTerminal ( $_GET['terminal'] );
		$request->setTransactionType ( $_GET['transactionType'] );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_THREEDSINFO_ENTRY , RESTConstants::$RESPONSE_3DS_CHALLENGE_RESPONSE );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_PROTOCOL_VERSION_ENTRY , RESTConstants::$RESPONSE_3DS_VERSION_1 );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_PARES_ENTRY , $_POST ["PaRes"] );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_MD_ENTRY , $_POST ["MD"] );
			
		$service = new RESTOperationService ( $this->clave256, $this->entorno );
		$result = $service->sendOperation ( $request, $idLog );

		$estadoFinal = $this->get_option( 'estado' );
		switch($result->getOperation()->getTransactionType()){
			case 0:
				$estadoFinal = $this->get_option( 'estado' );
				break;
			case 1:
				$estadoFinal = $this->get_option( 'estado_preautorizacion' );
				break;
			case 7:
				$estadoFinal = $this->get_option( 'estado_autenticacion' );
				break;
		}

		
		$order=new WC_Order($origIdCart);
		escribirLog("DEBUG", $idLog, "Orden que se va a validar: " . $order, null, __METHOD__);
		
		$resultCode = $result->getResult ();
		$apiCode = $result->getApiCode ();
		$authCode = $result->getAuthCode ();

		$respuestaSIS = WC_Redsys_Insite::checkRespuestaSIS($apiCode, $authCode);

		if ($result->getResult () == RESTConstants::$RESP_LITERAL_OK) {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->update_status($estadoFinal,__( '[REDSYS] El pedido es válido y se ha registrado correctamente. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
			$urlDst=$this->get_return_url($order);

			WC_Redsys_Refund::saveOrderId($_GET['idCart'], $_GET['order']);
			
			$reference=$result->getOperation()->getMerchantIdentifier();
			if($reference!=null){
				$idCustomer=get_post_meta($origIdCart, '_customer_user', true);
				$cardNumber=$result->getOperation()->getCardNumber();
				$brand=$result->getOperation()->getCardBrand();
				$cardType=$result->getOperation()->getCardType();
				
				WC_Redsys_Ref::saveReference($idCustomer, $reference, $cardNumber, $brand, $cardType);
			}

			escribirLog("INFO ", $idLog, "La orden es correcta y se ha validado satisfactoriamente", null, __METHOD__);
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);

		} else {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->update_status('cancelled',__( '[REDSYS] El pedido ha finalizado con errores. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
			$urlDst=str_replace("&amp;","&",$order->get_cancel_order_url());

			escribirLog("INFO ", $idLog, "La orden se ha cancelado porque se ha recibido una respuesta negativa", null, __METHOD__);
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);
		}
		
		$form= '<p style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
					Procesando operación...
				</p>
				<script>
					window.top.top.location.href="'.$urlDst.'";
				</script>';
		
		die($form);
	}

	function back_from_tdsecure_v2() {

		$origIdCart=$_GET["idCart"];

		$orderIdLog = $origIdCart . $this->fuc;
    	$idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);

		$request = new RESTAuthenticationRequestMessage ();

		$request->setOrder ( $_GET['order'] );
		$request->setAmount ( $_GET['amount'] );
		$request->setCurrency ( $_GET['currency'] );
		$request->setMerchant ( $_GET['merchant'] );
		$request->setTerminal ( $_GET['terminal'] );
		$request->setTransactionType ( $_GET['transactionType'] ); 
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_THREEDSINFO_ENTRY , RESTConstants::$RESPONSE_3DS_CHALLENGE_RESPONSE );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_JSON_PROTOCOL_VERSION_ENTRY , $_GET['protocolVersion'] );
		$request->addEmvParameter ( RESTConstants::$RESPONSE_MERCHANT_EMV3DS_CRES , $_POST ["cres"] );
			
		$service = new RESTOperationService ( $this->clave256, $this->entorno );
		$result = $service->sendOperation ( $request, $idLog );

		$estadoFinal = $this->get_option( 'estado' );
		switch($result->getOperation()->getTransactionType()){
			case 0:
				$estadoFinal = $this->get_option( 'estado' );
				break;
			case 1:
				$estadoFinal = $this->get_option( 'estado_preautorizacion' );
				break;
			case 7:
				$estadoFinal = $this->get_option( 'estado_autenticacion' );
				break;
		}

		$order = new WC_Order($origIdCart);
		
		$resultCode = $result->getResult ();
		$apiCode = $result->getApiCode ();
		$authCode = $result->getAuthCode ();

		$respuestaSIS = WC_Redsys_Insite::checkRespuestaSIS($apiCode, $authCode);		

		if ($result->getResult () == RESTConstants::$RESP_LITERAL_OK) {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->update_status($estadoFinal,__( '[REDSYS] El pedido es válido y se ha registrado correctamente. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
			$urlDst = $this->get_return_url($order);

			WC_Redsys_Refund::saveOrderId($_GET['idCart'], $_GET['order']);
			
			$reference=$result->getOperation()->getMerchantIdentifier();
			if($reference!=null){
				$idCustomer=get_post_meta($origIdCart, '_customer_user', true);
				$cardNumber=$result->getOperation()->getCardNumber();
				$brand=$result->getOperation()->getCardBrand();
				$cardType=$result->getOperation()->getCardType();
				
				WC_Redsys_Ref::saveReference($idCustomer, $reference, $cardNumber, $brand, $cardType);
			}
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);
		} else {

			$order->add_order_note( __('[REDSYS] Respuesta del SIS: ', 'woocommerce') . $respuestaSIS[0]);
			$order->update_status('cancelled',__( '[REDSYS] El pedido ha finalizado con errores. Número de pedido enviado a Redsys: ', 'woocommerce' ) . $origIdCart);
			$urlDst = str_replace("&amp;","&",$order->get_cancel_order_url());
			escribirLog("INFO ", $idLog, $respuestaSIS[0]);
		}

		$form= '<p style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
					Procesando operación...
				</p>
				<script>
					window.top.top.location.href="'.$urlDst.'";
				</script>';

		die($form);
	}

    function process_payment( $order_id ) {
        global $woocommerce;
        $order = new WC_Order($order_id);

        // Return receipt_page redirect
        return array(
            'result' 	=> 'success',
            'redirect'	=> $order->get_checkout_payment_url( true )
        );
    }
    
    function receipt_page( $order ) { //FIJACION DE DATOS.

		$orderIdLog = $order . $this->fuc;
		$idLog = generateIdLog($this->activar_log, $this->logString, $orderIdLog);

    	$allowReference=$this->withref=="1" && is_user_logged_in();
    	$body_style=$this->body_style;
    	$form_style=$this->form_style;
    	$form_text_style=$this->form_text_style;
    	$btnStyle=$this->button_style;
    	$btnText=$this->button_text;

    	//Objeto tipo pedido
    	$orderWC = new WC_Order($order);
		$numpedido = generaNumeroPedido($order, $this->get_option('genPedido'));
    	
    	$html=file_get_contents(ABSPATH.'/wp-content/plugins/redsyspur/pages/templates/paymentform.html');
    	$redsysJs=RESTConstants::getJSPath($this->entorno);
    	$staticPath=home_url().'/wp-content/plugins/redsyspur/pages/assets';    
    	$urlKo=$orderWC->get_cancel_order_url();

		$isLogged = is_user_logged_in();
		$userId=get_post_meta($order, '_customer_user', true);

		escribirLog("DEBUG", $idLog, "**************************");
		escribirLog("INFO ", $idLog, "****** NUEVO PEDIDO ******");
		escribirLog("INFO ", $idLog, "****** ". $numpedido ." ******");
		escribirLog("DEBUG", $idLog, "**************************");

		escribirLog("INFO ", $idLog, "Pago con Tarjeta inSite", null, __METHOD__);
		escribirLog("INFO ", $idLog, "ID del usuario cargado: " . $userId, null, __METHOD__);

		if ($isLogged == true)
			escribirLog("INFO ", $idLog, "El usuario que hace el pedido está logueado en la página", null, __METHOD__);
		else
			escribirLog("INFO ", $idLog, "El usuario que hace el pedido no está logueado en la página", null, __METHOD__);

		$brandImg="";
		$refTitle="";
		$ref = null;
		if($allowReference && $isLogged){
			$ref=WC_Redsys_Ref::getCustomerRef($userId);
			if($ref!=null && $ref[2]!=null)
				$brandImg='<img src="'.home_url().'/wp-content/plugins/redsyspur/pages/assets/images/brands/'.$ref[2].'.jpg" style="display: inline;"/>';
			
			if($ref!=null){
				$refTitle="Usar tarjeta guardada ";
				if($ref[3]=="C")
					$refTitle="Usar tarjeta de crédito guardada ";
				else
					$refTitle="Usar tarjeta de débito guardada ";
				
				if($ref[1]!=null)
					$refTitle.=$ref[1];
			}
		}

		$html=str_replace("{merchantCode}",$this->fuc,$html);
		$html=str_replace("{merchantTerminal}",$this->terminal,$html);
    	$html=str_replace("{redsysJs}",$redsysJs,$html);
    	$html=str_replace("{staticPath}",$staticPath,$html); 
    	$html=str_replace("{origIdCart}",$order,$html);    
    	$html=str_replace("{idCart}",$numpedido,$html);    
    	$html=str_replace("{allowReference}",$allowReference?"true":"false",$html);
    	$html=str_replace("{displayReference}",!$allowReference || !$isLogged?'display: none; ':'',$html);
    	$html=str_replace("{displayRadios}",$ref!=null?'':'display: none; ',$html);
    	$html=str_replace("{referenceTitle}",$refTitle,$html);
    	$html=str_replace("{cardBrandLogo}",$brandImg,$html);
    	$html=str_replace("{procUrl}",$this->process_url,$html);
    	$html=str_replace("{procUrlRef}",$this->ref_process_url,$html);
    	$html=str_replace("{body_style}",$body_style,$html);
    	$html=str_replace("{form_style}",$form_style,$html);
    	$html=str_replace("{form_text_style}",$form_text_style,$html);
    	$html=str_replace("{btnStyle}",$btnStyle,$html);
    	$html=str_replace("{btnText}",$btnText,$html);
    	$html=str_replace("{urlKo}",str_replace("&amp;","&",$urlKo),$html);
    	
    	
    	echo $html;
    }

	function checkRespuestaSIS($codigo_respuesta, $authCode) {

		$erroresSIS = array();
		$errorBackofficeSIS = "";
	   
		include 'erroresSIS.php';
	   
		if (array_key_exists($codigo_respuesta, $erroresSIS)) {
		
			$errorBackofficeSIS = $codigo_respuesta;
			$errorBackofficeSIS .= ' - '.$erroresSIS[$codigo_respuesta].'.';
		
		} else {
	   
			$errorBackofficeSIS = "La operación ha finalizado con errores. Consulte el módulo de administración del TPV Virtual.";
		}
	   
		$metodoOrder = "N/A";
	   
		if (($codigo_respuesta < 101) && (strpos($codigo_respuesta, "SIS") === false))
			$metodoOrder = "Autorizada " . $authCode; 

		else {

			if (strpos($codigo_respuesta, "SIS") !== false)
				$metodoOrder = "Error " . $codigo_respuesta;
			else 
				$metodoOrder = "Denegada " . $codigo_respuesta;
		}

		return array($errorBackofficeSIS, $metodoOrder);
	}

    function init_form_fields() {
    	global $woocommerce;
    
    	$this->form_fields = array(
                'enabled' => array(
                    'title'       => __( 'Activación del Módulo', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Activa o desactiva el Módulo de pago con Tarjeta', 'woocommerce' ),
                    'default'     => 'yes',
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
                        'default'     => __( 'Pagar con Tarjeta', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'description' => array(
                        'title'       => __( 'Descripción del método de Pago', 'woocommerce' ),
                        'type'        => 'text',
                        'description' => __( 'Descripción del método de Pago que el cliente verá en la página de compra.', 'woocommerce' ),
                        'default'     => __( 'Pague con tarjeta usando los servicios de Redsys.', 'woocommerce' ),
                        'desc_tip'    => true,
                ),
                'entorno' => array(
                        'title'       => __( 'Entorno de Operación', 'woocommerce' ),
                        'type'        => 'select',
                        'description' => __( 'Entorno donde procesar el pago. <br>Recuerde no activar el modo "Sandbox" en su entorno de producción, de lo contrario podrían producirse ventas no deseadas. Dispone de más información sobre cómo realizar pruebas <a href=https://pagosonline.redsys.es/entornosPruebas.html target="_blank" rel="noopener noreferrer">aquí</a>.', 'woocommerce' ),
                        'default'     => 0,
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
                        'default'     => __( 'sq7HjrUOBfKmC576ILgskD5srU870gJ7', 'woocommerce' ),
                ),
    			'activar_log' => array(
                    'title'       => __( 'Guardar registros de comportamiento', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Si activa esta opción, se guardarán registros (logs) de los procesos que realice el módulo. <br> A la hora de notificar cualquier incidencia, los logs completos son de gran utilidad para poder detectar el problema.', 'woocommerce' ),
                    'default'     => '1',
                    'options'     => array(
                            '0' => __( 'No', 'woocommerce' ),
                            '1' => __( 'Sí, sólo informativos', 'woocommerce' ),
                            '2' => __( 'Sí, todos los registros', 'woocommerce' )
                    ),
                    'desc_tip'    => true,
                ), 
                'estado' => array(
                    'title'       => __( 'Estado del pedido al verificarse el pago para las autorizaciones', 'redsys_wc' ),
                    'type'        => 'select',
                    'description' => __( 'Aquí puede configurar el estado en el que se mostrará el pedido en el apartado "Pedidos" de su backoffice una vez el módulo reciba la notificación de que el pago ha sido correcto.', 'redsys_wc' ),
                    'default'     => 'processing',
                    'options'     => array(),
                    'desc_tip'    => true,
                ),
                'estado_preautorizacion' => array(
                    'title'       => __( 'Estado del pedido al verificarse el proceso de preautorización', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Aquí puede configurar el estado en el que se mostrará el pedido en el apartado "Pedidos" de su backoffice al realizar una preautorizacion.', 'woocommerce' ),
                    'default'     => 'on-hold',
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
                'tipopago' => array(
                    'title'       => __( 'Tipo de transacción', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Esta opción permite enviar información adicional del cliente que está realizando la compra, proporcionando más seguirdad a la hora de autenticar la operación<br>ATENCIÓN: Si selecciona "preautorización", deberá realizar las confirmaciones desde el Portal de Administración del TPV Virtual.', 'woocommerce' ),
                    'default'     => '0',
                    'options'     => array(
                            '0' => __( 'Autorización', 'woocommerce' ),
                            '1' => __( 'Preautorización', 'woocommerce' ),
							'7' => __( 'Autenticación', 'woocommerce' )
                	),
				),
				'genPedido' => array(
                    'title'       => __( 'Método de generación del número de pedido', 'redsys_wc' ),
                    'type'        => 'select',
                    'description' => __( 'Esta opción no modifica la forma en la que se identifica la orden en su Backoffice, sino el número de pedido (adaptado para que siempre ocupe doce dígitos) que se envía a Redsys para identificar la operación.<br>Recuerde que en los detalles de cada orden puede ver el número de pedido que identifica la operación en el Portal de Administración del TPV Virtual.', 'redsys_wc' ),
                    'default'     => '0',
                    'options'     => array(
                        '0' => __( 'Híbrido (recomendado)', 'woocommerce' ),
                        '1' => __( 'Sólo ID del carrito', 'woocommerce' ),
                        '2' => __( 'Aleatorio', 'woocommerce' )
                    ),
                ),
    			'with3ds' => array(
    					'title'       => __( 'Pago seguro usando 3D Secure', 'woocommerce' ),
    					'type'        => 'select',
						'description' => __( 'Esta opción permite enviar información adicional del cliente que está realizando la compra, proporcionando más seguirdad a la hora de autenticar la operación. Se recomienda el envío de esta información en los datos de la operación.', 'woocommerce' ),
    					'default'     => '1',
    					'desc_tip'    => true,
    					'options'     => array(
    						'0' => __( 'No', 'woocommerce' ),
    						'1' => __( 'Si', 'woocommerce' )
    					)
    			),
    			'withref' => array(
    					'title'       => __( 'Habilitar pago por referencia', 'woocommerce' ),
    					'type'        => 'select',
    					'description' => __( 'Habilita el pago por referencia .', 'woocommerce' ),
    					'default'     => '0',
    					'desc_tip'    => true,
    					'options'     => array(
    						'0' => __( 'No', 'woocommerce' ),
    						'1' => __( 'Si', 'woocommerce' )
    					)
    			),
    			'button_text' => array(
    					'title'       => __( 'Texto del botón de pago', 'woocommerce' ),
    					'type'        => 'text',
    					'description' => __( 'Texto del botón de pago.', 'woocommerce' ),
    					'default'     => 'REALIZAR PAGO',
    					'desc_tip'    => true
    			),
    			'button_style' => array(
    					'title'       => __( 'Estilo del botón de pago', 'woocommerce' ),
    					'type'        => 'text',
    					'description' => __( 'Estilo del botón de pago.', 'woocommerce' ),
    					'default'     => 'background-color:orange;color:black;',
    					'desc_tip'    => true
    			),
    			'body_style' => array(
    					'title'       => __( 'Estilo del iframe', 'woocommerce' ),
    					'type'        => 'text',
    					'description' => __( 'Estilo del iframe.', 'woocommerce' ),
    					'default'     => 'color:black;',
    					'desc_tip'    => true
    			),
    			'form_style' => array(
    					'title'       => __( 'Estilo del formulario', 'woocommerce' ),
    					'type'        => 'text',
    					'description' => __( 'Estilo del formulario.', 'woocommerce' ),
    					'default'     => 'color:grey;',
    					'desc_tip'    => true
    			),
    			'form_text_style' => array(
    					'title'       => __( 'Estilo del texto de formulario', 'woocommerce' ),
    					'type'        => 'text',
    					'description' => __( 'Estilo del texto de formulario.', 'woocommerce' ),
    					'default'     => ';',
    					'desc_tip'    => true
    			)
    	);
    		
    	$tmp_estados=wc_get_order_statuses();
    	foreach($tmp_estados as $est_id=>$est_na){
			$this->form_fields['estado']['options'][substr($est_id,3)]=$est_na;
			$this->form_fields['estado_preautorizacion']['options'][substr($est_id,3)]=$est_na;
			$this->form_fields['estado_autenticacion']['options'][substr($est_id,3)]=$est_na;
    	}
    }

	public function process_refund($order_id, $amount = 0, $reason = '', $idLog = null){
		$idLog = generateIdLog($this->activar_log, $this->logString, $order_id);

		return WC_Redsys_Refund::refund($this, $order_id, $amount, $reason, $idLog);
    }
}