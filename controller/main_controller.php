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

    /** @var \phpbb\cache\driver\driver_interface */
    protected $cache;

    /** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\config\config                  $config          Config object
	* @param \phpbb\config\db_text                 $config_text     DB text object
	* @param \phpbb\template\template              $template        Template object
	* @param \phpbb\user                           $user            User object
    * @param \phpbb\cache\driver\driver_interface  $cache           Cache object
    * @param string                                $root_path       phpBB root path
	* @param string                                $php_ext         phpEx
	* @return \tacitus89\piwikstats\controller\admin_controller
	* @access public
	*/
	public function __construct(\phpbb\config\config $config,
                                \phpbb\config\db_text $config_text,
                                \phpbb\controller\helper $helper,
                                \phpbb\template\template $template,
                                \phpbb\user $user,
                                \phpbb\cache\driver\driver_interface $cache,
                                $root_path,
                                $php_ext)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
        $this->cache = $cache;
        $this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* Display the games
	*
	* @return null
	* @access public
	*/
	public function display()
	{
        // When PiwikStats-Site are disabled, redirect users back to the forum index
		if ((!empty($this->config['piwik_stats_page_active'])) == false)
		{
			redirect(append_sid("{$this->root_path}index.{$this->php_ext}"));
		}

        // Add the piwikstats ACP lang file
        $this->user->add_lang_ext('tacitus89/piwikstats', 'piwikstats');

        // Set the page title
		$this->page_title = $this->user->lang('L_PIWIK_STATS');

        //get the config text data for piwikstats
        $config_text = $this->getConfigText();

        $piwikData = array(
            array(
                'module'    => 'VisitsSummary',
                'action'    => 'get',
                'graphType' => 'evolution',
                'period'    => 'day',
            ),
            array(
                'module'    => 'VisitsSummary',
                'action'    => 'get',
                'graphType' => 'evolution',
                'period'    => 'week',
            ),
            array(
                'module'    => 'VisitTime',
                'action'    => 'getVisitInformationPerServerTime',
                'graphType' => 'verticalBar',
                'period'    => 'range',
            ),
            array(
                'module'    => 'VisitTime',
                'action'    => 'getByDayOfWeek',
                'graphType' => 'verticalBar',
                'period'    => 'range',
            ),
            array(
                'module'    => 'DevicesDetection',
                'action'    => 'getBrowsers',
                'graphType' => 'horizontalBar',
                'period'    => 'range',
            ),
            array(
                'module'    => 'UserCountry',
                'action'    => 'getCountry',
                'graphType' => 'horizontalBar',
                'period'    => 'range',
            ),
        );

        foreach ($piwikData as $key => $data) {
            $this->template->assign_vars(array(
                'PIWIK_'.$key    => base64_encode($this->getImage($config_text, $data)),
    		));
        }

		$this->template->assign_vars(array(
            'PIWIK_TIME'                => $config_text['piwik_time_page'],
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
    private function getPiwikImage($config_text, $module, $action, $graphType, $period)
    {
        $url = $this->config['piwik_url']."/index.php?module=API&method=ImageGraph.get"
            . "&idSite=". $this->config['piwik_site_id'] ."&apiModule=$module&apiAction=$action"
            . "&period=$period&date=last". $config_text['piwik_time_page']
            . "&token_auth=". $config_text['piwik_token']
            . "&format=php&height=200&width=500&graphType=$graphType";

        $data = @file_get_contents($url);

        //Is it a correct url?
        if($data === false)
        {
            return;
        }

        return $data;
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
			'piwik_token',
            'piwik_cache_page',
			'piwik_time_page',
		));
    }

    /**
	* Get image from Cache or Piwik
	*
    * @param  array    $configText  With datas from config_text
    * @param  array    $stats   With datas for piwik
	* @return string   Image as String
	* @access private
	*/
    private function getImage($configText, $stats)
    {
        $cacheName = $stats['module'] . '_' . $stats['action'] . '_' . $stats['period'];
        $image = $this->cache->get($cacheName);

        if ($image === false)
        {
            $image = $this->getPiwikImage($configText, $stats['module'], $stats['action'], $stats['graphType'], $stats['period']);

            $this->cache->put($cacheName, $image, $configText['piwik_cache_page']);
        }

        return $image;
    }

}
