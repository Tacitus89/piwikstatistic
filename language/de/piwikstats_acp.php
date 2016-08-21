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
    'ACP_PIWIK_EXT_CONF_SETTINGS'			=> 'Erweiterung Einstellungen',
	'ACP_PIWIK_EXT_ACTIVATE'				=> 'Piwik Statistik Aktiviert',
	'ACP_PIWIK_SETTINGS'					=> 'Piwik-Tracking Einstellungen',
    'ACP_PIWIK_URL'							=> 'Piwik URL',
    'ACP_PIWIK_URL_EXPLAIN'					=> 'Die URL zu deiner Piwik-Installation, zum Beispiel: http://www.example.com/piwik',
	'ACP_PIWIK_TOKEN'                   	=> 'Piwik Token',
	'ACP_PIWIK_TOKEN_EXPLAIN'				=> 'Gebe "anonymous" ein, wenn es die View Rechte hat. Ansonsten musst du ein token_auth von einem Benutzer eingeben, der die View Rechte besitzt.',
    'ACP_PIWIK_SITE_ID'                 	=> 'Seiten ID',
    'ACP_PIWIK_SITE_ID_EXPLAIN'         	=> 'Gebe eine einzelne Seiten-ID ein.',
	'ACP_PIWIK_STATS_PAGE_SETTINGS'			=> 'Piwik Statistik Seite Einstellungen',
	'ACP_PIWIK_STATS_PAGE_ACTIVATE'			=> 'Piwik Statistik Seite Aktiviert',
    'ACP_PIWIK_TIME_PAGE'					=> 'Zeitraum',
    'ACP_PIWIK_TIME_PAGE_EXPLAIN'			=> 'Für die Informationen auf der Piwik Statistik Seite',
    'ACP_PIWIK_CACHE_PAGE'					=> 'Zeitdauer für Piwik Statistiken im Cache',
    'ACP_PIWIK_CACHE_PAGE_EXPLAIN'			=> 'Zeit in Sekunden. Standard: 86400 (1 Tag)',
    'ACP_PIWIK_STATS_INDEX_SETTINGS'    	=> 'Piwik Statistik auf dem Index',
	'ACP_PIWIK_STATS_INDEX_ACTIVATE'    	=> 'Piwik Statistik auf dem Index aktiviert',
    'ACP_PIWIK_TIME_INDEX'              	=> 'Zeitraum auf dem Index',
    'ACP_PIWIK_TIME_INDEX_EXPLAIN'      	=> 'Für die Informationen auf dem Index',
    'ACP_PIWIK_CACHE_INDEX'             	=> 'Zeitdauer für Piwik Statistiken im Cache auf dem Index',
    'ACP_PIWIK_CACHE_INDEX_EXPLAIN'     	=> 'Zeit in Sekunden. Standard: 10800 (3 Stunden)',
	'ACP_PIWIK_ACCEPT_DONOTTRACK'			=> 'Akzeptiere \'DoNotTrack\'-Einstellung',
	'ACP_PIWIK_USER_ID'						=> 'Verwende Benutzer-ID',
	'ACP_PIWIK_USER_ID_EXPLAIN'				=> 'Piwik kann nun auch mit Hilfe der Benutzer-ID die Besucher unterscheiden.',
	'ACP_PIWIK_SET_TITLE'					=> 'Verwende angepasste Seitentitel',
	'ACP_PIWIK_SET_TITLE_EXPLAIN'			=> 'Erlaubt Piwik die Forenstruktur zu erkennen und in der Statistik wiederzugeben',
	'ACP_PIWIK_TRACK_VISITORTYPE'			=> 'Tracke den Benutzertyp',
	'ACP_PIWIK_TRACK_VISITORTYPE_EXPLAIN'	=> 'Setzt bei \'setCustomVariable\' die Variable \'VisitorType\' zur Unterscheidung von Mitglieder und Gästen.',
	'ACP_PIWIK_SEARCH'						=> 'Verwende angepassten Suchtracking',
	'ACP_PIWIK_SEARCH_EXPLAIN'				=> 'Gibt Suchanfragen und Anzahl der Ergebnisse an Piwik weiter.',
    'ACP_PIWIKSTATS_SETTINGS_SAVED'     	=> 'Einstellungen sind gespiechert.',

    //errors
    'ACP_PIWIK_CACHE_TOO_HIGH'          	=> 'Die Zeitdauer für den Cache ist zu hoch.',
));
