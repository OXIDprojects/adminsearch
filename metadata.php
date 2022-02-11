<?php
/**
 * @package   oxcom_adminsearch
 * @category  OXID Module
 * @license   MIT License http://opensource.org/licenses/MIT
 * @link      https://github.com/OXIDprojects/adminsearch
 * @version   1.0.3
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'          => 'oxcom_adminsearch',
    'title'       => 'OXID Community Adminsuche',
    'description' => [
        'de' => 'Globale Suche im Shop-Admin',
        'en' => 'Global search shop admin'
    ],
    'version'     => '1.2.1',
    'author'      => 'OXID Community',
    'url'         => 'https://github.com/OXIDprojects/adminsearch',
    'extend'      => [
        \OxidEsales\Eshop\Application\Controller\Admin\NavigationController::class => \OxidCommunity\AdminSearch\Controller\Admin\NavigationController::class,
    ],
    'controllers' => [],
    'templates'   => [],
    'blocks'      => [
        ['template' => 'navigation.tpl', 'block' => 'admin_navigation_menustructure', 'file' => '/views/blocks/admin_navigation_menustructure.tpl'],
    ],
    'settings'    => [
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowArticles', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowCategories', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowCmsPages', 'type' => 'bool', 'value' => true],
        //['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowOrders', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowUsers', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowCompanies', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowVendors', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowManufacturers', 'type' => 'bool', 'value' => true],
        ['group' => 'oxcom_adminsearch_main', 'name' => 'blOxComAdminSearchShowModules', 'type' => 'bool', 'value' => true],
    ],
];