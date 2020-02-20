<?php

namespace map\v4\geodata;

use fize\third\baidu\map\v4\geodata\Geotable;
use PHPUnit\Framework\TestCase;

class TestGeotable extends TestCase
{

    public function testCreate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geotable = new Geotable($ak, $sk);
        $id = $geotable->create('好租客2');
        var_dump($id);
    }

    public function testList()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geotable = new Geotable($ak, $sk);
        $list = $geotable->list();
        var_dump($list);
    }

    public function testDetail()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geotable = new Geotable($ak, $sk);
        $id = '1000003167';
        $geotables = $geotable->detail($id);
        var_dump($geotables);
    }

    public function testUpdate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geotable = new Geotable($ak, $sk);
        $id = '1000003167';
        $result = $geotable->update($id, 1, '好租客32');
        var_dump($result);
    }

    public function testDelete()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $geotable = new Geotable($ak, $sk);

        $id = '1000003167';
        $geotables = $geotable->delete($id);
        var_dump($geotables);
    }
}
