<?php

$Module = array( 'name' => 'DIRECTebanking.com - paycode Module',
                 'variable_params' => true );

$ViewList = array();

$ViewList['notificate'] = array( 'functions' => array( 'notificate' ),
                                 'script' => 'notificate.php');
                                 
$ViewList['success'] = array( 'functions' => array( 'notificate' ),
                                 'script' => 'success.php');
                                 
$ViewList['failed'] = array( 'functions' => array( 'notificate' ),
                                 'script' => 'failed.php');
                                 
$ViewList['profile'] = array( 'functions' => array( 'administrate' ),
                              'script' => 'profile.php',
                              'params' => array( 'view' ),
                              'default_navigation_part'  => 'directebankingpaycode');
                              
$ViewList['oneclickinstallation'] = array('functions' => array( 'administrate' ),
                                          'script' => 'oneclick.php',
                                          'params' => array( 'view' ),
                                          'default_navigation_part'  => 'directebankingpaycode');
                              
$ViewList['xml'] = array('functions' => array( 'administrate' ),
                                          'script' => 'xml.php',
                                          'default_navigation_part'  => 'directebankingpaycode');

$FunctionList['notificate'] = array();
$FunctionList['administrate'] = array();



?>
