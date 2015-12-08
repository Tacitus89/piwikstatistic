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
	'ACP_PIWIK_DESC'									=> 'Add Desc',
	'ACP_PIWIK_EXT_CONF_SETTINGS'			=> 'Extension Settings',
	'ACP_PIWIK_EXT_ACTIVATE'					=> 'Piwik Statistic Activated',
	'ACP_PIWIK_SETTINGS'							=> 'Piwik Settings',
	'ACP_PIWIK_STATS_SETTINGS'				=> 'Piwik Statistic Settings',
	'ACP_PIWIK_STATS_ACTIVATE'				=> 'Piwik Statistic Site Activated',
	'ACP_PIWIK_TOKEN'									=> 'Piwik Token',
	'ACP_PIWIK_TOKEN_EXPLAIN'					=> 'ADD Explain',
	'ACP_PIWIK_STATS_INDEX_ACTIVATE'	=> 'Piwik Statistic Activated on Index',
	'ACP_PIWIK_CODE'									=> 'Piwik Code',
	'ACP_PIWIK_CODE_EXPLAIN'					=> 'Add Explain'
));