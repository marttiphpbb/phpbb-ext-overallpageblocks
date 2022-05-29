<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\migrations;

use marttiphpbb\overallpageblocks\util\cnst;

class mgr_1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return [
			'\phpbb\db\migration\data\v32x\v325',
		];
	}

	public function update_data()
	{
		return [
			['config_text.add', [cnst::ID, serialize([])]],
		];
	}
}
