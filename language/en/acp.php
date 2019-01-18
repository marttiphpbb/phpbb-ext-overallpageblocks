<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_SETTINGS_SAVED'
	=> 'The settings have been saved successfully!',

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_ITEMS'
	=> 'Menu items',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_ITEM_LOCATIONS'
	=> 'Menu item locations',

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_NAVIGATION_PREPEND'
	=> 'Overall header navigation prepend',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_NAVIGATION_APPEND'
	=> 'Overall header navigation append',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_NAVBAR_HEADER_QUICK_LINKS_BEFORE'
	=> 'Navbar header quick links before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_NAVBAR_HEADER_QUICK_LINKS_AFTER'
	=> 'Navbar header quick links after',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_BREADCRUMBS_BEFORE'
	=> 'Overall header breadcrumbs before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_BREADCRUMBS_AFTER'
	=> 'Overall header breadcrumbs after',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_FOOTER_TIMEZONE_BEFORE'
	=> 'Overall footer timezone before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_FOOTER_TIMEZONE_AFTER'
	=> 'Overall footer timezone after',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_FOOTER_TEAMLINK_BEFORE'
	=> 'Overall footer teamlink before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_FOOTER_TEAMLINK_AFTER'
	=> 'Overall footer teamlink after',
]);
