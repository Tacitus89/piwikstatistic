<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\acp;

class piwikstats_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $request, $user;

		// Add the piwikstats ACP lang file
		$user->add_lang_ext('tacitus89/piwikstats', 'piwikstats_acp');

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_piwikstats';

		// Set the page title for our ACP page
		$this->page_title = $user->lang('ACP_PIWIK_INDEX');
	}
}
