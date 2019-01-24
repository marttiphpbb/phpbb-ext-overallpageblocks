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
		 * To add your items
		 *
		 * @event
		 * @var array	items  push here your items
		 * like this $items['vendor/extension']['item_key'] = $item;
		 * where item is
		 * $item = [
		 * 		'include'	=> '@vendor_extension/your_include_file.html',
		 * 		'var'		=> [],	// defaults to empty array
		 * ];
		 */
		$vars = ['items'];
		$result = $this->core_dispatcher->trigger_event('marttiphpbb.overallpageblocks.add_items', compact($vars));

		if (count($result['items']))
		{
			foreach ($result['items'] as $extension_name => $menu_ary)
			{
				if (!$this->store->extension_is_present($extension_name))
				{
					continue;
				}

				foreach ($menu_ary as $key => $data)
				{
					$template_events = $this->store->get($extension_name, $key);

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
