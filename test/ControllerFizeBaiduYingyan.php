<?php

/*
 * 测试百度
 */

namespace app\controller;

use fize\third\baidu\yingyan\v3\Entity;


class ControllerFizeBaiduYingyan
{
    /**
     * @var Entity
     */
    private $entity;

    public function __construct()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $this->entity = new Entity($ak, $sk);
    }

    public function actionEntityAdd(){
        $rst = $this->entity->add('134974', '闽D1007U222');
        var_dump($this->entity->errMsg);
        var_dump($rst);
	}

    public function actionEntityUpdate(){
        $rst = $this->entity->update('134974', '闽D1007U', '陈峰展名下小型汽车');
        var_dump($this->entity->errMsg);
        var_dump($rst);
    }

    public function actionEntityDelete(){
        $rst = $this->entity->delete('134974', '闽D1007U222');
        var_dump($this->entity->errMsg);
        var_dump($rst);
    }

    public function actionEntityLists(){
        $rst = $this->entity->lists('134974');
        var_dump($this->entity->errMsg);
        var_dump($rst);
    }

    public function actionEntitySearch(){
        $rst = $this->entity->search('134974', '闽D');
        var_dump($this->entity->errMsg);
        var_dump($rst);
    }
}