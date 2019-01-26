<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\service;

use marttiphpbb\overallpageblocks\service\store;
use phpbb\request\request;
use phpbb\language\language;
use marttiphpbb\overallpageblocks\util\cnst;

class acp
{
	protected $store;
	protected $request;
	protected $language;
	protected $selected = [];

	public function __construct(
		store $store,
		request $request,
		language $language
	)
	{
		$this->store = $store;
		$this->request = $request;
		$this->language = $language;
	}

	public function process_form(
		string $extension_name,
		string $key
	):void
	{
		if (!$this->request->is_set_post('submit'))
		{
			return;
		}

		$enabled_ary = $this->request->variable(cnst::NAME_EN, ['' => ['' => '']]);
		$priority_ary = $this->request->variable(cnst::NAME_PRIORITY, ['' => ['' => 0]]);

		if (!isset($enabled_ary[$key]))
		{
			$this->store->remove_key($extension_name, $key);
			return;
		}

		$tpl_ary = [];

		foreach ($enabled_ary[$key] as $tpl_event => $on)
		{
			$tpl_ary[$tpl_event] = $priority_ary[$key][$tpl_event] ?? 0;
		}

		$this->store->set($extension_name, $key, $tpl_ary);
	}

	public function assign_to_template(string $extension_name):void
	{
		$this->selected = $this->store->get_all()[$extension_name] ?? [];
		$this->language->add_lang('acp', cnst::FOLDER);
	}

	public function get_selected():array
	{
		return $this->selected;
	}
}
