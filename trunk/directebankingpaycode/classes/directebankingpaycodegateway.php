<?php

class directebankingpaycodeGateway extends eZPaymentGateway
{
    const EZ_PAYMENT_GATEWAY_TYPE_PAYCODE = "directebankingpaycode";
    
    function __construct()
    {
        $this->logger   = eZPaymentLogger::CreateForAdd( "var/log/DIRECTebankingPaycode.log" );
        $this->logger->writeTimedString( 'directebankingpaycodeGateway::__construct()' );
    }
    
    function execute( $process, $event )
    {
        $parameters = $process->attribute( 'parameter_list' );
        $orderID = $parameters['order_id'];
        $order = eZOrder::fetch( $orderID );
        $ini = eZINI::instance( 'directebankingpaycode.ini' );
        $data = array('user_id' => $ini->variable( 'PaycodeSettings', 'UserID' ),
                      'project_id' => $ini->variable( 'PaycodeSettings', 'ProjectID' ),
                      'amount' => $order->attribute('total_inc_vat'),
                      'currency_id' => $order->currencyCode(),
                      'reason_1' => ezi18n( 'extension/directebankingpaycode/common', 'OrderID' ) . " " . $order->ID,
                      'reason_2' => '',
                      'sender_holder' => '',
                      'sender_account_number' => '',
                      'sender_bank_code' => '',
                      'sender_country_id' => '',
                      'user_variable_0' => '',
                      'user_variable_1' => $orderID,
                      'user_variable_2' => '',
                      'user_variable_3' => '',
                      'user_variable_4' => '',
                      'user_variable_5' => '',
                      'expires' => $ini->variable( 'PaycodeSettings', 'Expires' ),
                      'max_usage' => 1,
                      'language_id' => '',
                      'project_password' => $ini->variable( 'PaycodeSettings', 'ProjectPWD' )
                    );
        $data_serial = implode( '|', $data );
        unset( $data['project_password'] );
        $this->logger->writeTimedString( 'processing the order: ' . $orderID );
        switch( strtolower($ini->variable( 'PaycodeSettings', 'InputCheckType' )) )
        {
            case 'sha1':
            case 'sha256':
            case 'md5':
            {
                $hash = hash(strtolower($ini->variable( 'PaycodeSettings', 'InputCheckType' )), $data_serial );
            }break;
            default:
            {
                $hash = hash('md5', $data_serial );
            }break;
        }
        $data['hash'] = $hash;
    
        $url = $ini->variable( 'PaycodeSettings', 'PaycodeURL' ).'?';
        $url .= http_build_query( $data, null, '&' );
        $paycode = file_get_contents($url);
        
        $this->logger->writeTimedString( 'generated paycode: ' . $paycode );
        
        $orderItem = new eZOrderItem( array( 'order_id' => $orderID,
                                             'description' => ezi18n( 'extension/directebankingpaycode/common', 'DIRECTebanking.com - paycode' ) . ":$paycode",
                                             'price' => 0.0,
                                             'vat_value' => 0,
                                             'is_vat_inc' => 0,
                                             'type' => 'directebankingpaycode' ) );
        $orderItem->store();
        
        $process->Template = array();
        $process->Template['templateName'] = 'design:directebankingpaycode/paycode.tpl';
        $process->Template['templateVars'] = array ( 'paycode' => $paycode, 'order' => $order );
        
		    return eZWorkflowType::STATUS_FETCH_TEMPLATE;
    }

}

eZPaymentGatewayType::registerGateway( directebankingpaycodeGateway::EZ_PAYMENT_GATEWAY_TYPE_PAYCODE, "directebankingpaycodeGateway", ezi18n( 'extension/directebankingpaycode/common', 'DIRECTebanking.com - paycode' ) );

?>
