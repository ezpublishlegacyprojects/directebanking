<?php

$Module = array( 'name' => 'DIRECTebanking.com Module',
                 'variable_params' => true );

$ViewList = array();

$ViewList['notificate'] = array( 'functions' => array( 'notificate' ),
                                 'script' => 'notificate.php');

$ViewList['profile'] = array( 'functions' => array( 'administrate' ),
                              'script' => 'profile.php',
                              'params' => array( 'view' ),
                              'default_navigation_part'  => 'directebankingpart');
                              
$ViewList['oneclickinstallation'] = array('functions' => array( 'administrate' ),
                                          'script' => 'oneclick.php',
                                          'params' => array( 'view' ),
                                          'default_navigation_part'  => 'directebankingpart');
                              
$ViewList['xml'] = array('functions' => array( 'administrate' ),
                                          'script' => 'xml.php',
                                          'default_navigation_part'  => 'directebankingpart');

$FunctionList['notificate'] = array();
$FunctionList['administrate'] = array();



?>
