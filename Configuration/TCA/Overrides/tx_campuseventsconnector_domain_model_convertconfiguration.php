<?php
/**
 * campus_events_convert2ttnews comes with ABSOLUTELY NO WARRANTY
 * See the GNU GeneralPublic License for more details.
 * https://www.gnu.org/licenses/gpl-2.0
 *
 * Copyright (C) 2019 Brain Appeal GmbH
 *
 * @copyright 2019 Brain Appeal GmbH (www.brain-appeal.com)
 * @license   GPL-2 (www.gnu.org/licenses/gpl-2.0)
 * @link      https://www.campus-events.com/
 */

defined('TYPO3_MODE') or die();

$convertconfiguration = [
    'ctrl' => [
        'typeicon_classes' => [
            2 => 'ext-convertconfiguration-type-ttnews',
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, target_pid, ttnews_type, template_path, target_groups, filter_categories',
    ],
    'types' => [
        2 => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, target_pid, ttnews_type, template_path, target_groups, filter_categories --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'type' => [
            'config' => [
                'items' => [
                    2 => ['LLL:EXT:campus_events_convert2ttnews/Resources/Private/Language/locallang_db.xlf:tx_campuseventsconnector_domain_model_convertconfiguration.convert2ttnews', 2, 'ext-convertconfiguration-type-ttnews']
                ]
            ]
        ],
    ],
];

$GLOBALS['TCA']['tx_campuseventsconnector_domain_model_convertconfiguration'] = array_replace_recursive(
    $GLOBALS['TCA']['tx_campuseventsconnector_domain_model_convertconfiguration'], $convertconfiguration
);


$additionalFields = [
    'ttnews_type' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:campus_events_convert2ttnews/Resources/Private/Language/locallang_db.xlf:tx_campuseventsconnector_domain_model_convertconfiguration.ttnews_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:tt_news/Resources/Private/Language/locallang_tca.xml:tt_news.type.I.0', 0, 'EXT:tt_news/res/gfx/ext_icon.gif'],
//                ['LLL:EXT:tt_news/Resources/Private/Language/locallang_tca.xml:tt_news.type.I.1', 1, 'EXT:tt_news/res/gfx/tt_news_article.gif'],
                ['LLL:EXT:tt_news/Resources/Private/Language/locallang_tca.xml:tt_news.type.I.2', 2, 'EXT:tt_news/res/gfx/tt_news_exturl.gif'],
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_campuseventsconnector_domain_model_convertconfiguration',
    $additionalFields,
    true
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tx_campuseventsconnector_domain_model_convertconfiguration',
    'general',
    'ttnews_type',
    'after:target_pid'
);
