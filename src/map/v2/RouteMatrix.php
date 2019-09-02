<?php
/**
 * 批量算路
 */

namespace fize\third\baidu\map\v2;

use fize\third\baidu\map\Api;
use Exception;

class RouteMatrix extends Api
{
    /**
     * 驾车
     * @param string $origins 开始坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $destinations 结束坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $coord_type 坐标类型
     * @param int $tactics 10： 不走高速；11：常规路线，即多数人常走的一条路线，不受路况影响；12： 距离较短（考虑路况）：即距离相对较短的一条路线，但并不一定是一条优质路线。计算耗时时，考虑路况对耗时的影响；13： 距离较短
     * @return array 错误则返回false
     * @throws Exception
     */
    public function driving($origins, $destinations, $coord_type = 'bd09ll', $tactics = 13)
    {
        $data = [
            'origins' => $origins,
            'destinations' => $destinations,
            'output' => 'json',
            'coord_type' => $coord_type,
            'tactics' => $tactics,
        ];
        return $this->httpGet("/routematrix/v2/driving", $data, 'result');
    }

    /**
     * 骑行
     * @param string $origins 开始坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $destinations 结束坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $coord_type 坐标类型
     * @return array 错误则返回false
     * @throws Exception
     */
    public function riding($origins, $destinations, $coord_type = 'bd09ll')
    {
        $data = [
            'origins' => $origins,
            'destinations' => $destinations,
            'output' => 'json',
            'coord_type' => $coord_type
        ];
        return $this->httpGet("/routematrix/v2/riding", $data, 'result');
    }

    /**
     * 步行
     * @param string $origins 开始坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $destinations 结束坐标格式为：lat<纬度>,lng<经度>|lat<纬度>,lng<经度>
     * @param string $coord_type 坐标类型
     * @return array 错误则返回false
     * @throws Exception
     */
    public function walking($origins, $destinations, $coord_type = 'bd09ll')
    {
        $data = [
            'origins' => $origins,
            'destinations' => $destinations,
            'output' => 'json',
            'coord_type' => $coord_type
        ];
        return $this->httpGet("/routematrix/v2/walking", $data, 'result');
    }
}