<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright by Timon Kreis - All rights reserved
 * @license http://www.opensource.org/licenses/mit-license.html
 */
declare(strict_types = 1);

namespace TimonKreis\Typo3\Helper\EventListener;

use TYPO3\CMS;
use TimonKreis\Typo3\Helper;

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
        /** @var Helper\Backend\ToolbarItems\GitRevision $gitRevision */
        $gitRevision = CMS\Core\Utility\GeneralUtility::makeInstance(Helper\Backend\ToolbarItems\GitRevision::class);
        $gitRevision->addGitRevision($event->getToolbarItem());
    }
}
