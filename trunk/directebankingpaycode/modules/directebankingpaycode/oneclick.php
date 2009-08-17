<?php

include_once('kernel/common/template.php');

$Module = $Params['Module'];
$view = $Params['view'];

$tpl = templateInit();
$ini = eZINI::instance( "directebankingpaycode.ini" );
$http = eZHTTPTool::instance();
$user = eZUser::instance();

switch($view) 
{
    case 'register':
    {
        foreach( $ini->BlockValues as $name => $setting )
        {
            foreach( $setting as $set_name => $set_value )
            {
                $ini->setVariable( $name, $set_name, $set_value );
            }
        }
        $password = $http->sessionVariable( "DIRECTebankingPaycodePPWD" );
        $ini->setVariable( "PaycodeSettings", "UserID", $http->variable( 'user_id' ) );
        $ini->setVariable( "PaycodeSettings", "ProjectID", $http->variable( 'project_id' ) );
        $ini->setVariable( "PaycodeSettings", "ProjectPWD", $password );
        $ini->save( false, false, "append" );
        $http->removeSessionVariable( "DIRECTebankingPaycodePPWD" );
    }
    break;
    default:
    {
        $password = eZUser::createPassword( 10 );
        $http->setSessionVariable( 'DIRECTebankingPaycodePPWD', $password );
    }
    break;
}

$tpl->setVariable('view',$view);
$tpl->setVariable('user',$user);
$tpl->setVariable('password',$password);

$template = 'oneclickview.tpl';
$Result = array();
$Result['pagelayout'] = true;
$Result['content'] = $tpl->fetch( 'design:directebankingpaycode/'.$template );
$Result['path'] = array( array( 'url' => '/directebankingpaycode/profile/'.$view,
                                'text' => ezi18n( 'extension/directebankingpaycode/common', 'DIRECTebanking.com - paycode' )
                         )
                  );
$Result['left_menu'] = 'design:directebankingpaycode/left_menu.tpl';

?>
