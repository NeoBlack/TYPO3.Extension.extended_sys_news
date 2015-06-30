<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
 * Register hooks
 */
if (TYPO3_MODE === 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['extTablesInclusion-PostProcessing'][] = 'NeoBlack\\ExtendedSysNews\\Hooks\\BackendHook';
}

