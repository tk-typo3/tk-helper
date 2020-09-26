<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright by Timon Kreis - All rights reserved
 * @license http://www.opensource.org/licenses/mit-license.html
 */
declare(strict_types = 1);

namespace TimonKreis\Typo3\Helper\Backend\ToolbarItems;

use TYPO3\CMS;

/**
 * @package TimonKreis\Typo3\Helper\Backend\ToolbarItems
 */
class GitRevision
{
    /**
     * @param CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem $item
     */
    public function addGitRevision(CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem $item) : void
    {
        CMS\Core\Utility\CommandUtility::exec('git --version', $_, $returnCode);

        // Check if Git is available
        if ((int)$returnCode !== 0) {
            return;
        }

        $revision = trim(CMS\Core\Utility\CommandUtility::exec('git rev-parse --short HEAD'));
        $branch = trim(CMS\Core\Utility\CommandUtility::exec('git rev-parse --abbrev-ref HEAD'));

        if ($revision && $branch) {
            $item->addSystemInformation(
                'LLL:EXT:tk_helper/Resources/Private/Language/locallang.xlf:GitRevision',
                sprintf('%s [%s]', $revision, $branch),
                'information-git'
            );
        }
    }
}
