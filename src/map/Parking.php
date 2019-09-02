<?php
/**
 * 推荐上车点服务
 */

namespace fize\third\baidu\map;

use Exception;


class Parking extends Api
{
    /**
     * @param string $location 需查询周边推荐上车点的位置坐标,格式：经度,纬度
     * @param string $coordtype 请求参数中坐标的类型
     * @return array 错误则返回false
     * @throws Exception
     */
    public function search($location, $coordtype= 'bd09ll')
    {
        $data = [
            'location' => $location,
            'coordtype' => $coordtype
        ];
        return $this->httpGet("/parking/search", $data, 'recommendStops');
    }
}