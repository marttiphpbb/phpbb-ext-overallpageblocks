<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\event;

use phpbb\event\data as event;

use marttiphpbb\overallpageblocks\service\dispatcher;
use marttiphpbb\overallpageblocks\service\store;
use marttiphpbb\overallpageblocks\service\acp;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $dispatcher;
	protected $store;
	protected $acp;

	public function __construct(
		dispatcher $dispatcher,
		store $store,
		acp $acp
	)
	{
		$this->dispatcher = $dispatcher;
		$this->store = $store;
		$this->acp = $acp;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.acp_extensions_run_action_after'
				=> 'core_acp_extensions_run_action_after',
			'core.page_header'
				=> 'core_page_header',
			'core.twig_environment_render_template_before'
				=> 'core_twig_environment_render_template_before',
		];
	}

	public function core_acp_extensions_run_action_after(event $event)
	{
		if ($event['action'] === 'delete_data')
		{
			$this->store->remove_extension($event['ext_name']);
		}
	}

	public function core_page_header(event $event)
	{
		$this->dispatcher->trigger_event();
	}

	public function core_twig_environment_render_template_before(event $event)
	{
		$context = $event['context'];
		$context['marttiphpbb_overallpageblocks'] = [
			'items'		=> $this->dispatcher->get_items(),
			'acp'		=> $this->acp->get_selected(),
		];
		$event['context'] = $context;
	}
}
