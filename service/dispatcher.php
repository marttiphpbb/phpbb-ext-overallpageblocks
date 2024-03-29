<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\service;

use phpbb\event\dispatcher as core_dispatcher;
use marttiphpbb\overallpageblocks\service\store;

class dispatcher
{
	protected $core_dispatcher;
	protected $store;
	protected $blocks = [];

	public function __construct(core_dispatcher $core_dispatcher, store $store)
	{
		$this->core_dispatcher = $core_dispatcher;
		$this->store = $store;
	}

	public function trigger_event()
	{
		$template_events = $this->store->get_all();
		$blocks = [];

		/**
		 * To add your blocks
		 *
		 * @event
		 * @var array blocks  			nested array to push your blocks
		 * @var array template_events 	nested array to check if template_events are enabled.
		 *
		 * Format: $blocks['vendor/extension']['block_key'] = $block;
		 * where $block is
		 * [
		 * 		'include'	=> '@yourvendor_yourextension/your_include_file.html',
		 * 		'var'		=> [],	// defaults to empty array
		 * ];
		 *
		 * Format $template_events['yourvendor/yourextension']['block_key'] = $tpl_ary
		 * where $tpl_ary is
		 * [
		 * 		'template_event_name' =>  priority (integer)
		 * ]
		 */
		$vars = ['blocks', 'template_events'];
		$result = $this->core_dispatcher->trigger_event('marttiphpbb.overallpageblocks', compact($vars));

		if (count($result['blocks']))
		{
			foreach ($result['blocks'] as $extension_name => $block_ary)
			{
				if (!$this->store->extension_is_present($extension_name))
				{
					continue;
				}

				foreach ($block_ary as $key => $data)
				{
					$template_events = $this->store->get($extension_name, $key);

					if (!count($template_events))
					{
						continue;
					}

					$data['key'] = $key;

					foreach ($template_events as $template_event => $priority)
					{
						$data['priority'] = $priority;

						if (isset($this->blocks[$template_event]))
						{
							$this->blocks[$template_event][] = $data;
							continue;
						}

						$this->blocks[$template_event] = [$data];
					}
				}
			}

			foreach ($this->blocks as &$block)
			{
				usort($block, function($a, $b){
					return $a['priority'] < $b['priority'] ? 1 : -1;
				});
			}
		}
	}

	public function get_blocks():array
	{
		return $this->blocks;
	}
}
