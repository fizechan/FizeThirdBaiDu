<?php


namespace fize\third\baidu\map\v2;

use fize\third\baidu\Map;


/**
 * 百度地图地点检索服务API
 */
class Place extends Map
{

    /**
     * 区域检索POI服务与POI详情服务。
     * @param string $query 检索关键字
     * @param array $params 其他参数
     * @param int $scope 检索结果详细程度。取值为1 或空，则返回基本信息；取值为2，返回检索POI详细信息
     * @param string $output 输出格式为json或者xml，默认json
     * @return array
     */

    /**
     * 行政区划区域检索
     * @param string $query 检索关键字
     * @param string $region 检索行政区划区域
     * @param string $tag 检索分类，与q组合进行检索，多个分类以","分隔
     * @param bool $city_limit 区域数据召回限制，为true时，仅召回region对应区域内数据
     * @param string $output 输出格式为json或者xml，请固定为json
     * @param int $scope 检索结果详细程度。取值为1 或空，则返回基本信息；取值为2，返回检索POI详细信息
     * @param array $filter 检索过滤条件
     * @param int $coord_type 坐标类型，1（wgs84ll即GPS经纬度），2（gcj02ll即国测局经纬度坐标），3（bd09ll即百度经纬度坐标），4（bd09mc即百度米制坐标）
     * @param string $ret_coordtype 可选参数，添加后POI返回国测局经纬度坐标，ret_coordtype：gcj02ll、bd09ll。默认召回bd09ll
     * @param int $page_size 单次召回POI数量，默认为10条记录，最大返回20条。多关键字检索时，返回的记录数为关键字个数*page_size。
     * @param int $page_num 分页页码，默认为0,0代表第一页，1代表第二页，以此类推。常与page_size搭配使用。
     * @param int $timestamp 时间戳，不传递则默认为当前时间戳
     * @return array
     */
    public function searchRegion($query, $region, $tag = null, $city_limit = true, $output = "json", $scope = 1, array $filter = [], $coord_type = 3, $ret_coordtype = 'bd09ll', $page_size = 10, $page_num = 0, $timestamp = null)
    {
        $data = [
            'query'         => $query,
            'region'        => $region,
            'city_limit'    => $city_limit,
            'output'        => $output,
            'scope'         => $scope,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'page_size'     => $page_size,
            'page_num'      => $page_num
        ];
        if (!empty($tag)) {
            $data['tag'] = $tag;
        }
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/place/v2/search", $data, ['total', 'name', 'location', 'address', 'telephone', 'uid', 'street_id', 'detail', 'detail_info']);
    }

    /**
     * 周边检索
     * @param string $query 检索关键字
     * @param string $location 周边检索中心点，不支持多个点,lat<纬度>,lng<经度>
     * @param string $tag 检索分类，与q组合进行检索，多个分类以","分隔
     * @param int $radius 周边检索半径，单位为米。
     * @param bool $radius_limit 是否严格限定召回结果在设置检索半径范围内。true（是），false（否）
     * @param string $output 输出格式为json或者xml，请固定为json
     * @param int $scope 检索结果详细程度。取值为1 或空，则返回基本信息；取值为2，返回检索POI详细信息
     * @param array $filter 检索过滤条件
     * @param int $coord_type 坐标类型，1（wgs84ll即GPS经纬度），2（gcj02ll即国测局经纬度坐标），3（bd09ll即百度经纬度坐标），4（bd09mc即百度米制坐标）
     * @param string $ret_coordtype 可选参数，添加后POI返回国测局经纬度坐标，ret_coordtype：gcj02ll、bd09ll。默认召回bd09ll
     * @param int $page_size 单次召回POI数量，默认为10条记录，最大返回20条。多关键字检索时，返回的记录数为关键字个数*page_size。
     * @param int $page_num 分页页码，默认为0,0代表第一页，1代表第二页，以此类推。常与page_size搭配使用。
     * @param int $timestamp 时间戳，不传递则默认为当前时间戳
     * @return array
     */
    public function searchLocation($query, $location, $tag = null, $radius = 1000, $radius_limit = true, $output = "json", $scope = 1, array $filter = [], $coord_type = 3, $ret_coordtype = 'bd09ll', $page_size = 10, $page_num = 0, $timestamp = null)
    {
        $data = [
            'query'         => $query,
            'location'      => $location,
            'radius'        => $radius,
            'radius_limit'  => $radius_limit,
            'output'        => $output,
            'scope'         => $scope,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'page_size'     => $page_size,
            'page_num'      => $page_num
        ];
        if (!empty($tag)) {
            $data['tag'] = $tag;
        }
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/place/v2/search", $data, ['total', 'name', 'location', 'address', 'telephone', 'uid', 'street_id', 'detail', 'detail_info']);
    }

    /**
     * @param string $query 检索关键字
     * @param string $bounds 检索矩形区域，多组坐标间以","分隔,lat,lng(左下角坐标),lat,lng(右上角坐标)
     * @param string $tag 检索分类，与q组合进行检索，多个分类以","分隔
     * @param string $output 输出格式为json或者xml，请固定为json
     * @param int $scope 检索结果详细程度。取值为1 或空，则返回基本信息；取值为2，返回检索POI详细信息
     * @param array $filter 检索过滤条件
     * @param int $coord_type 坐标类型，1（wgs84ll即GPS经纬度），2（gcj02ll即国测局经纬度坐标），3（bd09ll即百度经纬度坐标），4（bd09mc即百度米制坐标）
     * @param string $ret_coordtype 可选参数，添加后POI返回国测局经纬度坐标，ret_coordtype：gcj02ll、bd09ll。默认召回bd09ll
     * @param int $page_size 单次召回POI数量，默认为10条记录，最大返回20条。多关键字检索时，返回的记录数为关键字个数*page_size。
     * @param int $page_num 分页页码，默认为0,0代表第一页，1代表第二页，以此类推。常与page_size搭配使用。
     * @param int $timestamp 时间戳，不传递则默认为当前时间戳
     * @return array
     */
    public function searchBounds($query, $bounds, $tag = null, $output = "json", $scope = 1, array $filter = [], $coord_type = 3, $ret_coordtype = 'bd09ll', $page_size = 10, $page_num = 0, $timestamp = null)
    {
        $data = [
            'query'         => $query,
            'bounds'        => $bounds,
            'output'        => $output,
            'scope'         => $scope,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'page_size'     => $page_size,
            'page_num'      => $page_num
        ];
        if (!empty($tag)) {
            $data['tag'] = $tag;
        }
        if (!empty($filter)) {
            $string = [];
            foreach ($filter as $key => $value) {
                $string[] = "{$key}:{$value}";
            }
            $data['filter'] = implode('|', $string);
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/place/v2/search", $data, ['total', 'name', 'location', 'address', 'telephone', 'uid', 'street_id', 'detail', 'detail_info']);
    }

    /**
     * 地点详情检索服务
     * @param mixed $uid 传入单个ID或者多个ID组成的数组
     * @param int $scope 检索结果详细程度。取值为1 或空，则返回基本信息；取值为2，返回检索POI详细信息
     * @param string $output 请求返回格式json或xml
     * @param int $timestamp 时间戳，不传递则默认为当前时间戳
     * @return array
     */
    public function detail($uid, $scope = 1, $output = 'json', $timestamp = null)
    {
        $data = [
            'output' => $output,
            'scope'  => $scope,
        ];
        if (is_array($uid)) {
            $data['uids'] = implode(',', $uid);
        } else {
            $data['uid'] = $uid;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/place/v2/detail", $data, ['total', 'name', 'location', 'address', 'telephone', 'uid', 'street_id', 'detail', 'detail_info']);
    }

    /**
     * 地点输入提示服务
     * @param string $query 输入建议关键字（支持拼音）
     * @param string $region 区域。支持全国、省、城市及对应百度编码
     * @param bool $city_limit 取值为"true"，仅返回region中指定城市检索结果
     * @param string $location 传入location参数后，返回结果将以距离进行排序
     * @param int $coord_type 坐标类型：1（wgs84ll即GPS经纬度）2（gcj02ll即国测局经纬度坐标）3（bd09ll即百度经纬度坐标）4（bd09mc即百度米制坐标）
     * @param string $ret_coordtype 可选参数，添加后POI返回国测局经纬度坐标
     * @return array
     */
    public function suggestion($query, $region, $city_limit = false, $location = null, $coord_type = 3, $ret_coordtype = null)
    {
        $data = [
            'query'         => $query,
            'region'        => $region,
            'city_limit'    => $city_limit,
            'location'      => $location,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'output'        => 'json',
            'timestamp'     => time()
        ];
        return $this->httpGet("/place/v2/suggestion", $data, ['name', 'location', 'uid', 'city', 'district', 'tag', 'address']);
    }
}
