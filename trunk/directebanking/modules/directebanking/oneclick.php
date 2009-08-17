<?php

include_once('kernel/common/template.php');

$Module = $Params['Module'];
$view = $Params['view'];

$tpl = templateInit();
$ini = eZINI::instance( "directebanking.ini" );
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
        $password = $http->sessionVariable( "DIRECTebankingPPWD" );
        $ini->setVariable( "EbankingSettings", "UserID", $http->variable( 'user_id' ) );
        $ini->setVariable( "EbankingSettings", "ProjectID", $http->variable( 'project_id' ) );
        $ini->setVariable( "EbankingSettings", "ProjectPWD", $password );
        $ini->save( false, false, "append" );
        $http->removeSessionVariable( "DIRECTebankingPPWD" );
    }
    break;
    default:
    {
        $password = eZUser::createPassword( 10 );
        $http->setSessionVariable( 'DIRECTebankingPPWD', $password );
    }
    break;
}

$tpl->setVariable('view',$view);
$tpl->setVariable('user',$user);
$tpl->setVariable('password',$password);
$template = 'oneclickview.tpl';
$Result = array();
$Result['pagelayout'] = true;
$Result['content'] = $tpl->fetch( 'design:directebanking/'.$template );
$Result['path'] = array( array( 'url' => '/directebanking/profile/'.$view,
                                'text' => ezi18n( 'extension/directebanking/common', 'DIRECTebanking.com' )
                         )
                  );
$Result['left_menu'] = 'design:directebanking/left_menu.tpl';

?>
