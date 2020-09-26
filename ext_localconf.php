<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright 2020 Timon Kreis
 * @license http://www.opensource.org/licenses/mit-license.html
 */
defined('TYPO3_MODE') || die('Access denied.');

// Toolbar item for Typo3 v9
call_user_func(function() {
    if (TYPO3_MODE === 'BE'
        && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)
        && version_compare(TYPO3_branch, '9.99', '<=')
    ) {
        TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class)->connect(
            TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem::class,
            'getSystemInformation',
            TimonKreis\Typo3\Helper\Backend\ToolbarItems\GitRevision::class,
            'addGitRevision'
        );
    }
});
