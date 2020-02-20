<?php

namespace map\v2;

use fize\third\baidu\map\v2\Geocoder;
use PHPUnit\Framework\TestCase;

class TestGeocoder extends TestCase
{

    public function testEncode()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geocoder = new Geocoder($ak, $sk);

        $address = '软件园二期';
        $city = '厦门';
        $result = $geocoder->encode($address, $city);
        var_dump($result);
        var_dump($geocoder->errMsg);
        var_dump($geocoder->errCode);
    }

    public function testDecode()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geocoder = new Geocoder($ak, $sk);

        $location = '24.489894054258,118.18747373356';
        $result = $geocoder->decode($location);
        var_dump($result);
        var_dump($geocoder->errMsg);
        var_dump($geocoder->errCode);
    }
}
