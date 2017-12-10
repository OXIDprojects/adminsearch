<?php
/**
 * @package   oxcom_adminsearch
 * @category  OXID Module
 * @license   MIT License http://opensource.org/licenses/MIT
 * @link      https://github.com/OXIDprojects/adminsearch
 * @version   1.0.2
 */

namespace OxidCommunity\AdminSearch\Controller\Admin;

use OxidEsales\Eshop\Core\Registry;

/**
 * Class NavigationController
 *
 * @package OxidCommunity\AdminSearch\Controller\Admin
 */
class NavigationController extends NavigationController_parent
{

    /**
     * @var null|object
     */
    protected $_sViewNameGenerator = null;

    /**
     * @var string
     */
    protected $_sQueryName = '';

    /**
     * NavigationController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_sViewNameGenerator = Registry::get(\OxidEsales\Eshop\Core\TableViewNameGenerator::class);
        $this->_sQueryName = Registry::getConfig()->getRequestParameter("name");
    }

    /**
     * Gets search results for template
     */
    public function getOxcomAdminSearchResults()
    {
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowArticles")) {
            $aData["articles"] = $this->_getOxcomAdminSearchArticles();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowCategories")) {
            $aData["categories"] = $this->_getOxcomAdminSearchCategories();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowCmsPages")) {
            $aData["cmspages"] = $this->_getOxcomAdminSearchCmsPages();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowOrders")) {
            $aData["orders"] = $this->_getOxcomAdminSearchOrders();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowUsers")) {
            $aData["users"] = $this->_getOxcomAdminSearchUsers();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowVendors")) {
            $aData["vendors"] = $this->_getOxcomAdminSearchVendors();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowManufacturers")) {
            $aData["manufacturers"] = $this->_getOxcomAdminSearchManufacturers();
        }
        if ($this->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowModules")) {
            $aData["modules"] = $this->_getOxcomAdminSearchModules();
        }
        echo json_encode($aData);
        exit;
    }

    /**
     * Gets module config param for template
     *
     * @param string $sParam
     *
     * @return object
     */
    public function getOxcomAdminSearchConfigParam($sParam = '')
    {
        return Registry::getConfig()->getShopConfVar($sParam, Registry::getConfig()->getShopId(), 'module:oxcom_adminsearch');
    }

    /**
     * Gets search articles data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchArticles()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxarticles");
        $sSql = "SELECT oxid, CONCAT(oxtitle, '', oxvarselect, ' (', oxartnum, ')') FROM $sViewName WHERE CONCAT(oxtitle, '', oxvarselect, oxartnum) LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'article');
    }

    /**
     * Gets search categories data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchCategories()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxcategories");
        $sSql = "SELECT oxid, oxtitle FROM $sViewName WHERE oxtitle LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'category');
    }

    /**
     * Gets search cms pages data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchCmsPages()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxcontents");
        $sSql = "SELECT oxid, oxtitle FROM $sViewName WHERE oxtitle LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'admin_content');
    }

    /**
     * Gets search order data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchOrders()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxorder");
        $sSql = "SELECT oxid, CONCAT('#', oxordernr, ' ', oxbilllname, ', ', oxbillfname) FROM $sViewName WHERE CONCAT(oxbillfname, ' ', oxbilllname, ' ', oxordernr, ' ', oxbillemail) LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'admin_order');
    }

    /**
     * Gets search user data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchUsers()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxuser");
        $sSql = "SELECT oxid, CONCAT(oxlname, ', ', oxfname, ' (', oxcustnr, ')') FROM $sViewName WHERE CONCAT(oxlname, ' ', oxfname, ' ', oxcustnr, ' ', oxusername) LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'admin_user');
    }

    /**
     * Gets search vendors data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchVendors()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxvendor");
        $sSql = "SELECT oxid, oxtitle FROM $sViewName WHERE oxtitle LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'vendor');
    }

    /**
     * Gets search manufacturers data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchManufacturers()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxmanufacturers");
        $sSql = "SELECT oxid, oxtitle FROM $sViewName WHERE oxtitle LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

        return $this->_getOxcomAdminSearchData($sSql, 'manufacturer');
    }

    /**
     * Gets search modules data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchModules()
    {
        $aData = [];
        $oModules = oxNew(\OxidEsales\Eshop\Core\Module\ModuleList::class);
        $aModules = $oModules->getModulePaths();
        foreach ($aModules as $sKey => $sValue) {
            $oModule = oxNew(\OxidEsales\Eshop\Core\Module\Module::class);
            $oModule->load($sKey);
            $aData[] = ['name' => $oModule->getTitle() . ' (' . ($oModule->isActive() ? Registry::getLang()->translateString("OXCOM_ADMINSEARCH_MODULE_ACTIVE") : Registry::getLang()->translateString("OXCOM_ADMINSEARCH_MODULE_INACTIVE")) . ')', 'oxid' => $sKey, 'type' => 'module'];
        }

        return $aData;
    }

    /**
     * Gets search result as array
     *
     * @param string $sSql
     *
     * @return array
     */
    protected function _getOxcomAdminSearchData($sSql = '', $sType = '')
    {
        $aData = [];
        $oDbRes = \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->select($sSql);
        if ($oDbRes != false && $oDbRes->count() > 0) {
            while (!$oDbRes->EOF) {
                $aField = $oDbRes->getFields();
                $aData[] = ['name' => $aField[1], 'oxid' => $aField[0], 'type' => $sType];
                $oDbRes->fetchRow();
            }
        }

        return $aData;
    }

}
