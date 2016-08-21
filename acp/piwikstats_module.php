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

            $cacheTime = $this->request->variable('piwik_cache_page', 0);
            $cacheTimeIndex = $this->request->variable('piwik_cache_index', 0);
            if($cacheTime > 2592000 || $cacheTimeIndex > 2592000)
            {
                $errors[] = $this->user->lang('ACP_PIWIK_CACHE_TOO_HIGH');
            }

			// If no errors, process the form data
			if (empty($errors))
			{
				// Set the options
				$this->config->set('piwik_ext_active', $this->request->variable('piwik_ext_active', 0));
                $this->config->set('piwik_url', rtrim($this->request->variable('piwik_url', '', true), '/'));
				$this->config->set('piwik_site_id', $this->request->variable('piwik_site_id', 0));
				$this->config->set('piwik_accept_donottrack', $this->request->variable('piwik_accept_donottrack', 0));
				$this->config->set('piwik_use_user_id', $this->request->variable('piwik_use_user_id', 0));
				$this->config->set('piwik_set_title', $this->request->variable('piwik_set_title', 0));
				$this->config->set('piwik_track_visitortype', $this->request->variable('piwik_track_visitortype', 0));
				$this->config->set('piwik_search', $this->request->variable('piwik_search', 0));
				$this->config_text->set('piwik_token', $this->request->variable('piwik_token', '', true));
				//Set stats_page
				$this->config->set('piwik_stats_page_active', $this->request->variable('piwik_stats_page_active', 0));
                $this->config_text->set('piwik_time_page', $this->request->variable('piwik_time_page', 0));
                $this->config_text->set('piwik_cache_page', $cacheTime);
				//Set stats_index
				$this->config->set('piwik_stats_index_active', $this->request->variable('piwik_stats_index_active', 0));
                $this->config_text->set('piwik_time_index', $this->request->variable('piwik_time_index', 0));
                $this->config_text->set('piwik_cache_index', $cacheTimeIndex);
				

				// Add option settings change action to the admin log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PIWIKSTATS_SETTINGS_LOG');

				// Option settings have been updated
				// Confirm this to the user and provide link back to previous page
				trigger_error($this->user->lang('ACP_PIWIKSTATS_SETTINGS_SAVED') . adm_back_link($this->u_action));
			}
		}

        // Get piwikstats data from the config_text object
		$config_text = $this->config_text->get_array(array(
			'piwik_token',
            'piwik_cache_page',
			'piwik_time_page',
            'piwik_cache_index',
			'piwik_time_index',
		));

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'S_ERROR'		=> (sizeof($errors)) ? true : false,
			'ERROR_MSG'		=> (sizeof($errors)) ? implode('<br />', $errors) : '',

			'U_ACTION'		=> $this->u_action,

			'S_PIWIK_EXT_ACTIVE'			=> $this->config['piwik_ext_active'] ? true : false,
            'PIWIK_URL'						=> $this->config['piwik_url'],
            'PIWIK_SITE_ID'			        => $this->config['piwik_site_id'],
			'S_PIWIK_ACCEPT_DONOTTRACK'		=> $this->config['piwik_accept_donottrack'] ? true : false,
			'S_PIWIK_USER_ID'				=> $this->config['piwik_use_user_id'] ? true : false,
			'S_PIWIK_SET_TITLE'				=> $this->config['piwik_set_title'] ? true : false,
			'S_PIWIK_TRACK_VISITORTYPE'		=> $this->config['piwik_track_visitortype'] ? true : false,
			'S_PIWIK_SEARCH'				=> $this->config['piwik_search'] ? true : false,
			'PIWIK_TOKEN'					=> $config_text['piwik_token'],
			//Page
			'S_PIWIK_STATS_PAGE_ACTIVE'		=> $this->config['piwik_stats_page_active'] ? true : false,
            'PIWIK_TIME_PAGE'		       	=> $config_text['piwik_time_page'],
            'PIWIK_CACHE_PAGE'		        => $config_text['piwik_cache_page'],
			//Index
			'S_PIWIK_STATS_INDEX_ACTIVE'	=> $this->config['piwik_stats_index_active'] ? true : false,
            'PIWIK_TIME_INDEX'				=> $config_text['piwik_time_index'],
            'PIWIK_CACHE_INDEX'			    => $config_text['piwik_cache_index'],
			
		));

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_piwikstats';

		// Set the page title for our ACP page
		$this->page_title = $user->lang('ACP_PIWIK_INDEX');
	}
}
