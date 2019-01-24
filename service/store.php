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
	protected $blocks = [];

	public function __construct(
		config_text $config_text,
		cache $cache
	)
	{
		$this->config_text = $config_text;
		$this->cache = $cache;
	}

	private function load()
	{
		if ($this->blocks)
		{
			return;
		}

		$this->blocks = $this->cache->get(cnst::CACHE_ID);

		if ($this->blocks)
		{
			return;
		}

		$this->blocks = unserialize($this->config_text->get(cnst::ID));
		$this->cache->put(cnst::CACHE_ID, $this->blocks);
	}

	private function write()
	{
		$this->config_text->set(cnst::ID, serialize($this->blocks));
		$this->cache->put(cnst::CACHE_ID, $this->blocks);
	}

	public function set_all(array $blocks)
	{
		$this->blocks = $blocks;
		$this->write();
	}

	public function get_all():array
	{
		$this->load();
		return $this->blocks;
	}

	public function get(string $extension_name, string $key):array
	{
		$this->load();
		return $this->blocks[$extension_name][$key] ?? [];
	}

	public function set(string $extension_name, string $key, array $template_events)
	{
		$this->load();
		$this->blocks[$extension_name][$key] = $template_events;
		$this->write();
	}

	public function remove_extension(string $extension_name):void
	{
		$this->load();
		unset($this->blocks[$extension_name]);
		$this->write();
	}

	public function get_extensions():array
	{
		$this->load();
		return array_keys($this->blocks);
	}

	public function extension_is_present(string $extension_name):boolean
	{
		$this->load();
		return isset($this->blocks[$extension_name]);
	}
}
