<?php

include_once ('wc-redsys-insite.php');

class WC_Redsys_Refund {

	public static function refund($gateway, $orderId, $amount, $reason){
		$currency_decimals = get_option('woocommerce_price_num_decimals');
        $amount = number_format( (float) ($amount), intval($currency_decimals), '.', '' );
        $amount = str_replace('.','',$amount);
        $amount = floatval($amount);

		$request = new RestOperationMessage();
		$pedido = WC_Redsys_Refund::getOrderId($orderId);
    
		$request->setAmount( $amount );
		$request->setCurrency( $gateway->moneda );
		$request->setMerchant( $gateway->fuc );
		$request->setTerminal( $gateway->terminal );
		$request->setOrder( $pedido );
		$request->setTransactionType( RESTConstants::$REFUND );
		$request->addParameter( "DS_MERCHANT_PRODUCTDESCRIPTION", $reason );

        escribirLog("DEBUG", $idLog, "Se va a realizar una DEVOLUCION para el pedido " . $pedido . " con los siguientes parámetros:");
        escribirLog("DEBUG", $idLog, "Total: " . $amount);
        escribirLog("DEBUG", $idLog, "Moneda: " . $gateway->moneda);
        escribirLog("DEBUG", $idLog, "Comercio: " . $gateway->fuc);
        escribirLog("DEBUG", $idLog, "Terminal: " . $gateway->terminal);

    	$service = new RESTOperationService ( $gateway->clave256, $gateway->entorno );
    	$result = $service->sendOperation ( $request );

        if($result->getResult () == RESTConstants::$RESP_LITERAL_OK){
            escribirLog("DEBUG", $idLog, "La devolucion se ha procesado correctamente");
        }else{
            escribirLog("DEBUG", $idLog, "Ha habido un problema al procesar la devolucion, contacte con su entidad o revise el Portal de Administracion del TPV Virtual");
        }

		return $result->getResult () == RESTConstants::$RESP_LITERAL_OK;
    }

	public static function cancellation($gateway, $orderId, $amount, $isAuthorization){
		$request = new RestOperationMessage();

		//Anulacion de Pago (45) o Anulacion de Preautorizacion (9)
		$transactionType = $isAuthorization ? RESTConstants::$PAYMENT_CANCELLATION : RESTConstants::$CANCELLATION;
    
		$request->setAmount( $amount );
		$request->setCurrency( $gateway->moneda );
		$request->setMerchant( $gateway->fuc );
		$request->setTerminal( $gateway->terminal );
		$request->setOrder( $orderId );
		$request->setTransactionType( $transactionType );

        escribirLog("DEBUG", $idLog, "Se va a realizar una ANULACION para el pedido " . $orderId);
        escribirLog("DEBUG", $idLog, "Total: " . $amount);
        escribirLog("DEBUG", $idLog, "Moneda: " . $gateway->moneda);
        escribirLog("DEBUG", $idLog, "Comercio: " . $gateway->fuc);
        escribirLog("DEBUG", $idLog, "Terminal: " . $gateway->terminal);
		escribirLog("DEBUG", $idLog, "TransactionType: " . $transactionType);

    	$service = new RESTOperationService ( $gateway->clave256, $gateway->entorno );
    	$result = $service->sendOperation ( $request );

        if($result->getResult () == RESTConstants::$RESP_LITERAL_OK){
            escribirLog("DEBUG", $idLog, "La anulacion se ha procesado correctamente");
        }else{
            escribirLog("DEBUG", $idLog, "Ha habido un problema al procesar la anulacion, contacte con su entidad o revise el Portal de Administracion del TPV Virtual");
        }

		return $result->getResult () == RESTConstants::$RESP_LITERAL_OK;
    }

    public static function saveOrderId($idOrder, $redsysOrder){
		global $wpdb;
		$tableName=$wpdb->prefix."redsys_order";

        if($idOrder!=null && WC_Redsys_Refund::checkOrderTable()){
            $oldRedsysOrder=WC_Redsys_Refund::getOrderId($idOrder);
            
            if($oldRedsysOrder==null){
				$wpdb->insert(
					$tableName,
					array(
						'id_order' => $idOrder,
						'redsys_order' => substr($redsysOrder, 0, 20)
					)
				);
            }else{
				$wpdb->update(
					$tableName,
					array(
						'redsys_order' => substr($redsysOrder, 0, 20)
					),
					array( 
						'id_order' => $idOrder
					)
				);
            }
        }
    }

    public static function getOrderId($idOrder){
		if(WC_Redsys_Refund::checkOrderTable()){
			global $wpdb;
			$tableName=$wpdb->prefix."redsys_order";
			
			$order=$wpdb->get_results( "SELECT * FROM ".$tableName." WHERE id_order=".$idOrder.";", ARRAY_A  );
			if(sizeof($order)>0)
				return $order[0]["redsys_order"];
		}
		return null;
    }

	public static function checkOrderTable(){
		global $wpdb;
		$tableName=$wpdb->prefix."redsys_order";
		
		$tablas=$wpdb->get_results( "SHOW TABLES LIKE '".$tableName."'" );
		if(sizeof($tablas)<=0)
            WC_Redsys_Refund::createOrderTable();

			$tablas=$wpdb->get_results( "SHOW TABLES LIKE '".$tableName."'" );
			return sizeof($tablas)>0;
	}

	public static function createOrderTable(){
		global $wpdb;

		$tableName=$wpdb->prefix."redsys_order";
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS `".$tableName."` (
				`id_order` INT NOT NULL PRIMARY KEY,
				`redsys_order` VARCHAR(20) NOT NULL,
				INDEX (`id_order`)
			) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	public static function dropOrderTable(){
		global $wpdb;
		
		$tableName=$wpdb->prefix."redsys_order";
		
		$sql = "'DROP TABLE `".$tableName."`'";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}