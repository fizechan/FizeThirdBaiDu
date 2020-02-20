<?php

namespace map;

use fize\third\baidu\map\Location;
use PHPUnit\Framework\TestCase;

class TestLocation extends TestCase
{

    public function testIp()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $location = new Location($ak, $sk);

        $result = $location->ip();
        var_dump($result);
        var_dump($location->errMsg);
        var_dump($location->errCode);
    }
}
