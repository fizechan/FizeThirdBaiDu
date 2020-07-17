<?php


namespace fize\third\baidu\map\v2;

use fize\third\baidu\Map;

/**
 * 路线规划
 * @see http://lbsyun.baidu.com/index.php?title=webapi/direction-api-v2
 */
class Direction extends Map
{

    /**
     * 公共交通路线规划
     * @param string $origin 起点，格式为：纬度,经度，小数点后不超过6位
     * @param string $destination 终点，格式为：纬度,经度，小数点后不超过6位
     * @param string $coord_type 起终点的坐标类型
     * @param int $tactics_incity 市内公交换乘策略：0 推荐；1 少换乘；2 少步行；3 不坐地铁；4 时间短；5 地铁优先
     * @param int $tactics_intercity 跨城公交换乘策略：0:时间短；1 出发早；2 价格低；
     * @param int $trans_type_intercity 跨城交通方式策略：0:火车优先；1:飞机优先；2:大巴优先；
     * @param string $ret_coordtype 返回值的坐标类型
     * @param int $page_size 返回每页几条路线
     * @param int $page_index 返回第几页
     * @return array
     */
    public function transit($origin, $destination, $coord_type = 'bd09ll', $tactics_incity = 0, $tactics_intercity = 0, $trans_type_intercity = 0, $ret_coordtype = 'bd09ll', $page_size = 10, $page_index = 1)
    {
        $data = [
            'origin'               => $origin,
            'destination'          => $destination,
            'coord_type'           => $coord_type,
            'tactics_incity'       => $tactics_incity,
            'tactics_intercity'    => $tactics_intercity,
            'trans_type_intercity' => $trans_type_intercity,
            'ret_coordtype'        => $ret_coordtype,
            'output'               => 'json',
            'page_size'            => $page_size,
            'page_index'           => $page_index
        ];
        return $this->httpGet("/direction/v2/transit", $data, 'result');
    }

    /**
     * 骑行路线规划
     * @param string $origin 起点，格式为：纬度,经度，小数点后不超过6位
     * @param string $destination 终点，格式为：纬度,经度，小数点后不超过6位
     * @param string $coord_type 输入坐标类型
     * @param string $ret_coordtype 输出坐标类型
     * @param int $riding_type 骑行类型,默认0：0-普通  1-电动车
     * @return array
     */
    public function riding($origin, $destination, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $riding_type = 0)
    {
        $data = [
            'origin'        => $origin,
            'destination'   => $destination,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'output'        => 'json',
            'riding_type'   => $riding_type
        ];
        return $this->httpGet("/direction/v2/riding", $data, 'result');
    }

    /**
     * 驾车路线规划
     * @param string $origin 起点，格式为：纬度,经度，小数点后不超过6位
     * @param string $destination 终点，格式为：纬度,经度，小数点后不超过6位
     * @param int $origin_uid POI 的 uid（在已知起点POI 的 uid 情况下，请尽量填写uid，将提升路线规划的准确性）
     * @param int $destination_uid POI 的 uid（在已知终点POI 的 uid 情况下，请尽量填写uid，将提升路线规划的准确性）
     * @param string $coord_type 输入坐标类型
     * @param string $ret_coordtype 输出坐标类型
     * @param int $tactics 策略
     * @param int $alternatives 是否返回备选路线
     * @param string $plate_number 车牌号，如 京A00022，用于规避车牌号限行路段。
     * @param int $timestamp 时间戳
     * @return array
     */
    public function driving($origin, $destination, $origin_uid = null, $destination_uid = null, $coord_type = 'bd09ll', $ret_coordtype = 'bd09ll', $tactics = 0, $alternatives = 0, $plate_number = null, $timestamp = null)
    {
        $data = [
            'origin'        => $origin,
            'destination'   => $destination,
            'coord_type'    => $coord_type,
            'ret_coordtype' => $ret_coordtype,
            'tactics'       => $tactics,
            'alternatives'  => $alternatives,
            'output'        => 'json',
        ];
        if (!is_null($origin_uid)) {
            $data['origin_uid'] = $origin_uid;
        }
        if (!is_null($destination_uid)) {
            $data['destination_uid'] = $destination_uid;
        }
        if (!is_null($plate_number)) {
            $data['plate_number'] = $plate_number;
        }
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v2/driving", $data, 'result');
    }
}
