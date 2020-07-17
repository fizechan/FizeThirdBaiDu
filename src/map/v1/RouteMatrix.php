<?php

namespace fize\third\baidu\map\v1;

use fize\third\baidu\Map;

/**
 * 批量算路
 */
class RouteMatrix extends Map
{
    /**
     * 驾车
     * @param string $origins 开始坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $destinations 结束坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $coord_type 坐标类型
     * @param int $timestamp 时间戳
     * @return array
     */
    public function driving($origins, $destinations, $coord_type = 'bd09ll', $timestamp = null)
    {
        $data = [
            'origins'      => $origins,
            'destinations' => $destinations,
            'mode'         => 'driving',
            'output'       => 'json',
            'coord_type'   => $coord_type
        ];
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1/routematrix", $data, ['info', 'result']);
    }

    /**
     * 步行
     * @param string $origins 开始坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $destinations 结束坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $coord_type 坐标类型
     * @param int $timestamp 时间戳
     * @return array
     */
    public function walking($origins, $destinations, $coord_type = 'bd09ll', $timestamp = null)
    {
        $data = [
            'origins'      => $origins,
            'destinations' => $destinations,
            'mode'         => 'walking',
            'output'       => 'json',
            'coord_type'   => $coord_type
        ];
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/direction/v1/routematrix", $data, ['info', 'result']);
    }
}
