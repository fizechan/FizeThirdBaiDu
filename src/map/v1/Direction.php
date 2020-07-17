<?php


namespace fize\third\baidu\map\v1;

use fize\third\baidu\Map;

/**
 * 路线规划
 * @see http://lbsyun.baidu.com/index.php?title=webapi/direction-api#service-page-anchor-1-2
 */
class Direction extends Map
{

    /**
     * 驾车路线规划
     * @param string $origin 起点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $destination 终点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $origin_region 起始点所在城市
     * @param string $destination_region 终点所在城市
     * @param string $coord_type 坐标类型
     * @param string $ret_coordtype 返回坐标类型
     * @param string $waypoints 途经点集合，包括一个或多个用竖线字符"|"分隔的地址名称或经纬度。
     * @param int $tactics 导航策略。可选值（非驾车模式，不选此参数）10：不走高速；11：常规路线，即多数人常走的一条路线，不受路况影响，可用于用车估价；12：距离较短，即距离相对较短的一条路线，但并不一定是一条优质路线；13：躲避拥堵
     * @param int $timestamp 时间戳
     * @return array
     */
    public function driving($origin, $destination, $origin_region, $destination_region, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $waypoints = null, $tactics = 12, $timestamp = null)
    {
        $data = [
            'origin'             => $origin,
            'destination'        => $destination,
            'mode'               => 'driving',
            'origin_region'      => $origin_region,
            'destination_region' => $destination_region,
            'output'             => 'json',
            'coord_type'         => $coord_type,
            'ret_coordtype'      => $ret_coordtype,
            'tactics'            => $tactics,
        ];
        if (!is_null($waypoints)) {
            $data['waypoints'] = $waypoints;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1", $data, ['type', 'info', 'result']);
    }

    /**
     * 步行路线规划
     * @param string $origin 起点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $destination 终点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $region 所在城市
     * @param string $coord_type 坐标类型
     * @param string $ret_coordtype 返回坐标类型
     * @param string $waypoints 途经点集合，包括一个或多个用竖线字符"|"分隔的地址名称或经纬度。
     * @param int $timestamp 时间戳
     * @return array
     */
    public function walking($origin, $destination, $region, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $waypoints = null, $timestamp = null)
    {
        $data = [
            'origin'        => $origin,
            'destination'   => $destination,
            'mode'          => 'walking',
            'region'        => $region,
            'output'        => 'json',
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
        ];
        if (!is_null($waypoints)) {
            $data['waypoints'] = $waypoints;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1", $data, ['type', 'info', 'result']);
    }

    /**
     * 公交路线规划
     * @param string $origin 起点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $destination 终点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $region 所在城市
     * @param string $coord_type 坐标类型
     * @param string $ret_coordtype 返回坐标类型
     * @param string $waypoints 途经点集合，包括一个或多个用竖线字符"|"分隔的地址名称或经纬度。
     * @param int $timestamp 时间戳
     * @return array
     */
    public function transit($origin, $destination, $region, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $waypoints = null, $timestamp = null)
    {
        $data = [
            'origin'        => $origin,
            'destination'   => $destination,
            'mode'          => 'transit',
            'region'        => $region,
            'output'        => 'json',
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
        ];
        if (!is_null($waypoints)) {
            $data['waypoints'] = $waypoints;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1", $data, ['type', 'info', 'result']);
    }

    /**
     * 骑行路线规划
     * @param string $origin 起点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $destination 终点名称或经纬度，或者可同时提供名称和经纬度，此时经纬度优先级高，将作为导航依据，名称只负责展示。
     * @param string $region 所在城市
     * @param string $coord_type 坐标类型
     * @param string $ret_coordtype 返回坐标类型
     * @param string $waypoints 途经点集合，包括一个或多个用竖线字符"|"分隔的地址名称或经纬度。
     * @param int $timestamp 时间戳
     * @return array
     */
    public function riding($origin, $destination, $region, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $waypoints = null, $timestamp = null)
    {
        $data = [
            'origin'        => $origin,
            'destination'   => $destination,
            'mode'          => 'riding',
            'region'        => $region,
            'output'        => 'json',
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
        ];
        if (!is_null($waypoints)) {
            $data['waypoints'] = $waypoints;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1", $data, ['type', 'info', 'result']);
    }
}
