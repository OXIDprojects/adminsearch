<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'          => 'oxcom_adminsearch',
    'title'       => 'OXID Commumity Adminsuche',
    'description' => [
        'de' => '',
        'en' => ''
    ],
    'thumbnail'   => '',
    'version'     => '1.0.0',
    'author'      => 'OXID Community',
    'url'         => '',
    'email'       => '',
    'extend'      => [
        \OxidEsales\Eshop\Application\Controller\Admin\NavigationController::class => \OxidCommunity\AdminSearch\Controller\Admin\NavigationController::class,
    ],
    'controllers' => [],
    'templates'   => [],
    'blocks'      => [
        ['template' => 'navigation.tpl', 'block' => 'admin_navigation_menustructure', 'file' => '/views/blocks/admin_navigation_menustructure.tpl'],
    ],
    'settings'    => [],
];