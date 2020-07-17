<?php

namespace fize\third\baidu\map\v3;


use fize\third\baidu\Map;


/**
 * 批量操作任务查询接口
 *
 * 百度地图LBS云检索API接口
 */
class Geosearch extends Map
{

    /**
     * poi周边检索
     * @param int $geotable_id 表ID
     * @param string $location 逗号分隔的经纬度，格式维度,经度
     * @param string $q 检索关键字
     * @param int $page_index 分页索引，默认为0
     * @param int $page_size 分页数量，默认为10，最多为50
     * @param string $callback JS回调函数
     * @param int $coord_type 坐标系， 3代表百度经纬度坐标系统，4代表百度墨卡托系统
     * @param string $tags 检索标签
     * @param int $radius 检索半径，默认1000
     * @param string $sortby 排序字段，默认为按weight排序
     * @param string $filter 过滤条件
     * @return array
     */
    public function nearby($geotable_id, $location, $q = null, $page_index = null, $page_size = null, $callback = null, $coord_type = null, $tags = null, $radius = null, $sortby = null, $filter = null)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'location'    => $location,
        ];
        if (!is_null($q)) {
            $data['q'] = $q;
        }
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($tags)) {
            $data['tags'] = $tags;
        }
        if (!is_null($radius)) {
            $data['radius'] = $radius;
        }
        if (!is_null($sortby)) {
            $data['sortby'] = $sortby;
        }
        if (!is_null($filter)) {
            $data['filter'] = $filter;
        }
        if (!is_null($page_index)) {
            $data['page_index'] = $page_index;
        }
        if (!is_null($page_size)) {
            $data['page_size'] = $page_size;
        }
        if (!is_null($callback)) {
            $data['callback'] = $callback;
        }
        return $this->httpGet("/geosearch/v3/nearby", $data, ['size', 'total', 'contents']);
    }

    /**
     * poi矩形检索
     * @param int $geotable_id 表ID
     * @param string $bounds 矩形区域，左下角和右上角的经纬度坐标点。2个点用;号分隔
     * @param string $q 检索关键字
     * @param int $coord_type 坐标系，3代表百度经纬度坐标系统 4代表百度墨卡托系统
     * @param int $page_index 分页索引，默认0
     * @param int $page_size 分页数量，默认为10，最多为50
     * @param string $callback JS回调函数
     * @param string $tags 标签，空格分隔的多字符串
     * @param string $sortby 排序字段，默认为按weight排序
     * @param string $filter 过滤条件
     * @return array
     */
    public function bound($geotable_id, $bounds, $q, $coord_type = null, $page_index = null, $page_size = null, $callback = null, $tags = null, $sortby = null, $filter = null)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'bounds'      => $bounds,
            'q'           => $q,
        ];
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($tags)) {
            $data['tags'] = $tags;
        }
        if (!is_null($sortby)) {
            $data['sortby'] = $sortby;
        }
        if (!is_null($filter)) {
            $data['filter'] = $filter;
        }
        if (!is_null($page_index)) {
            $data['page_index'] = $page_index;
        }
        if (!is_null($page_size)) {
            $data['page_size'] = $page_size;
        }
        if (!is_null($callback)) {
            $data['callback'] = $callback;
        }
        return $this->httpGet("/geosearch/v3/bound", $data, ['size', 'total', 'contents']);
    }

    /**
     * poi本地检索
     * @param int $geotable_id 表ID
     * @param string $q 检索关键字
     * @param int $coord_type 坐标系，3代表百度经纬度坐标系统4代表百度墨卡托系统
     * @param string $region 区域名称，建议填写该参数
     * @param int $page_index 分页索引，默认0
     * @param int $page_size 分页数量，默认为10，最多为50
     * @param string $callback JS回调函数
     * @param string $tags 标签 空格分隔的多字符串
     * @param string $sortby 排序字段
     * @param string $filter 过滤条件
     * @return array
     */
    public function local($geotable_id, $q, $coord_type = null, $region = null, $page_index = null, $page_size = null, $callback = null, $tags = null, $sortby = null, $filter = null)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'q'           => $q,
        ];
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($region)) {
            $data['region'] = $region;
        }
        if (!is_null($tags)) {
            $data['tags'] = $tags;
        }
        if (!is_null($sortby)) {
            $data['sortby'] = $sortby;
        }
        if (!is_null($filter)) {
            $data['filter'] = $filter;
        }
        if (!is_null($page_index)) {
            $data['page_index'] = $page_index;
        }
        if (!is_null($page_size)) {
            $data['page_size'] = $page_size;
        }
        if (!is_null($callback)) {
            $data['callback'] = $callback;
        }
        return $this->httpGet("/geosearch/v3/local", $data, ['size', 'total', 'contents']);
    }

    /**
     * poi详情检索
     * @param int $geotable_id 表ID
     * @param int $uid poi的ID
     * @param int $coord_type 坐标系，3代表百度经纬度坐标系统 4代表百度墨卡托系统
     * @return array
     */
    public function detail($geotable_id, $uid, $coord_type = null)
    {
        $data = ['geotable_id' => $geotable_id];
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        return $this->httpGet("/geosearch/v3/detail/{$uid}", $data, ['size', 'total', 'contents']);
    }
}
