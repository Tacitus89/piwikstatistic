<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstatistic\acp;

class piwikstatistic_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $request, $user;

		// Add the piwikstatistic ACP lang file
		$user->add_lang_ext('tacitus89/piwikstatistic', 'piwikstatistic_acp');
	}
}
