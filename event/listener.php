<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\config\config        $config             Config object
	* @param \phpbb\config\db_text       $config_text        DB text object
	* @param \phpbb\controller\helper    $helper  					 Controller helper object
	* @param \phpbb\template\template    $template           Template object
	* @param \phpbb\user                 $user               User object
	* @return \phpbb\piwikstats\event\listener
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_footer'							=> 'page_footer',
			'core.index_modify_page_title'	=> 'add_on_index',
		);
	}

	/**
	* Add the piwik code at the page footer
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function page_footer($event)
	{
		$this->template->assign_vars(array(
			'S_PIWIK_EXT_ACTIVE'	=> (!empty($this->config['piwik_ext_active'])) ? true : false,
			'PIWIK_CODE' 					=> $this->config_text->get('piwik_code'),
		));
	}

	/**
	* Add some stats from piwik on the index
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function add_on_index($event)
	{
    //Is it activated?
    if ((!empty($this->config['piwik_stats_index_active'])) == false || (!empty($this->config['piwik_ext_active'])) == false)
		{
			return;
		}

    // Get piwikstats data from the config_text object
		$config_text = $this->config_text->get_array(array(
			'piwik_url',
			'piwik_token',
			'piwik_site_id',
			'piwik_time_index'
		));

		//url to piwik
		$url = $config_text['piwik_url']."/index.php?module=API&method=VisitsSummary.get"
		  . "&idSite=". $config_text['piwik_site_id'] ."&apiModule=VisitsSummary&apiAction=get"
		  . "&period=range&date=last". $config_text['piwik_time_index']
		  . "&token_auth=". $config_text['piwik_token']
		  . "&format=php";

    //unserialize the data
		$data = unserialize(file_get_contents($url));

		// Add piwikstats language file
		$this->user->add_lang_ext('tacitus89/piwikstats', 'piwikstats');

		// Output piwikstats to the template
		$this->template->assign_vars(array(
			'S_PIWIK_STATS_INDEX_ACTIVATE'	=> (!empty($this->config['piwik_stats_index_active'])) ? true : false,
			'PIWIK_STATS_URL'								=> $this->helper->route('tacitus89_piwikstats_main_controller'),
			'PIWIK_VISITORS' 								=> number_format($data['nb_visits'], 0, ',', '.'),
			'PIWIK_ACTIONS'									=> number_format($data['nb_actions'], 0, ',', '.'),
			'PIWIK_AVG_TIME_ON_SITE'				=> gmdate("H:i:s", $data['avg_time_on_site']),
			'PIWIK_ACTIONS_PER_VISIT'				=> round($data['nb_actions_per_visit'], 2),
      'PIWIK_TIME'                    => $config_text['piwik_time_index']
		));
	}
}
