<?php

ext_activate( 'directebanking', 'classes/directebankingchecker.php' );

$checker = new directeBankingChecker( 'directebanking.ini' );

if( $checker->createDataFromPOST() )
{
  if( $checker->hashValidation() )
  {
      $orderID = $checker->getFieldValue( 'user_variable_1' );
      if( $checker->setupOrderAndPaymentObject( $orderID ) )
      {
          $amount   = $checker->getFieldValue( 'amount' );
          $currency = $checker->getFieldValue( 'currency_id' );
          if( $checker->checkAmount( $amount ) && $checker->checkCurrency( $currency ) )
          {
              if( $checker->ini->variable( 'OrderItemSettings', 'AddOrderItem' ) == 'true' )
              {
                  $orderItem = new eZOrderItem( array( 'order_id' => $orderID,
                                                       'description' => ezi18n( 'extension/directebanking/common', 'DIRECTebanking.com' ),
                                                       'price' => $checker->ini->variable( 'OrderItemSettings', 'EbankingCosts' ),
                                                       'vat_value' => $checker->ini->variable( 'OrderItemSettings', 'VAT' ),
                                                       'is_vat_inc' => ($checker->ini->variable( 'OrderItemSettings', 'IsVATIncluded' )=='true')?1:0,
                                                       'type' => 'paymentgatewayhandler' ) );
                  $orderItem->store();
              }
              if( $checker->ini->variable( 'WebShopSettings', 'SetConfirmedStatus' ) == 'enabled' )
              {
                  $confirmedStatus = $checker->ini->variable( 'WebShopSettings','ConfirmStatusID' );
          		    $order = eZOrder::fetch($orderID);
          		    $order->modifyStatus($confirmedStatus, 14);
              }
              $checker->approvePayment();
          }
      }
  }
}

eZExecution::cleanExit();

?>
