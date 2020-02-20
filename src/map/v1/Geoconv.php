<?php

namespace fize\third\baidu\map\v1;

use fize\third\baidu\Map;

/**
 * 坐标换算服务
 */
class Geoconv extends Map
{
    /**
     * @param string $coords 需转换的源坐标，多组坐标以“；”分隔（经度，纬度）
     * @param int $from 源坐标类型
     * @param int $to 目标坐标类型
     * @return array 错误则返回false
     */
    public function geoconv($coords, $from = 1, $to = 5)
    {
        $data = [
            'coords' => $coords,
            'from'   => $from,
            'to'     => $to
        ];
        return $this->httpGet("/geoconv/v1/", $data, 'result');
    }
}
