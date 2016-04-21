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

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Extended System News',
    'description' => 'Display sys_news as flash messages in the BE, useful for release announcements.',
    'category' => 'be',
    'version' => '1.1.0',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => null,
    'clearcacheonload' => true,
    'author' => 'Frank Nägler',
    'author_email' => 'frank.naegler@typo3.org',
    'author_company' => '',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-7.6.99',
            'sys_news' => '7.6.0-7.6.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
