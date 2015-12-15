<?php
/**
*
* @package Piwik Statistic for phpBB3.1
* @copyright (c) 2015 Marco Candian (tacitus@strategie-zone.de)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_PIWIK_EXT_CONF_SETTINGS'       => 'Extension Settings',
	'ACP_PIWIK_EXT_ACTIVATE'            => 'Piwik Statistic Activated',
	'ACP_PIWIK_SETTINGS'                => 'Piwik Settings',
	'ACP_PIWIK_STATS_SETTINGS'          => 'Piwik Statistic Settings',
	'ACP_PIWIK_STATS_ACTIVATE'          => 'Piwik Statistic Site Activated',
    'ACP_PIWIK_URL'                     => 'Piwik URL',
    'ACP_PIWIK_URL_EXPLAIN'             => 'The URL to your Piwik folder, like http://www.example.com/piwik',
    'ACP_PIWIK_TOKEN'				    => 'Piwik Token',
    'ACP_PIWIK_TOKEN_EXPLAIN'           => 'Set it "anonymous" if it have the view permissions. Otherwise you must put a token_auth from a user, which has the view permissions.',
    'ACP_PIWIK_SITE_ID'                 => 'Site ID',
    'ACP_PIWIK_SITE_ID_EXPLAIN'         => 'Set a single Site-ID.',
    'ACP_PIWIK_TIME'                    => 'Time period',
    'ACP_PIWIK_TIME_EXPLAIN'            => 'For the informations on Piwik Statistic Site in days',
    'ACP_PIWIK_CACHE'                   => 'Cache time for Piwik Statistics',
    'ACP_PIWIK_CACHE_EXPLAIN'           => 'Time in seconds. Default: 86400 (1 day)',
    'ACP_PIWIK_STATS_INDEX_SETTINGS'    => 'Piwik Statistic on Index',
    'ACP_PIWIK_STATS_INDEX_ACTIVATE'    => 'Piwik Statistic Activated on Index',
    'ACP_PIWIK_TIME_INDEX'              => 'Time period on Index',
    'ACP_PIWIK_TIME_INDEX_EXPLAIN'      => 'For the informations on index in days',
    'ACP_PIWIK_CACHE_INDEX'             => 'Cache time for Piwik Statistics on Index',
    'ACP_PIWIK_CACHE_INDEX_EXPLAIN'     => 'Time in seconds. Default: 21600 (6 hours)',
    'ACP_PIWIK_CODE'				    => 'Piwik Tracking-Code',
    'ACP_PIWIKSTATS_SETTINGS_SAVED'     => 'Settings are saved.',

    //errors
    'ACP_PIWIK_CACHE_TOO_HIGH'          => 'Time for cache is too high.',
));
