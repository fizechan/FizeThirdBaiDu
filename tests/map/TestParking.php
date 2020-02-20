<?php

namespace map;

use fize\third\baidu\map\Parking;
use PHPUnit\Framework\TestCase;

class TestParking extends TestCase
{

    public function testSearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $parking = new Parking($ak, $sk);

        $location = '24.489894054258,118.18747373356';
        $location = '118.18747373356,24.489894054258';
        $result = $parking->search($location);
        var_dump($result);
        var_dump($parking->errMsg);
        var_dump($parking->errCode);
    }
}
