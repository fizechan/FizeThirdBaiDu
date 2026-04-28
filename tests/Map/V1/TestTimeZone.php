<?php

namespace Map\V1;

use Fize\Third\BaiDu\Map\V1\TimeZone;
use PHPUnit\Framework\TestCase;

class TestTimeZone extends TestCase
{

    public function testTimezone()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $timezone = new TimeZone($ak, $sk);

        $location = '24.489894054258,118.18747373356';
        $result = $timezone->timezone($location);
        var_dump($result);
        var_dump($timezone->errMsg);
        var_dump($timezone->errCode);
    }
}