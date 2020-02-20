<?php

namespace fize\third\baidu\yingyan\v3;

use fize\third\baidu\YingYan;

/**
 * 终端管理
 */
class Entity extends YingYan
{
    /**
     * 添加
     * @param int $service_id service的ID
     * @param string $entity_name entity名称，作为其唯一标识
     * @param mixed $entity_desc entity 可读性描述
     * @param array $column 开发者自定义字段
     * @return bool
     */
    public function add($service_id, $entity_name, $entity_desc = null, array $column = [])
    {
        $data = [
            'service_id'  => $service_id,
            'entity_name' => $entity_name,
        ];
        if (!empty($entity_desc)) {
            $data['entity_desc'] = $entity_desc;
        }
        if (!empty($column)) {
            $data = array_merge($data, $column);
        }
        $rst = $this->httpPost("/api/v3/entity/add", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新
     * @param int $service_id service的ID
     * @param string $entity_name entity名称，作为其唯一标识
     * @param mixed $entity_desc entity 可读性描述
     * @param array $column 开发者自定义字段
     * @return bool
     */
    public function update($service_id, $entity_name, $entity_desc = null, array $column = [])
    {
        $data = [
            'service_id'  => $service_id,
            'entity_name' => $entity_name,
        ];
        if (!empty($entity_desc)) {
            $data['entity_desc'] = $entity_desc;
        }
        if (!empty($column)) {
            $data = array_merge($data, $column);
        }
        $rst = $this->httpPost("/api/v3/entity/update", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除
     * @param int $service_id service的ID
     * @param string $entity_name entity名称，作为其唯一标识
     * @return bool
     */
    public function delete($service_id, $entity_name)
    {
        $data = [
            'service_id'  => $service_id,
            'entity_name' => $entity_name,
        ];
        $rst = $this->httpPost("/api/v3/entity/delete", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 查询
     * @param int $service_id service的ID
     * @param array $filter 搜索条件
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function list($service_id, array $filter = [], $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/list", $data, ['total', 'size', 'entities']);
    }

    /**
     * 关键字搜索
     * @param int $service_id service的ID
     * @param string $query 搜索关键字
     * @param array $filter 过滤条件
     * @param string $sortby 排序方法
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function search($service_id, $query = '', array $filter = [], $sortby = 'entity_name:asc', $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'query'             => $query,
            'sortby'            => $sortby,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/search", $data, ['total', 'size', 'entities']);
    }

    /**
     * 矩形范围搜索
     * @param int $service_id service的ID
     * @param string $bounds 矩形区域,坐标点顺序为"左下;右上"，坐标对间使用;号分隔，格式为：纬度,经度;纬度,经度
     * @param array $filter 过滤条件
     * @param string $sortby 排序方法
     * @param string $coord_type_input 请求参数 bounds 的坐标类型
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function boundsearch($service_id, $bounds, array $filter = [], $sortby = 'entity_name:asc', $coord_type_input = 'bd09ll', $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'bounds'            => $bounds,
            'sortby'            => $sortby,
            'coord_type_input'  => $coord_type_input,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/boundsearch", $data, ['total', 'size', 'entities']);
    }

    /**
     * 周边搜索
     * @param int $service_id service的ID
     * @param string $center 中心点经纬度。格式为：纬度,经度
     * @param int $radius 搜索半径，单位：米
     * @param array $filter 过滤条件
     * @param string $sortby 排序方法
     * @param string $coord_type_input 请求参数 $center 的坐标类型
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function aroundsearch($service_id, $center, $radius, array $filter = [], $sortby = 'entity_name:asc', $coord_type_input = 'bd09ll', $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'center'            => $center,
            'radius'            => $radius,
            'sortby'            => $sortby,
            'coord_type_input'  => $coord_type_input,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/aroundsearch", $data, ['total', 'size', 'entities']);
    }

    /**
     * 多边形搜索
     * @param int $service_id service的ID
     * @param string $vertexes 多边形边界点,规则： 经纬度顺序为：纬度,经度；
     * @param array $filter 过滤条件
     * @param string $sortby 排序方法
     * @param string $coord_type_input 请求参数 $center 的坐标类型
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function polygonsearch($service_id, $vertexes, array $filter = [], $sortby = 'entity_name:asc', $coord_type_input = 'bd09ll', $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'vertexes'          => $vertexes,
            'sortby'            => $sortby,
            'coord_type_input'  => $coord_type_input,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/polygonsearch", $data, ['total', 'size', 'entities']);
    }

    /**
     * 行政区搜索
     * @param int $service_id service的ID
     * @param string $keyword 行政区划关键字
     * @param array $filter 过滤条件
     * @param string $sortby 排序方法
     * @param string $return_type 设置返回值的内容
     * @param string $coord_type_output 返回结果的坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function districtsearch($service_id, $keyword, array $filter = [], $sortby = 'entity_name:asc', $return_type = 'all', $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id'        => $service_id,
            'keyword'           => $keyword,
            'sortby'            => $sortby,
            'return_type'       => $return_type,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        return $this->httpGet("/api/v3/entity/districtsearch", $data, ['total', 'size', 'entities', 'district_list']);
    }
}
