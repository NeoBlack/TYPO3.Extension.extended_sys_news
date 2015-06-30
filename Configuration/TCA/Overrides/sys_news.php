<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$ll = 'LLL:EXT:extended_sys_news/Resources/Private/Language/locallang_db.xlf:';

/**
 * Add extra fields to the sys_category record
 */
$newSysNewsColumns = array(
	'display_backend' => array(
		'label' => $ll . 'tx_extended_sys_news.display_backend',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('Not displayed', '0'),
				array('NOTICE', '1'),
				array('INFO', '2'),
				array('OK', '3'),
				array('WARNING', '4'),
				array('ERROR', '5'),
			),
			'default' => 0
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_news', $newSysNewsColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_news', 'display_backend', '', 'after:content');