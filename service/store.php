<?php

/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\service;

use phpbb\config\db_text as config_text;
use phpbb\cache\driver\driver_interface as cache;
use marttiphpbb\overallpageblocks\util\cnst;

class store
{
	protected $config_text;
	protected $cache;
	protected $template_events = [];

	public function __construct(
		config_text $config_text,
		cache $cache
	)
	{
		$this->config_text = $config_text;
		$this->cache = $cache;
	}

	private function load():void
	{
		if ($this->template_events)
		{
			return;
		}

		$this->template_events = $this->cache->get(cnst::CACHE_ID);

		if ($this->template_events)
		{
			return;
		}

		$this->template_events = unserialize($this->config_text->get(cnst::ID));
		$this->cache->put(cnst::CACHE_ID, $this->template_events);
	}

	private function write():void
	{
		$this->config_text->set(cnst::ID, serialize($this->template_events));
		$this->cache->put(cnst::CACHE_ID, $this->template_events);
	}

	public function get_all():array
	{
		$this->load();
		return $this->template_events;
	}

	public function get(string $extension_name, string $key):array
	{
		$this->load();
		return $this->template_events[$extension_name][$key] ?? [];
	}

	public function set(
		string $extension_name,
		string $key,
		array $template_events
	):void
	{
		$this->load();
		$this->template_events[$extension_name][$key] = $template_events;
		$this->write();
	}

	public function remove_extension(string $extension_name):void
	{
		$this->load();
		unset($this->template_events[$extension_name]);
		$this->write();
	}

	public function remove_key(string $extension_name, string $key):void
	{
		$this->load();
		unset($this->items[$extension_name][$key]);
		$this->write();
	}

	public function get_extensions():array
	{
		$this->load();
		return array_keys($this->template_events);
	}

	public function extension_is_present(string $extension_name):bool
	{
		$this->load();
		return isset($this->template_events[$extension_name]);
	}
}
