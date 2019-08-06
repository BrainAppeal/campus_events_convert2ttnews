<?php
namespace BrainAppeal\CampusEventsConvert2Ttnews\Updates;

use BrainAppeal\CampusEventsConvert2Ttnews\Service\UpdateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use BrainAppeal\CampusEventsConnector\Updates\ImportFieldNamesUpdateWizard as BaseImportFieldNamesUpdateWizard;

class ImportFieldNamesUpdateWizard extends BaseImportFieldNamesUpdateWizard
{

    public function __construct()
    {
        $this->updateService = GeneralUtility::makeInstance(UpdateService::class);
    }

}
