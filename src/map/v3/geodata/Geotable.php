<?php

namespace fize\third\baidu\map\v3\geodata;

use fize\third\baidu\Map;


/**
 * 数据表操作接口
 *
 * 百度地图LBS云存储API接口
 */
class Geotable extends Map
{

    /**
     * 创建表
     * @param string $name Geotable名称
     * @param int $geotype 数据的类型 1：点poi,2：线poi,3：面poi，默认为1
     * @param int $is_published 是否发布到检索 0:否;1是
     * @param int $timestamp 时间戳
     * @return int 新增的数据的id，错误时返回false
     */
    public function create($name, $geotype = 1, $is_published = 1, $timestamp = null)
    {
        if (is_null($timestamp)) {
            $timestamp = time();
        }

        $data = [
            'name'         => $name,
            'geotype'      => $geotype,
            'is_published' => $is_published,
            'timestamp'    => $timestamp,
        ];

        return $this->httpPost("/geodata/v3/geotable/create", $data, 'id');
    }

    /**
     * 查询表
     * @param string $name 查询表名左匹配字符串
     * @return array 成功返回表列表，错误时返回false
     */
    public function lists($name = '')
    {

        $data = ['name' => $name];

        return $this->httpGet("/geodata/v3/geotable/list", $data, 'geotables');
    }

    /**
     * 查询指定id表
     * @param int $id 指定geotable的id
     * @return array 成功时返回表信息数组，错误返回false
     */
    public function detail($id)
    {

        $data = ['id' => $id];

        return $this->httpGet("/geodata/v3/geotable/detail", $data, 'geotable');
    }

    /**
     * 修改表
     * @param int $id 指定要修改的geotable主键
     * @param int $is_published 修改是否发布到检索，会引起批量操作，默认null表示不进行is_published修改
     * @param string $name 指定修改的表名，默认null表示不进行name修改
     * @return boolean 修改成功返回true，否则返回false
     */
    public function update($id, $is_published = null, $name = null)
    {

        $data = ['id' => $id];
        if (!is_null($is_published)) { //进行is_published修改，会引起批量操作
            $data['is_published'] = $is_published;
        }
        if (!is_null($name)) { //进行name进行修改
            $data['name'] = $name;
        }

        $rst = $this->httpPost("/geodata/v3/geotable/update", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除表,当geotable里面没有有效数据时，才能删除geotable
     * @param int $id 指定要删除的geotable主键
     * @return boolean 删除成功返回true，否则返回false
     */
    public function delete($id)
    {
        $data = ['id' => $id];
        $rst = $this->httpPost("/geodata/v3/geotable/delete", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }
}
