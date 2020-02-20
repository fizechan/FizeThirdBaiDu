<?php

namespace map\v3;

use fize\third\baidu\map\v3\Geosearch;
use PHPUnit\Framework\TestCase;

class TestGeosearch extends TestCase
{

    public function testNearby()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geosearch = new Geosearch($ak, $sk);

        $geotable_id = '163461';
        $location = '114.178956,22.269999';
        $result = $geosearch->nearby($geotable_id, $location);
        var_dump($geosearch->errMsg);
        var_dump($result);
    }

    public function testBound()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geosearch = new Geosearch($ak, $sk);

        $geotable_id = '163461';
        $bounds = '113.178956,21.269999;115.178956,23.269999';
        $result = $geosearch->bound($geotable_id, $bounds, '');
        var_dump($geosearch->errMsg);
        var_dump($result);
    }

    public function testLocal()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geosearch = new Geosearch($ak, $sk);

        $geotable_id = '163461';
        $q = '博物馆';
        $result = $geosearch->local($geotable_id, $q);
        var_dump($geosearch->errMsg);
        var_dump($result);
    }

    public function testDetail()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geosearch = new Geosearch($ak, $sk);

        $geotable_id = '163461';
        $uid = '2014103527';
        $result = $geosearch->detail($geotable_id, $uid);
        var_dump($geosearch->errMsg);
        var_dump($result);
    }
}
