<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright by Timon Kreis - All rights reserved
 * @license http://www.opensource.org/licenses/mit-license.html
 */
declare(strict_types = 1);

namespace TimonKreis\Typo3\Helper\EventListener;

use TimonKreis\Typo3\Helper\Backend\ToolbarItems\GitRevision;
use TYPO3\CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @package TimonKreis\Typo3\Helper\EventListener
 */
class SystemInformationToolbar
{
    /**
     * @param SystemInformationToolbarCollectorEvent $event
     */
    public function __invoke(SystemInformationToolbarCollectorEvent $event) : void
    {
        /** @var GitRevision $gitRevision */
        $gitRevision = GeneralUtility::makeInstance(GitRevision::class);
        $gitRevision->addGitRevision($event->getToolbarItem());
    }
}
