<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "extended_sys_news".
 *
 * Auto generated 06-05-2015 19:11
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Extended System News',
	'description' => 'Display sys_news as flash messages in the BE, useful for release announcements.',
	'category' => 'be',
	'version' => '1.1.0-dev',
	'state' => 'stable',
	'uploadfolder' => FALSE,
	'createDirs' => NULL,
	'clearcacheonload' => true,
	'author' => 'Frank Nägler',
	'author_email' => 'typo3@naegler.net',
	'author_company' => '',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '6.2.3-7.99.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

