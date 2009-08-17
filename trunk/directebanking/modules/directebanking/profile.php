<?php

include_once('kernel/common/template.php');

$Module = $Params['Module'];
$view = $Params['view'];

$tpl = templateInit();
$ini = eZINI::instance( "directebanking.ini" );
$http = eZHTTPTool::instance();

switch($view) 
{
    case 'edit':
    {
        if( $http->hasPostVariable( 'BlockName' ) && $http->hasPostVariable( 'VariableName' ) )
        {
            $setting = $ini->variable( $http->postVariable( 'BlockName' ), $http->postVariable( 'VariableName' ) );
            $tpl->setVariable('block_name',$http->postVariable( 'BlockName' ));
            $tpl->setVariable('variable_name',$http->postVariable( 'VariableName' ));
            $tpl->setVariable('variable_value',$setting);
            $template = 'edit.tpl';
        }
        else
        {
            return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
        }
    }
    break;
    case 'update':
    {
        if( $http->hasPostVariable( 'BlockName' ) && $http->hasPostVariable( 'VariableName' ) && $http->hasPostVariable( 'VariableValue' ) )
        {
            $ini->setVariable( $http->postVariable( 'BlockName' ), $http->postVariable( 'VariableName' ), $http->postVariable( 'VariableValue' ) );
            $ini->save( false, false, "append" );
            $Module->redirectTo( '/directebanking/profile/view' );
        }
        else
        {
            return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
        }
    }
    break;
    case 'create':
    {
    }
    break;
    default:
    {
        $settings = $ini->load();
        $tpl->setVariable('settings',$ini->BlockValues);
        $template = 'view.tpl';
    }
    break;
}

$Result = array();
$Result['pagelayout'] = true;
$Result['content'] = $tpl->fetch( 'design:directebanking/'.$template );
$Result['path'] = array( array( 'url' => '/directebanking/profile/'.$view,
                                'text' => ezi18n( 'extension/directebanking/common', 'DIRECTebanking.com' )
                         )
                  );
$Result['left_menu'] = 'design:directebanking/left_menu.tpl';

?>
