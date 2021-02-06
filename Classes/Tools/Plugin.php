<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright by Timon Kreis - All rights reserved
 * @license http://www.opensource.org/licenses/mit-license.html
 */
declare(strict_types = 1);

namespace TimonKreis\TkHelper\Tools;

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * @package TimonKreis\TkHelper\Tools
 */
class Plugin
{
    /**
     * Register plugin
     *
     * @param string $extensionKey
     * @param string $extensionName
     * @param string $pluginName
     * @param string $icon
     * @param array $controllerActions
     * @param array $nonCacheableControllerActions
     */
    public static function registerPlugin(
        string $extensionKey,
        string $extensionName,
        string $pluginName,
        string $icon,
        array $controllerActions,
        array $nonCacheableControllerActions
    ) : void {
        $sanitizedExtensionKey = str_replace('_', '', strtolower($extensionKey));
        $sanitizedPluginName = strtolower($pluginName);

        ExtensionUtility::configurePlugin(
            $extensionName,
            $pluginName,
            $controllerActions,
            $nonCacheableControllerActions
        );

        $languagePrefix = 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/plugins.xlf:' . $pluginName . '.';

        ExtensionManagementUtility::addPageTSConfig(
            'mod.wizards.newContentElement.wizardItems.plugins {
                elements.' . $sanitizedPluginName . ' {
                    iconIdentifier = ' . $extensionKey . '-' . $sanitizedPluginName . '
                    title = ' . $languagePrefix . 'Name
                    description = ' . $languagePrefix . 'Description
                    tt_content_defValues {
                        CType = list
                        list_type = ' . $sanitizedExtensionKey . '_' . $sanitizedPluginName . '
                    }
                }
                show = *
            }'
        );

        /** @var IconRegistry $iconRegistry */
        $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);

        $iconRegistry->registerIcon(
            $extensionKey . '-' . $sanitizedPluginName,
            SvgIconProvider::class,
            ['source' => 'EXT:' . $extensionKey . '/Resources/Public/Icons/' . $icon . '.svg']
        );
    }
}
