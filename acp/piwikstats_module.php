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
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	public $u_action;

	function main($id, $mode)
	{
		global $config, $request, $template, $user, $phpbb_container;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->log = $phpbb_container->get('log');
		$this->config_text = $phpbb_container->get('config_text');

		// Add the piwikstats ACP lang file
		$user->add_lang_ext('tacitus89/piwikstats', 'piwikstats_acp');

		// Create a form key for preventing CSRF attacks
		add_form_key('piwikstats_config');

		// Create an array to collect errors that will be output to the user
		$errors = array();

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			// Test if the submitted form is valid
			if (!check_form_key('piwikstats_config'))
			{
				$errors[] = $this->user->lang('FORM_INVALID');
			}

			// If no errors, process the form data
			if (empty($errors))
			{
				// Set the options
				$this->config->set('piwik_ext_active', $this->request->variable('piwik_ext_active', 1));
				$this->config->set('piwik_stats_active', $this->request->variable('piwik_stats_active', 1));
				$this->config_text->set('piwik_token', $this->request->variable('piwik_token', ''));
				$this->config->set('piwik_stats_index_active', $this->request->variable('piwik_stats_index_active', 1));
				$this->config_text->set('piwik_code', $this->request->variable('piwik_code', ''));

				// Add option settings change action to the admin log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PIWIKSTATS_SETTINGS_LOG');

				// Option settings have been updated
				// Confirm this to the user and provide link back to previous page
				trigger_error($this->user->lang('ACP_PIWIKSTATS_SETTINGS_SAVED') . adm_back_link($this->u_action));
			}
		}

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'S_ERROR'		=> (sizeof($errors)) ? true : false,
			'ERROR_MSG'		=> (sizeof($errors)) ? implode('<br />', $errors) : '',

			'U_ACTION'		=> $this->u_action,

			'S_PIWIK_EXT_ACTIVE'					=> $this->config['piwik_ext_active'] ? true : false,
			'S_PIWIK_STATS_ACTIVE'				=> $this->config['piwik_stats_active'] ? true : false,
			'PIWIK_TOKEN'									=> $this->config_text->get('piwik_token'),
			'S_PIWIK_STATS_INDEX_ACTIVE'	=> $this->config['piwik_stats_index_active'] ? true : false,
			'PIWIK_CODE'									=> $this->config_text->get('piwik_code'),
		));

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_piwikstats';

		// Set the page title for our ACP page
		$this->page_title = $user->lang('ACP_PIWIK_INDEX');
	}
}
