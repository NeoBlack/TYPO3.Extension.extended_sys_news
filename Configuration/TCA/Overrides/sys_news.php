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
				array($ll . 'tx_extended_sys_news.display_backend.0', '0'),
				array($ll . 'tx_extended_sys_news.display_backend.1', '1'),
				array($ll . 'tx_extended_sys_news.display_backend.2', '2'),
				array($ll . 'tx_extended_sys_news.display_backend.3', '3'),
				array($ll . 'tx_extended_sys_news.display_backend.4', '4'),
				array($ll . 'tx_extended_sys_news.display_backend.5', '5'),
			),
			'default' => 0
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_news', $newSysNewsColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_news', 'display_backend', '', 'after:content');