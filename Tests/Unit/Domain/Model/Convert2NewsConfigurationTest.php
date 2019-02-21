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

namespace BrainAppeal\CampusEventsConvert2Ttnews\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class Convert2NewsConfigurationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\Convert2TtNewsConfiguration
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \BrainAppeal\CampusEventsConvert2Ttnews\Domain\Model\Convert2TtNewsConfiguration();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTargetPidReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getTargetPid()
        );
    }

    /**
     * @test
     */
    public function setTargetPidForIntSetsTargetPid()
    {
        $this->subject->setTargetPid(12);

        self::assertAttributeEquals(
            12,
            'targetPid',
            $this->subject
        );
    }
}
