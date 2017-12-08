<?php

namespace OxidCommunity\AdminSearch\Controller\Admin;

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
        $this->_sViewNameGenerator = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\TableViewNameGenerator::class);
        $this->_sQueryName = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter("name");
    }

    /**
     * Gets search results for frontend
     */
    public function getOxcomAdminSearchResults()
    {
        $test["articles"] = $this->_getOxcomAdminSearchArticles();
        $test["categories"] = $this->_getOxcomAdminSearchCategories();
        $test["cmspages"] = $this->_getOxcomAdminSearchCmsPages();
        $test["orders"] = $this->_getOxcomAdminSearchOrders();
        $test["users"] = $this->_getOxcomAdminSearchUsers();
        echo json_encode($test);
        exit;
    }

    /**
     * Gets search articles data
     *
     * @return array
     */
    protected function _getOxcomAdminSearchArticles()
    {
        $sViewName = $this->_sViewNameGenerator->getViewName("oxarticles");
        $sSql = "SELECT oxid, CONCAT(oxtitle, '', oxvarselect) FROM $sViewName WHERE CONCAT(oxtitle, '', oxvarselect) LIKE " . \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->quote('%' . $this->_sQueryName . '%');

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
