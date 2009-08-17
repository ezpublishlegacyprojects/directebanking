<?php

$ini = eZINI::instance( "directebankingpaycode.ini" );
$http = eZHTTPTool::instance();




$data = array(
    'transaction' => $http->variable( 'transaction' ),
    'user_id' => $http->variable( 'user_id' ),
    'project_id' => $http->variable( 'project_id' ),
    'sender_holder' => $http->variable( 'sender_holder' ),
    'sender_account_number' => $http->variable( 'sender_account_number' ),
    'sender_bank_code' => $http->variable( 'sender_bank_code' ),
    'sender_bank_name' => $http->variable( 'sender_bank_name' ),
    'sender_bank_bic' => $http->variable( 'sender_bank_bic' ),
    'sender_iban' => $http->variable( 'sender_iban' ),
    'sender_country_id' => $http->variable( 'sender_country_id' ),
    'recipient_holder' => $http->variable( 'recipient_holder' ),
    'recipient_account_number' => $http->variable( 'recipient_account_number' ),
    'recipient_bank_code' => $http->variable( 'recipient_bank_code' ),
    'recipient_bank_name' => $http->variable( 'recipient_bank_name' ),
    'recipient_bank_bic' => $http->variable( 'recipient_bank_bic' ),
    'recipient_iban' => $http->variable( 'recipient_iban' ),
    'recipient_country_id' => $http->variable( 'recipient_country_id' ),
    'international_transaction' => $http->variable( 'international_transaction' ),
    'amount' => $http->variable( 'amount' ),
    'currency_id' => $http->variable( 'currency_id' ),
    'reason_1' => $http->variable( 'reason_1' ),
    'reason_2' => $http->variable( 'reason_2' ),
    'security_criteria' => $http->variable( 'security_criteria' ),
    'user_variable_0' => $http->variable( 'user_variable_0' ),
    'user_variable_1' => $http->variable( 'user_variable_1' ),
    'user_variable_2' => $http->variable( 'user_variable_2' ),
    'user_variable_3' => $http->variable( 'user_variable_3' ),
    'user_variable_4' => $http->variable( 'user_variable_4' ),
    'user_variable_5' => $http->variable( 'user_variable_5' ),
    'created' => $http->variable( 'created' ),
    'project_password' => $ini->variable( 'PaycodeSettings', 'ProjectPWD')
);

$data_serial = implode( '|', $data );

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

if( $http->variable( 'hash' ) == $hash )
{
    if( $ini->variable( 'WebShopSettings', 'SetConfirmedStatus' ) == 'enabled' )
    {
        $confirmedStatus = $ini->variable( 'WebShopSettings','ConfirmStatusID' );
        $order = eZOrder::fetch($http->variable( 'user_variable_1' ));
        $order->modifyStatus($confirmedStatus, 14);
    }
}
else
{
    echo "failed";
}

eZExecution::cleanExit();

?>
