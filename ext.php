<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks;

class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.2.5', '>=')
			&& version_compare(PHP_VERSION, '7.1', '>=');
	}
}
