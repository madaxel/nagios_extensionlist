<?php
declare(strict_types=1);
namespace SchamsNet\NagiosExtensionlist\Controller;

/*
 * This file is part of the TYPO3 Extension "Nagios Extensionlist"
 *
 * Author: Michael Schams <schams.net>
 * Website: https://schams.net
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please see
 * https://www.gnu.org/licenses/gpl.html
 */

use \Psr\Http\Message\ResponseInterface;
use \SchamsNet\NagiosExtensionlist\Domain\Repository\ExtensionlistRepository;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/**
 * Extensionlist Controller
 */
class ExtensionlistController extends ActionController
{
    /**
     * Extensionlist Repository
     */
    protected $extensionlistRepository;

    /**
     * Constructor
     */
    public function __construct(ExtensionlistRepository $extensionlistRepository)
    {
        $this->extensionlistRepository = $extensionlistRepository;
    }

    /**
     * Generates list of insecure extensions.
     */
    public function listInsecureExtensionsAction(): ResponseInterface
    {
        $insecureExtensions = $this->extensionlistRepository->findByReviewState(-1);
        $insecureExtensionsAndVersionCsv = $this->convertVersionsToCommaSeparatedValues($insecureExtensions);

        // Determine status of extension list by retrieving most recent record
        $lastUpdated = $this->extensionlistRepository->findLastUpdatedExtension();

        // Make sure, extension list is not empty
        if (is_object($lastUpdated) && $lastUpdated->count() > 0) {
            $lastUpdated = $lastUpdated->getFirst()->getLastUpdated();
            $this->view->assignMultiple(
                [
                    'configurationError' => false,
                    'configurationFileHostName' => GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY'),
                    'configurationFileDate' => date('Ymd'),
                    'configurationFileDateHumanReadable' => date('d/M/Y'),
                    'configurationFileDateTimestamp' => time(),
                    'configurationFileIdentifier' => $this->getConfigurationFileId($insecureExtensionsAndVersionCsv),
                    'extensionCountLastUpdated' => $lastUpdated,
                    'extensionCountInsecureExtensions' => count($insecureExtensionsAndVersionCsv),
                    'extensionCountInsecureVersions' => $insecureExtensions->count(),
                    'extensionlist' => $insecureExtensionsAndVersionCsv
                ]
            );
        } else {
            $this->view->assign('configurationError', true);
        }
        return $this->htmlResponse();
    }

    /**
     * Returns an array of extensions (key) and comma-separated-list of versions (value).
     */
    private function convertVersionsToCommaSeparatedValues(QueryResult $insecureExtensions): array
    {
        // init
        $extensionlist = [];

        foreach ($insecureExtensions as $uid => $extension) {
            $key = $extension->getExtensionKey();
            $title = $extension->getTitle();
            $version = $extension->getVersion();
            //$integerVersion = $extension->getIntegerVersion();
            $versionList = $version;

            if (array_key_exists($key, $extensionlist)) {
                $versionList = $extensionlist[$key]['versionList'] . ',' . $version;
            }

            $extensionlist[$key] = [
                'extensionKey' => $key,
                'title' => $title,
                'versionList' => $versionList
            ];
        }

        return $extensionlist;
    }

    /**
     * Returns a unique identification string based on the current list of insecure extensions.
     * For example: '54391-C872F-E1C8B-4F980'.
     */
    private function getConfigurationFileId(array $insecureExtensionsAndVersionCsv): string
    {
        $identificationString = '-';
        $identificationArray = str_split(substr(md5(serialize($insecureExtensionsAndVersionCsv)), 0, 20), 5);
        return strtoupper(implode('-', $identificationArray));
    }
}
