<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
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

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_BLOCKS'
	=> 'Page Blocks',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_BLOCK_LOCATIONS'
	=> 'Page Block Locations',

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_ENABLE'
	=> 'Enable Page Block Location',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_PRIORITY'
	=> 'Priority',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_LOCATIONS'
	=> 'Page Block Locations',

	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_NAVBAR_BEFORE'
	=> 'Overall header navbar before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_HEADER_PAGE_BODY_BEFORE'
	=> 'Overall header page body before',
	'ACP_MARTTIPHPBB_OVERALLPAGEBLOCKS_OVERALL_FOOTER_PAGE_BODY_AFTER'
	=> 'Overall footer page body after',
]);
