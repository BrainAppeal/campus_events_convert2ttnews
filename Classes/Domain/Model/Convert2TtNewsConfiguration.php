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

namespace BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model;

/**
 * Convert2TtNewsConfiguration
 */
class Convert2TtNewsConfiguration extends \BrainAppeal\CampusEventsConnector\Domain\Model\ConvertConfiguration
{

    /**
     * @var int
     */
    protected $ttnewsType;

    /**
     * @return int
     */
    public function getTtnewsType()
    {
        return $this->ttnewsType;
    }

    /**
     * @param int $ttnewsType
     */
    public function setTtnewsType($ttnewsType)
    {
        $this->ttnewsType = $ttnewsType;
    }

}
