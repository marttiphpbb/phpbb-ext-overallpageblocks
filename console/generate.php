<?php
/**
* phpBB Extension - marttiphpbb overallpageblocks
* @copyright (c) 2019 - 2022 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\overallpageblocks\console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use phpbb\console\command\command;
use phpbb\user;
use marttiphpbb\overallpageblocks\util\cnst;

class generate extends command
{
	const PATH = __DIR__ . '/../styles/prosilver/template/event/';
	const TPL_VAR = 'marttiphpbb_overallpageblocks.blocks';
	const TPL = <<<'EOT'
{#- This file was generated with command ext-overallpageblocks:generate -#}
{%- if %var%.%name% -%}
	{%- for b in %var%.%name% -%}
		{%- include b.include with {'var': b.var, 'key': b.key} only -%}
	{%- endfor -%}
{%- endif -%}
EOT;

	public function __construct(user $user)
	{
		parent::__construct($user);
	}

	protected function configure()
	{
		$this
			->setName('ext-overallpageblocks:generate')
			->setDescription('For internal development use.')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		$outputStyle = new OutputFormatterStyle('white', 'black', ['bold']);
		$output->getFormatter()->setStyle('v', $outputStyle);

		$io->writeln([
			'<comment>',
			'Generate menu template event listeners',
			'--------------------------------------',
			'</>',
		]);

		foreach (cnst::ITEMS as $name)
		{
			$search = ['%name%', '%var%'];
			$replace = [$name, self::TPL_VAR];
			$content = str_replace($search, $replace, self::TPL);

			file_put_contents(self::PATH . $name . '.html', $content);

			$io->writeln('<info>Listener generated: </><v>' . $name . '</>');
		}

		$io->writeln('');
	}
}
