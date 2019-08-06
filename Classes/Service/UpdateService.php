<?php

namespace BrainAppeal\CampusEventsConvert2Ttnews\Service;

use BrainAppeal\CampusEventsConnector\Service\UpdateService as BaseUpdateService;


class UpdateService extends BaseUpdateService
{
    /** @var array $tables */
    protected $tables = [
        'tt_news',
    ];
}
