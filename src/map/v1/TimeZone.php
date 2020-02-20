<?php

namespace fize\third\baidu\map\v1;

use fize\third\baidu\Map;

/**
 * 时区服务
 */
class TimeZone extends Map
{

    /**
     * 查询地球上某一位置所属时区信息以及与协调世界时（UTC）的时间偏移信息。
     * @param string $location 需查询时区的位置坐标（纬度、经度）,当前仅支持全球陆地坐标查询，海域坐标暂不支持
     * @param string $coord_type 坐标的类型
     * @param int $timestamp 时间戳
     * @return array 错误则返回false
     */
    public function timezone($location, $coord_type = 'bd09ll', $timestamp = null)
    {
        $data = [
            'location'   => $location,
            'coord_type' => $coord_type,
        ];
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $data['timestamp'] = $timestamp;
        return $this->httpGet("/timezone/v1", $data, ['timezone_id', 'dst_offset', 'raw_offset']);
    }
}
