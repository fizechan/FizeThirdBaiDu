<?php

namespace yingyan\v3;

use fize\third\baidu\yingyan\v3\Entity;
use PHPUnit\Framework\TestCase;

class TestEntity extends TestCase
{

    public function testAdd()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);

        $rst = $entity->add('134974', '闽D1007U222');
        var_dump($entity->errMsg);
        var_dump($rst);
    }

    public function testUpdate()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);

        $rst = $entity->update('134974', '闽D1007U', '陈峰展名下小型汽车');
        var_dump($entity->errMsg);
        var_dump($rst);
    }

    public function testDelete()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);

        $rst = $entity->delete('134974', '闽D1007U222');
        var_dump($entity->errMsg);
        var_dump($rst);
    }

    public function testList()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);

        $rst = $entity->list('134974');
        var_dump($entity->errMsg);
        var_dump($rst);
    }

    public function testSearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);

        $rst = $entity->search('134974', '闽D');
        var_dump($entity->errMsg);
        var_dump($rst);
    }

    public function testPolygonsearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);
    }

    public function testAroundsearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);
    }

    public function testBoundsearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);
    }

    public function testDistrictsearch()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $entity = new Entity($ak, $sk);
    }
}
