<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="[{ $oViewConf->getModuleUrl('oxcom_adminsearch','out/src/js/jquery.easy-autocomplete.min.js') }]"></script>
<link rel="stylesheet" href="[{ $oViewConf->getModuleUrl('oxcom_adminsearch','out/src/css/easy-autocomplete.css') }]">

<input id="searchform">

<script type="text/javascript">
    var options = {
        url: function (query) {
            return "[{ $oViewConf->getSelfLink()|replace:'&amp;':'&' }]cl=navigation&fnc=getOxcomAdminSearchResults&name=" + query;
        },
        placeholder: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_TITLE" }]",
        getValue: "name",
        list: {
            onClickEvent: function () {
                var oxid = $("#searchform").getSelectedItemData().oxid;
                var type = $("#searchform").getSelectedItemData().type;
                var oTransfer = document.getElementById("transfer");
                oTransfer.oxid.value = oxid;
                oTransfer.cl.value = type;
                oTransfer.submit();
            },
            showAnimation: {
                type: "fade",
                time: 400,
                callback: function () {}
            },
            hideAnimation: {
                type: "slide",
                time: 400,
                callback: function () {}
            },
            match: {
                enabled: true
            }, axNumberOfElements: 10,
            sort: {
                enabled: true
            }
        },
        categories: [
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowArticles") }]
                {
                    listLocation: "articles",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_ARTICLES" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowCategories") }]
                ,{
                    listLocation: "categories",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_CATEGORIES" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowCmsPages") }]
                ,{
                    listLocation: "cmspages",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_CMSPAGES" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowOrders") }]
                ,{
                    listLocation: "orders",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_ORDERS" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowUsers") }]
            ,{
                listLocation: "users",
                header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_USERS" }]"
            }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowVendors") }]
                ,{
                    listLocation: "vendors",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_VENDORS" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowManufacturers") }]
                ,{
                    listLocation: "manufacturers",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_MANUFACTURERS" }]"
                }
            [{ /if }]
            [{ if $oView->getOxcomAdminSearchConfigParam("blOxComAdminSearchShowModules") }]
                ,{
                    listLocation: "modules",
                    header: "[{ oxmultilang ident="OXCOM_ADMINSEARCH_MODULES" }]"
                }
            [{ /if }]
        ]
    };

    $("#searchform").easyAutocomplete(options);
</script>

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post" target="basefrm">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="-1">
    <input type="hidden" name="cl" value="">
    <input type="hidden" name="updatelist" value="1">
</form>

[{$smarty.block.parent}]
