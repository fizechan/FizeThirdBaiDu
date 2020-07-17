<?php

namespace fize\third\baidu\map\v3\geodata;

use fize\third\baidu\Map;


/**
 * 数据列操作接口
 *
 * 百度地图LBS云存储API接口
 */
class Column extends Map
{


    /**
     * 创建列
     * @param int    $geotable_id         所属于的geotable_id
     * @param string $name                属性中文名称
     * @param string $key                 属性key
     * @param int    $type                枚举值 1： Int64, 2:double, 3,string，4，在线图片url
     * @param int    $max_length          最大长度 最大值2048，最小值为1，针对string有效
     * @param mixed  $default_value       默认值
     * @param int    $is_sortfilter_field 是否检索引擎的数值排序筛选字段,1代表是，0代表否。
     * @param int    $is_search_field     是否检索引擎的文本检索字段 1,代表支持，0为不支持。只有string可以设置
     * @param int    $is_index_field      是否存储引擎的索引字段 1,代表支持，0为不支持。
     * @param int    $is_unique_field     是否云存储唯一索引字段 1代表支持 ，0为不支持
     * @return int 新增的数据的id
     */
    public function create($geotable_id, $name, $key, $type, $max_length, $default_value, $is_sortfilter_field, $is_search_field, $is_index_field, $is_unique_field = 0)
    {

        if ($type != 3) { //参数max_length仅对type为string时有效
            $max_length = 0;
        }

        if ($type != 1 && $type != 2) { //只有int或者double类型可以设置
            $is_sortfilter_field = 0;
        }

        if ($type != 3 || $max_length > 512) { //检索字段只能用于字符串类型的列且最大长度不能超过512个字节
            $is_search_field = 0;
        }

        $data = [
            'name'                => $name,
            'key'                 => $key,
            'type'                => $type,
            'max_length'          => $max_length,
            'default_value'       => $default_value,
            'is_sortfilter_field' => $is_sortfilter_field,
            'is_search_field'     => $is_search_field,
            'is_index_field'      => $is_index_field,
            'is_unique_field'     => $is_unique_field,
            'geotable_id'         => $geotable_id
        ];

        return $this->httpPost("/geodata/v3/column/create", $data, 'id');
    }

    /**
     * 查询表,返回自定义列信息
     * @param int    $geotable_id
     * @param string $name 查询表名左匹配字符串
     * @param string $key
     * @return array
     */
    public function lists($geotable_id, $name = '', $key = '')
    {
        $data = [
            'geotable_id' => $geotable_id,
            'name'        => $name,
            'key'         => $key
        ];

        return $this->httpGet("/geodata/v3/column/list", $data, 'columns');
    }

    /**
     * 查询指定id表
     * @param int $geotable_id 指定表的id
     * @param int $id          指定列的id
     * @return array 返回表信息数组
     */
    public function detail($geotable_id, $id)
    {

        $data = [
            'geotable_id' => $geotable_id,
            'id'          => $id
        ];

        return $this->httpGet("/geodata/v3/column/detail", $data, 'column');
    }

    /**
     * 修改指定条件列
     * @param int    $geotable_id         所属表主键
     * @param int    $id                  列主键
     * @param string $name                属性中文名称
     * @param mixed  $default_value       默认值
     * @param int    $max_length          字符串最大长度。只能改大，不能改小
     * @param int    $is_sortfilter_field 是否检索引擎的数值排序字段
     * @param int    $is_search_field     是否检索引擎的文本检索字段
     * @param int    $is_index_field      是否存储引擎的索引字段
     * @param int    $is_unique_field     是否存储索引的唯一索引字段
     * @return bool 修改成功返回true，否则返回false
     */
    public function update($geotable_id, $id, $name = null, $default_value = null, $max_length = null, $is_sortfilter_field = null, $is_search_field = null, $is_index_field = null, $is_unique_field = null)
    {

        $data = [
            'geotable_id' => $geotable_id,
            'id'          => $id
        ];

        if (!is_null($name)) { //进行属性中文名称修改
            $data['name'] = $name;
        }
        if (!is_null($default_value)) { //进行默认值进行修改
            $data['default_value'] = $default_value;
        }
        if (!is_null($max_length)) { //进行字符串最大长度修改，只能改大，不能改小
            $data['max_length'] = $max_length;
        }
        if (!is_null($is_sortfilter_field)) { //进行是否检索引擎的数值排序修改 ， 可能会引起批量操作
            $data['is_sortfilter_field'] = $is_sortfilter_field;
        }
        if (!is_null($is_search_field)) { //进行是否检索引擎的文本检索字段修改
            $data['is_search_field'] = $is_search_field;
        }
        if (!is_null($is_index_field)) { //进行是否存储引擎的索引字段修改
            $data['is_index_field'] = $is_index_field;
        }
        if (!is_null($is_unique_field)) { //进行是否存储索引的唯一索引字段修改
            $data['is_unique_field'] = $is_unique_field;
        }

        $rst = $this->httpPost("/geodata/v3/column/update", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除指定条件列
     * @param int $geotable_id 指定要删除的geotable主键
     * @param int $id          列ID
     * @return boolean 删除成功返回true，否则返回false
     */
    public function delete($geotable_id, $id)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'id'          => $id
        ];
        $rst = $this->httpPost("/geodata/v3/column/delete", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }
}
