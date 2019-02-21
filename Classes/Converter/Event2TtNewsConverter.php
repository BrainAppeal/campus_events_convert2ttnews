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

namespace BrainAppeal\CampusEventsConvert2Ttnews\Converter;

class Event2TtNewsConverter extends \BrainAppeal\CampusEventsConnector\Converter\AbstractEventToObjectConverter
{
    /**
     * @var TemplateEngine
     */
    private $templateEngine;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    private $objectManager;

    /**
     * @return TemplateEngine
     */
    private function getTemplateEngine()
    {
        if (null === $this->templateEngine) {
            $this->templateEngine = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TemplateEngine::class);
        }

        return $this->templateEngine;
    }

    /**
     * @return string
     */
    protected function getObjectRepositoryClass()
    {
       return \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Repository\TtNewsRepository::class;
    }

    /**
     * @param \BrainAppeal\CampusEventsConnector\Domain\Repository\EventRepository $eventRepository
     * @param \BrainAppeal\CampusEventsConnector\Domain\Model\ConvertConfiguration $configuration
     * @return \BrainAppeal\CampusEventsConnector\Domain\Model\Event[]
     */
    protected function getMatchingEventsByConfiguration($eventRepository, $configuration)
    {
        return $eventRepository->findAllByPid($configuration->getPid());
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
     * @param string $property
     * @return string
     */
    private function copyFalToUploads(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference, $property)
    {
        $file = $fileReference->getOriginalResource()->getOriginalFile();

        $filename = $file->getName();
        $source = PATH_site . $file->getPublicUrl();
        $destination = PATH_site . $GLOBALS['TCA']['tt_news']['columns'][$property]['config']['uploadfolder'].DIRECTORY_SEPARATOR.$filename;
        copy($source, $destination);

        return $filename;
    }

    /**
     * @param string $html
     * @return string
     */
    private function html2text($html)
    {
        return html_entity_decode(strip_tags($html));
    }

    /**
     * @param \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\TtNews $object
     * @param \BrainAppeal\CampusEventsConnector\Domain\Model\Event $event
     * @param \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\Convert2TtNewsConfiguration $configuration
     * @api Use this method to individualize your object
     */
    protected function individualizeObjectByEvent(&$object, $event, $configuration)
    {
        $templateEngine = $this->getTemplateEngine();

        $object->setType($configuration->getTtnewsType());
        $object->setTitle($event->getName());
        $object->setBodytext($templateEngine->getFromTemplate($configuration, 'Bodytext', ['event' => $event]));
        $object->setShort($event->getShortDescription());
        $object->setDatetime($event->getStartDate()->getTimestamp());
        $object->setArchivedate($event->getEndDate()->getTimestamp());
        $object->setExternalUrl($event->getUrl());

        if ($configuration->getTtnewsType() == 2) {
            if (empty($event->getShortDescription())) {
                $object->setShort($this->html2text($event->getDescription()));
            }
        }

        $object->setImages('');
        /** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $image */
        foreach ($event->getImages() as $image) {
            $object->addImage($this->copyFalToUploads($image, 'image'));
        }


        $object->setNewsFiles('');
        /** @var \GeorgRinger\News\Domain\Model\FileReference $attachment */
        foreach ($event->getAttachments() as $attachment) {
            $object->addNewsFile($this->copyFalToUploads($attachment, 'media_files'));
        }
    }
}
