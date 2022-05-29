<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\util;

class cnst
{
	const FOLDER = 'marttiphpbb/overallpageblocks';
	const ID = 'marttiphpbb_overallpageblocks';
	const PREFIX = self::ID . '_';
	const NAME_EN = self::PREFIX . 'en';
	const NAME_PRIORITY = self::PREFIX . 'priority';
	const CACHE_ID = '_' . self::ID;
	const L = 'MARTTIPHPBB_OVERALLPAGEBLOCKS';
	const L_ACP = 'ACP_' . self::L;
	const L_MCP = 'MCP_' . self::L;
	const TPL = '@' . self::ID . '/';
	const EXT_PATH = 'ext/' . self::FOLDER . '/';

	const ITEMS = [
		'overall_header_navbar_before',
		'overall_header_page_body_before',
		'overall_footer_page_body_after',
	];
}
