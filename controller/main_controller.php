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
		// anpassen
		$sPiwikToken = "17321cd9713af39fa72775a6c636002b";
		$iPiwikSiteId = 1;

		// Bildgroesse und Farbe
		$iImageWidth = 500;
		$iImageHeight = 200;
		$sBarColor = "000000";

		// Domain und Pfad zu Piwik anpassen
		$sBaseUrl = "http://www.strategie-zone.de/piwik/index.php?module=API&method=ImageGraph.get"
		  . "&idSite=$iPiwikSiteId&apiModule=VisitsSummary&apiAction=get"
		  . "&period=day&date=previous30"
		  . "&token_auth=$sPiwikToken"
		  . "&width=$iImageWidth&height=$iImageHeight&colors=$sBarColor";

		$this->template->assign_vars(array(
			'PIWIK_IMAGE' 					=> base64_encode(file_get_contents($sBaseUrl)),
		));

		// Send all data to the template file
		return $this->helper->render('piwik.html', $this->user->lang('PIWIKSTATS'));
	}

}
