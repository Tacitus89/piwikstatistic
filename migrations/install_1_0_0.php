<?php

/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\migrations;

class install_1_0_0 extends \phpbb\db\migration\migration
{
	var $piwikstats_version = '1.0.0';

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
			array('config.add', array('piwik_ext_active', 0)),
			array('config.add', array('piwik_url', '')),
			array('config.add', array('piwik_site_id', '')),
			array('config.add', array('piwik_accept_donottrack', 1)),
			array('config.add', array('piwik_use_user_id', 0)),
			array('config.add', array('piwik_set_title', 1)),
			array('config.add', array('piwik_track_visitortype', 0)),
			array('config.add', array('piwik_search', 1)),
			array('config.add', array('piwik_stats_page_active', 0)),
			array('config.add', array('piwik_stats_index_active', 0)),
			// config_text
            array('config_text.add', array('piwik_token', '')),
            array('config_text.add', array('piwik_time_page', 30)),
            array('config_text.add', array('piwik_time_index', 7)),
            array('config_text.add', array('piwik_cache_page', 86400)),
            array('config_text.add', array('piwik_cache_index', 10800)),
            

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
