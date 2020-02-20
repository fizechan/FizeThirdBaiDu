<?php

namespace map\v4\geodata;

use fize\third\baidu\map\v4\geodata\Poi;
use PHPUnit\Framework\TestCase;

class TestPoi extends TestCase
{

    public function testCreate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $latitude = 24.514668;
        $longitude = 117.645733;
        $coord_type = 3;
        $title = '闽南师范大学达理公寓';
        $address = '前直街360号';
        $tags = '学校 大学 公寓';
        $id = $poi->create($geotable_id, $latitude, $longitude, $coord_type, $title, $address, $tags);
        var_dump($id);
    }

    public function testList()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $coord_type = 3;
        $list = $poi->list($geotable_id, $coord_type);
        var_dump($list);
    }

    public function testDetail()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $column = $poi->detail($geotable_id, $id);
        var_dump($column);
    }

    public function testUpdate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $result = $poi->update($geotable_id, $id, '达理公寓');
        var_dump($result);
    }

    public function testDelete()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $result = $poi->delete($geotable_id, $id);
        var_dump($result);
    }

    public function testUpload()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $poi = new Poi($ak, $sk);

        $geotable_id = '1000003168';
        $file = 'H:\baidu.csv';
        $result = $poi->upload($geotable_id, $file);
        var_dump($poi->errMsg);
        var_dump($result);
    }
}
