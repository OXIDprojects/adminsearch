<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript"
        src="[{ $oViewConf->getModuleUrl('oxcom_adminsearch','out/src/js/jquery.easy-autocomplete.min.js') }]"></script>
<link rel="stylesheet" href="[{ $oViewConf->getModuleUrl('oxcom_adminsearch','out/src/css/easy-autocomplete.css') }]">

<input id="searchform">

<script type="text/javascript">
    var options = {
        url: function (query) {
            return "[{ $oViewConf->getSelfLink()|replace:'&amp;':'&' }]cl=navigation&fnc=getOxcomAdminSearchResults&name=" + query;
        },
        placeholder: "Artikel, Bestellung, CMS, ...",
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
                type: "fade", //normal|slide|fade
                time: 400,
                callback: function () {}
            },
            hideAnimation: {
                type: "slide", //normal|slide|fade
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
            {
                listLocation: "articles",
                header: "ARTIKEL"
            },
            {
                listLocation: "categories",
                header: "KATEGORIEN"
            },
            {
                listLocation: "cmspages",
                header: "CMS SEITEN"
            },
            {
                listLocation: "users",
                header: "BENUTZER"
            },
            {
                listLocation: "orders",
                header: "BESTELLUNGEN"
            }
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
