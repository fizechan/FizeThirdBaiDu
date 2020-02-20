<?php


namespace fize\third\baidu\map\v1;


use fize\third\baidu\Map;


/**
 * 百度地图LBS个性化编码API接口
 */
class Geocoder extends Map
{

    /**
     * 云地理编码
     * 即将文字描述性地址，转化成可用的云地理编码数据
     * @param string $address 文字描述性地址
     * @param string $city 目标城市偏向
     * @param int $geotable_id 填写则激活个性化GC服务
     * @param string $output 输出格式为json或者xml，在后端请勿使用该参数
     * @param string $callback 将json格式的返回值通过callback函数返回以实现jsonp功能，在后端请勿使用该参数
     * @return array 错误则返回false
     */
    public function cloudgc($address, $city = null, $geotable_id = null, $output = 'json', $callback = null)
    {
        $data = [
            'address' => $address,
            'output'  => $output
        ];
        if (!is_null($city)) {
            $data['city'] = $city;
        }
        if (!is_null($geotable_id)) {
            $data['geotable_id'] = $geotable_id;
        }
        if (!is_null($callback)) {
            $data['callback'] = $callback;
        }
        return $this->httpGet("/cloudgc/v1", $data, 'result');
    }

    /**
     * 云逆地理编码
     * 即将坐标转化为文字描述性
     * @param string $location 坐标，格式：纬度,经度
     * @param int $geotable_id 位置表ID
     * @param string $extensions 是否返回扩展信息：默认不返回，extensions=pois时返回pois和custom_pois
     * @param string $coord_type bd09ll（百度经纬度坐标）、gcj02ll（国测局经纬度坐标）、wgs84ll（wgs84经纬度坐标）
     * @param mixed $timestamp 鉴权时间戳，false表示不传递，null表示传递当前时间戳
     * @return array 错误时返回false
     */
    public function cloudrgc($location, $geotable_id, $extensions = null, $coord_type = null, $timestamp = false)
    {
        $data = [
            'location'    => $location,
            'geotable_id' => $geotable_id,
        ];
        if (!is_null($extensions)) {
            $data['extensions'] = $extensions;
        }
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if ($timestamp !== false) {
            if (is_null($timestamp)) {
                $timestamp = time();
            }
            $data['timestamp'] = $timestamp;
        }
        $return_column = ['location', 'address_component', 'formatted_address', 'pois', 'custom_pois', 'custom_location_description', 'recommended_location_description'];
        return $this->httpGet("/cloudrgc/v1", $data, $return_column);
    }
}
