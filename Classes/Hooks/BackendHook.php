<?php

namespace NeoBlack\ExtendedSysNews\Hooks;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Core\Database\TableConfigurationPostProcessingHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;

/**
 * Class BackendHook.
 */
class BackendHook implements TableConfigurationPostProcessingHookInterface
{
    /**
     * Check for sys_news which has the flag and create a flash message.
     *
     * @throws \InvalidArgumentException
     * @throws \TYPO3\CMS\Core\Exception
     */
    public function processData()
    {
        $records = $this->getDatabaseConnection()
            ->exec_SELECTgetRows('title,content,display_backend', 'sys_news', 'display_backend > 0');
        if ($records !== null) {
            $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();

            foreach ($records as $record) {
                $severity = $this->getSeverity($record['display_backend']);
                $flashMessage = GeneralUtility::makeInstance(
                    'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                    strip_tags($record['content']),
                    strip_tags($record['title']),
                    $severity,
                    false
                );

                $flashMessageService = GeneralUtility::makeInstance(
                    'TYPO3\\CMS\\Core\\Messaging\\FlashMessageService'
                );
                $defaultFlashMessageQueue->enqueue($flashMessage);
            }
        }
    }

    /**
     * @param $index
     *
     * @return int
     */
    protected function getSeverity($index)
    {
        $severity = null;
        switch ($index) {
            case 1:
                $severity = FlashMessage::NOTICE;
                break;
            case 2:
                $severity = FlashMessage::INFO;
                break;
            case 3:
                $severity = FlashMessage::OK;
                break;
            case 4:
                $severity = FlashMessage::WARNING;
                break;
            case 5:
                $severity = FlashMessage::ERROR;
                break;
            default:
                $severity = FlashMessage::INFO;
        }

        return $severity;
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
