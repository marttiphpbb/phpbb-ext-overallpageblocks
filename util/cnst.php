<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\util;

class cnst
{
	const FOLDER = 'marttiphpbb/overallpageblocks';
	const ID = 'marttiphpbb_overallpageblocks';
	const PREFIX = self::ID . '_';
	const CACHE_ID = '_' . self::ID;
	const L = 'MARTTIPHPBB_OVERALLPAGEBLOCKS';
	const L_ACP = 'ACP_' . self::L;
	const L_MCP = 'MCP_' . self::L;
	const TPL = '@' . self::ID . '/';
	const EXT_PATH = 'ext/' . self::FOLDER . '/';

	const ITEMS = [
		'overall_header_navigation_prepend',
		'overall_header_navigation_append',
		'navbar_header_quick_links_before',
		'navbar_header_quick_links_after',
		'overall_header_breadcrumbs_before',
		'overall_header_breadcrumbs_after',
		'overall_footer_timezone_before',
		'overall_footer_timezone_after',
		'overall_footer_teamlink_before',
		'overall_footer_teamlink_after',
	];
}
