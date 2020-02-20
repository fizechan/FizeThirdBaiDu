<?php

namespace map\v1;

use fize\third\baidu\map\v1\Geocoder;
use PHPUnit\Framework\TestCase;

class TestGeocoder extends TestCase
{

    public function testCloudgc()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geocoder = new Geocoder($ak, $sk);

        $q = '博物馆';
        $geotable_id = '163461';
        $result = $geocoder->cloudgc($q, null, $geotable_id);
        var_dump($geocoder->errMsg);
        var_dump($result);
    }

    public function testCloudrgc()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geocoder = new Geocoder($ak, $sk);

        $geotable_id = '163461';
        $location = '22.270,114.179';
        $result = $geocoder->cloudrgc($location, $geotable_id, null, 'bd09ll');
        var_dump($geocoder->errMsg);
        var_dump($result);
    }
}
