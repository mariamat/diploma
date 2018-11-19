<?php

namespace app\components\helpers;

class Time {

    const ONE_SECOND_IN_MS = 1000;
    const ONE_DAY_INTERVAL_SEC = 86400;
    const ONE_DAY_INTERVAL_MS = self::ONE_DAY_INTERVAL_SEC * 1000;

    public static function getTimeForMongoDbTimestamp() {
        // Return mongo db time in UTS ISO date
        return new \MongoDB\BSON\UTCDateTime((new \DateTime())->getTimestamp() * 1000);
    }

}