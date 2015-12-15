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
	'PIWIK_STATS'				=> 'Piwik Statistic',
	'PIWIK_VISITORS'			=> 'Visitors',
	'PIWIK_ACTIONS'				=> 'Actions',
	'PIWIK_AVG_TIME_ON_SITE'	=> 'Avg Time on Site',
    'PIWIK_ACTIONS_PER_VISIT'   => 'Actions per Visit',
    'PIWIK_VISITS'              => 'Visits in the last ',
    'PIWIK_VISIT_TIME'          => 'Visiting time in the last ',
    'PIWIK_VISIT_DAY'           => 'Visiting time in days in the last ',
    'PIWIK_BROWSERS'            => 'Browser in the last ',
    'PIWIK_COUNTRY'             => 'Visitors from countries in the last ',
    'PIWIK_DAY'                 => ' days',
    'PIWIK_WEEK'                => ' weeks',
    'PIWIK_BASED_ON'            => 'based on the last ',
));
