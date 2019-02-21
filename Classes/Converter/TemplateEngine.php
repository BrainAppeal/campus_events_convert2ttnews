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



class TemplateEngine extends \BrainAppeal\CampusEventsConnector\Utility\TemplateEngine
{

    /**
     * @param \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\Convert2TtNewsConfiguration $configuration
     * @param string $templateName
     * @return string[]
     */
    protected function getTemplateRootPaths($configuration, $templateName)
    {
        return [
            0 => 'EXT:campus_events_convert2ttnews/Resources/Private/Layouts/',
            1 => $configuration->getTemplatePath(),
        ];
    }
}
