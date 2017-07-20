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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\TableConfigurationPostProcessingHookInterface;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_news');
        $records = $queryBuilder
            ->select('title', 'content', 'display_backend')
            ->from('sys_news')
            ->where($queryBuilder->expr()->gt('display_backend', 0))
            ->execute()
            ->fetchAll();
        if (count($records)) {
            $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
            $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();

            foreach ($records as $record) {
                $severity = $this->getSeverity($record['display_backend']);
                $flashMessage = GeneralUtility::makeInstance(
                    FlashMessage::class,
                    strip_tags($record['content']),
                    strip_tags($record['title']),
                    $severity,
                    false
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
    protected function getSeverity($index) : int
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
}
