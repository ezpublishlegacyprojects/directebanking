<?php

include_once('kernel/common/template.php');
$tpl = templateInit();
$Result = array();
$Result['pagelayout'] = true;
$Result['content'] = $tpl->fetch( 'design:directebankingpaycode/failed.tpl' );
$Result['path'] = array( array( 'url' => '/directebankingpaycode/failed',
                                'text' => ezi18n( 'extension/directebankingpaycode/common', 'DIRECTebanking.com - paycode' )
                         )
                  );
?>
