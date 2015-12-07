<?php

/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\migrations;

class install_0_0_1 extends \phpbb\db\migration\migration
{
	var $piwikstats_version = '0.0.1';

	public function effectively_installed()
	{
		return isset($this->config['piwikstats_version']) && version_compare($this->config['piwikstats_version'], $this->piwikstats_version, '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			// Set the current version
			array('config.add', array('piwikstats_version', $this->piwikstats_version)),
			// All config
			array('config.add', array('piwikstats_active', 1)),
			// config_text
			array('config_text.add', array('piwik_code', '')),

			//Set ACP Module
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_PIWIK_INDEX')),
			array('module.add', array(
				'acp', 'ACP_PIWIK_INDEX', array(
					'module_basename'	=> '\tacitus89\piwikstats\acp\piwikstats_module',
					'modes'				=> array('config'),
				),
			)),
		);
	}
}
