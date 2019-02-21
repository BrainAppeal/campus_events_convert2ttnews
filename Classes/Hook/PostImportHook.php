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

namespace BrainAppeal\CampusEventsConvert2Ttnews\Hook;

class PostImportHook
{

    /**
     * @return \BrainAppeal\CampusEventsConnector\Converter\EventConverterInterface
     */
    private function getConverter()
    {
        /** @var \BrainAppeal\CampusEventsConnector\Converter\EventConverterInterface $converter */
        $converter = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\BrainAppeal\CampusEventsConvert2Ttnews\Converter\Event2TtNewsConverter::class);

        return $converter;
    }

    /**
     * @param int $pid
     * @return \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\Convert2TtNewsConfiguration[]
     */
    private function findConfigurationsByPid($pid)
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        /** @var \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Repository\Convert2TtNewsConfigurationRepository $configurationRepository */
        $configurationRepository = $objectManager->get(\BrainAppeal\CampusEventsConvert2Ttnews\Domain\Repository\Convert2TtNewsConfigurationRepository::class);

        return $configurationRepository->findActiveByPid($pid);
    }

    /**
     * @param int $pid
     * @return bool
     */
    public function postImport($pid) {
        $configurations = $this->findConfigurationsByPid($pid);

        if (count($configurations)) {
            $converter = $this->getConverter();

            foreach ($configurations as $configuration) {
                $converter->run($configuration);
            }
        }

        return true;
    }
}
