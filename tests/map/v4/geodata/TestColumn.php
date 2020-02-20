<?php

namespace map\v4\geodata;

use fize\third\baidu\map\v4\geodata\Column;
use PHPUnit\Framework\TestCase;

class TestColumn extends TestCase
{

    public function testCreate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $column = new Column($ak, $sk);

        $geotable_id = '1000003168';
        $name = '店名';
        $key = 'name';
        $type = 3;
        $is_search_field = 1;
        $is_index_field = 1;
        $id = $column->create($geotable_id, $name, $key, $type, $is_search_field, $is_index_field);
        var_dump($id);
    }

    public function testList()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $column = new Column($ak, $sk);

        $geotable_id = '1000003168';
        $list = $column->list($geotable_id);
        var_dump($list);
    }

    public function testDetail()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $column = new Column($ak, $sk);

        $geotable_id = '1000003168';
        $id = '1000004112';
        $column = $column->detail($geotable_id, $id);
        var_dump($column);
    }

    public function testUpdate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $column = new Column($ak, $sk);

        $geotable_id = '1000003168';
        $id = '1000004112';
        $result = $column->update($geotable_id, $id, '好租客32');
        var_dump($result);
    }

    public function testDelete()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $column = new Column($ak, $sk);

        $geotable_id = '1000003168';
        $id = '1000004112';
        $geotables = $column->delete($geotable_id, $id);
        var_dump($geotables);
    }
}
