<?php

namespace map\v4\geodata;

use fize\third\baidu\map\v4\geodata\Job;
use PHPUnit\Framework\TestCase;

class TestJob extends TestCase
{

    public function testLists()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $job = new Job($ak, $sk);

        $geotable_id = '1000003168';
        //$job_id = '962611269125308068';
        $job_id = null;
        $list = $job->list($geotable_id, $job_id);
        var_dump($job->errMsg);
        var_dump($list);
    }
}
