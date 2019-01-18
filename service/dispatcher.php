<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\service;

use phpbb\event\dispatcher as core_dispatcher;
use marttiphpbb\overallpageblocks\service\store;

class dispatcher
{
	protected $core_dispatcher;
	protected $store;
	protected $items = [];

	public function __construct(core_dispatcher $core_dispatcher, store $store)
	{
		$this->core_dispatcher = $core_dispatcher;
		$this->store = $store;
	}

	public function trigger_event()
	{
		$items = [];

		/**
		 * To set menu items
		 *
		 * @event
		 * @var array	items  push here your items
		 * like this $items['vendor/extension']['menu_key'] = $item;
		 * where item is
		 * 1.) $item = [
		 * 		'link'		=> '/path/to/your/page',
		 * 		'include'	=> '@vendor_extension/your_include_file.html',
		 * 		'var'		=> [],
		 * ];
		 * "var" is an array or string passed as "var" to
		 * your include file. Also "key" is available in your included file.
		 *
		 * 2.) $item = [
		 * 		'link'		=> '/path/to/your/page',
		 * 		'raw'		=> $raw,
		 * ];
		 * "raw"  is the raw content of your menu link.
		 */
		$vars = ['items'];
		$result = $this->core_dispatcher->trigger_event('marttiphpbb.overallpageblocks.add_items', compact($vars));

		if (count($result['items']))
		{
			foreach ($result['items'] as $ext_name => $menu_ary)
			{
				if (!$this->store->ext_is_present($ext_name))
				{
					continue;
				}

				foreach ($menu_ary as $key => $data)
				{
					$template_events = $this->store->get($ext_name, $key);

					if (!count($template_events))
					{
						continue;
					}

					$data['key'] = $key;

					foreach ($template_events as $template_event)
					{
						if (isset($this->items[$template_event]))
						{
							$this->items[$template_event][] = $data;
							continue;
						}

						$this->items[$template_event] = [$data];
					}
				}
			}
		}
	}

	public function get_items():array
	{
		return $this->items;
	}
}
