<?php

include_once('kernel/common/template.php');

$Module = $Params['Module'];

$tpl = templateInit();
$ini = eZINI::instance( "directebanking.ini" );
$http = eZHTTPTool::instance();

if( $http->hasVariable( 'GetXML' ) )
{
    $serverurl = "https://www.sofortueberweisung.de/payment/xml?";
    $serverurl .= "user_id=" . $ini->variable( "EbankingSettings", "UserID" );
    $serverurl .= "&project_id=" . $ini->variable( "EbankingSettings", "ProjectID" );
    $serverurl .= "&password=" . $http->variable( 'UserPassword' );
    $serverurl .= "&t_start=" . $http->variable( 'TSFrom' );
    $serverurl .= "&t_end=" . $http->variable( 'TSTo' );
    
    $content = file_get_contents($serverurl);
    $xml_result = array( 'transactions' => array(), 'footer' => array(), 'errors' => array() );
    $is_xml = stripos( $content, 'transactions');
    
    if( $is_xml )
    {
        $xml = new SimpleXMLElement($content );
        foreach($xml->transaction as $transaction)
        {
            $xml_result['transactions'][] = array(
                                    'transaction_id'        => trim($transaction->transaction_id),
                                    'sender_holder'         => trim($transaction->sender_holder),
                                    'sender_account_number' => trim($transaction->sender_account_number),
                                    'sender_bank_code'      => trim($transaction->sender_bank_code),
                                    'sender_bank_name'      => trim($transaction->sender_bank_name),
                                    'amount'                => trim($transaction->amount),
                                    'amount_integer'        => trim($transaction->amount_integer),
                                    'reason_1'              => trim($transaction->reason_1),
                                    'reason_2'              => trim($transaction->reason_2),
                                    'date'                  => trim($transaction->date),
                                    'time'                  => trim($transaction->time),
                                    'timestamp'             => trim($transaction->timestamp),
                                    'currency_id'           => trim($transaction->currency_id),
                                    'user_variable_1'       => trim($transaction->user_variable_1)
                                   );
        }
        $xml_result['footer'] = array(  
                                    'user_id'               => trim($xml->footer[0]->user_id),
                                    'project_id'            => trim($xml->footer[0]->project_id),
                                    'begin_datetime'        => trim($xml->footer[0]->begin_datetime),
                                    'end_datetime'          => trim($xml->footer[0]->end_datetime),
                                    'transaction_quantity'  => trim($xml->footer[0]->transaction_quantity)
                                  );
    }
    else
    {
        $xml_result['errors'] = $content;
    }
    $tpl->setVariable('xml',$xml_result);
    $tpl->setVariable('TSFrom',$http->variable( 'TSFrom' ));
    $tpl->setVariable('TSTo',$http->variable( 'TSTo' ));
}
$Result = array();
$Result['pagelayout'] = true;
$Result['content'] = $tpl->fetch( 'design:directebanking/xml.tpl' );
$Result['path'] = array( array( 'url' => '/directebanking/xml',
                                'text' => ezi18n( 'extension/directebanking/common', 'DIRECTebanking.com' )
                         )
                  );
$Result['left_menu'] = 'design:directebanking/left_menu.tpl';
?>
