<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\piwikstats\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Main controller
*/
class main_controller
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

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\config\config         $config          Config object
	* @param \phpbb\config\db_text       	$config_text        DB text object
	* @param \phpbb\template\template     $template        Template object
	* @param \phpbb\user                	$user            User object
	* @return \tacitus89\piwikstats\controller\admin_controller
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
	* Display the games
	*
	* @return null
	* @access public
	*/
	public function display()
	{
    // Add the piwikstats ACP lang file
		$this->user->add_lang_ext('tacitus89/piwikstats', 'piwikstats');

    // Set the page title
		$this->page_title = $this->user->lang('L_PIWIK_STATS');

    //get the config text data for piwikstats
    $config_text = $this->getConfigText();

		$this->template->assign_vars(array(
      'PIWIK_VISITS_DAY'					=> base64_encode($this->getPiwikImage($config_text, "VisitsSummary", "get", "evolution", "day")),
      'PIWIK_VISITS_WEEK'					=> base64_encode($this->getPiwikImage($config_text, "VisitsSummary", "get", "evolution", "week")),
      'PIWIK_VISIT_TIME'					=> base64_encode($this->getPiwikImage($config_text, "VisitTime", "getVisitInformationPerServerTime ", "verticalBar")),
      'PIWIK_VISIT_DAY' 					=> base64_encode($this->getPiwikImage($config_text, "VisitTime", "getByDayOfWeek ", "verticalBar")),
      'PIWIK_BROWSERS' 				   	=> base64_encode($this->getPiwikImage($config_text, "DevicesDetection", "getBrowsers ", "horizontalBar")),
      'PIWIK_COUNTRY' 	   				=> base64_encode($this->getPiwikImage($config_text, "UserCountry", "getCountry ", "horizontalBar")),
      'PIWIK_TIME'                => $config_text['piwik_time']
		));

		// Send all data to the template file
		return $this->helper->render('piwik.html', $this->user->lang('PIWIK_STATS'));
	}

  /**
	* Get the data from piwik
	*
	* @return array
	* @access private
	*/
  private function getPiwikImage($config_text, $module, $action, $graphType= "evolution", $period = "range")
  {
    $url = $config_text['piwik_url']."/index.php?module=API&method=ImageGraph.get"
		  . "&idSite=". $config_text['piwik_site_id'] ."&apiModule=$module&apiAction=$action"
		  . "&period=$period&date=last". $config_text['piwik_time']
		  . "&token_auth=". $config_text['piwik_token']
		  . "&format=php&height=200&width=500&graphType=$graphType";

    return file_get_contents($url);
  }

  /**
	* Get piwikstats data from the config_text object
	*
	* @return array
	* @access private
	*/
  private function getConfigText()
  {
    // Get piwikstats data from the config_text object
		return $this->config_text->get_array(array(
			'piwik_url',
			'piwik_token',
			'piwik_site_id',
      'piwik_time',
		));
  }

}
