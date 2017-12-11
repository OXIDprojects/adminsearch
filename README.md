Great module proudly presented by [OXID Hackathon 2017](https://openspacer.org/12-oxid-community/185-oxid-hackathon-nuernberg-2017/) ;-)

Module version for OXID eShop 4 and 5. See here for [V6](https://github.com/OXIDprojects/adminsearch).

# Features

	Global admin search for
	- articles
	- categories
	- cms pages
	- users
	- orders
	- vendors
	- manufacturers
	- modules

# Installation

1. copy copy_this/* to shop root
2. activate module in shop admin
3. search in views/admin/tpl/navigation.tpl for
```
[{include file="navigation_shopselect.tpl"}]
```
and add before
```
[{block name="admin_navigation_menustructure"}][{/block}]
```
and clear tmp folder


# Screenshot

![OXID Adminsuche](screenshot.png)


# Changelog

	2017-12-11	1.0.3	typo module title, fix module search
	2017-12-10	1.0.2	fix search class using module settings 
	2017-12-09	1.0.1	add translation, fix article search oxartnum
	2017-12-09	1.0.0	module release
