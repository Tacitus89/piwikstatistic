<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\acp;

class piwikstats_info
{
	function module()
	{
		return array(
			'filename'	=> '\tacitus89\gamesmod\acp\piwikstats_module',
			'title'		=> 'ACP_PIWIK_INDEX',
			'modes'		=> array(
				'config'	=> array('title' => 'ACP_PIWIK_SETTINGS', 	'auth' => 'ext_tacitus89/piwikstats && acl_a_board', 'cat' => array('ACP_PIWIK_INDEX')),
			),
		);
	}
}
