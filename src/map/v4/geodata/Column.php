<?php
/*
 * 百度地图LBS云存储(V4)API接口
 */


namespace fize\third\baidu\map\v4\geodata;


use fize\third\baidu\map\Api;


/**
 * 数据列操作接口
 * @author Fize
 */
class Column extends Api
{


    /**
     * 创建列
     * @param int $geotable_id 所属于的geotable_id
     * @param string $name 属性中文名称
     * @param string $key 属性key
     * @param int $type 枚举值 1： Int64, 2:double, 3,string，4，在线图片url
     * @param int $is_search_field 是否检索引擎的文本检索字段 1,代表支持，0为不支持。只有string可以设置
     * @param int $is_index_field 是否存储引擎的索引字段 1,代表支持，0为不支持。
     * @return int 新增的数据的id，错误时返回false
     */
    public function create($geotable_id, $name, $key, $type, $is_search_field, $is_index_field)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'name' => $name,
            'key' => $key,
            'type' => $type,
            'is_search_field' => $is_search_field,
            'is_index_field' => $is_index_field
        ];
        return $this->httpPost("/geodata/v4/column/create", $data, 'id');
    }

    /**
     * 查询表,返回自定义列信息
     * @param int $geotable_id
     * @param string $name 查询表名左匹配字符串
     * @param string $key
     * @return array 成功返回表列表，错误时返回false
     */
    public function lists($geotable_id, $name = '', $key = '')
    {
        $data = [
            'geotable_id' => $geotable_id,
            'name' => $name,
            'key' => $key
        ];
        return $this->httpGet("/geodata/v4/column/list", $data, ['size', 'columns']);
    }

    /**
     * 查询指定id列属性
     * @param int $geotable_id 指定表的id
     * @param int $id 指定列的id
     * @return array 成功时返回列信息数组，错误返回false
     */
    public function detail($geotable_id, $id)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'id' => $id
        ];
        return $this->httpGet("/geodata/v4/column/detail", $data, 'column');
    }

    /**
     * 修改指定条件列
     * @param int $geotable_id 所属表主键
     * @param int $id 列主键
     * @param string $name 属性中文名称
     * @param int $is_search_field 是否检索引擎的文本检索字段
     * @param int $is_index_field 是否存储引擎的索引字段
     * @return boolean 修改成功返回true，否则返回false
     */
    public function update($geotable_id, $id, $name = null, $is_search_field = null, $is_index_field = null)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'id' => $id
        ];
        if (!is_null($name)) { //进行属性中文名称修改
            $data['name'] = $name;
        }
        if (!is_null($is_search_field)) { //进行是否检索引擎的文本检索字段修改
            $data['is_search_field'] = $is_search_field;
        }
        if (!is_null($is_index_field)) { //进行是否存储引擎的索引字段修改
            $data['is_index_field'] = $is_index_field;
        }
        $rst = $this->httpPost("/geodata/v4/column/update", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除指定条件列
     * @param int $geotable_id 指定要删除的geotable主键
     * @param int $id 列ID
     * @return boolean 删除成功返回true，否则返回false
     */
    public function delete($geotable_id, $id)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'id' => $id
        ];
        $rst = $this->httpPost("/geodata/v4/column/delete", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }
}