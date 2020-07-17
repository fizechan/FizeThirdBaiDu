<?php

namespace fize\third\baidu\map\v4\geodata;

use fize\third\baidu\Map;


/**
 * 数据表操作接口
 *
 * 百度地图LBS云存储(V4)API接口
 */
class Geotable extends Map
{

    /**
     * 创建表
     * @param string $name         Geotable名称
     * @param int    $is_published 是否发布到检索 0:否;1是
     * @return int 新增的数据的id
     */
    public function create($name, $is_published = 1)
    {
        $data = [
            'name'         => $name,
            'is_published' => $is_published,
        ];
        return $this->httpPost("/geodata/v4/geotable/create", $data, 'id');
    }

    /**
     * 查询表
     * @param string $name 查询表名左匹配字符串
     * @return array 返回表列表
     */
    public function list($name = '')
    {
        $data = ['name' => $name];
        return $this->httpGet("/geodata/v4/geotable/list", $data, ['size', 'geotables']);
    }

    /**
     * 查询指定id表
     * @param int $id 指定geotable的id
     * @return array 返回表信息数组
     */
    public function detail($id)
    {
        $data = ['id' => $id];
        return $this->httpGet("/geodata/v4/geotable/detail", $data, 'geotable');
    }

    /**
     * 修改表
     * @param int    $id           指定要修改的geotable主键
     * @param int    $is_published 修改是否发布到检索，会引起批量操作，只支持0->1，默认null表示不进行is_published修改
     * @param string $name         指定修改的表名，默认null表示不进行name修改
     * @return array 返回表信息数组
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
        return $this->httpPost("/geodata/v4/geotable/update", $data, ['status', 'id']);
    }

    /**
     * 删除表,当geotable里面没有有效数据时，才能删除geotable
     * @param int $id 指定要删除的geotable主键
     * @return bool 删除成功返回true，否则返回false
     */
    public function delete($id)
    {
        $data = ['id' => $id];
        $rst = $this->httpPost("/geodata/v4/geotable/delete", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }
}
