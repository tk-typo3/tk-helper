<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright by Timon Kreis - All rights reserved
 */
declare(strict_types = 1);

namespace TimonKreis\Typo3\Helper\EventListener;

use TYPO3\CMS;

/**
 * @package TimonKreis\Typo3\Helper\EventListener
 */
class SystemInformationToolbar
{
    /**
     * @param CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent $event
     */
    public function __invoke(CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent $event) : void
    {
        CMS\Core\Utility\CommandUtility::exec('git --version', $_, $returnCode);

        // Check if Git is available
        if ((int)$returnCode !== 0) {
            return;
        }

        $revision = trim(CMS\Core\Utility\CommandUtility::exec('git rev-parse --short HEAD'));
        $branch = trim(CMS\Core\Utility\CommandUtility::exec('git rev-parse --abbrev-ref HEAD'));

        if ($revision && $branch) {
            $event->getToolbarItem()->addSystemInformation(
                'LLL:EXT:tk_helper/Resources/Private/Language/locallang.xlf:GitRevision',
                sprintf('%s [%s]', $revision, $branch),
                'information-git'
            );
        }
    }
}
