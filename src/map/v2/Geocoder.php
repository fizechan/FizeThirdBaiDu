<?php
/**
 * 地理编码服务
 */

namespace fize\third\baidu\map\v2;

use fize\third\baidu\map\Api;
use Exception;


class Geocoder extends Api
{
    /**
     * 地理编码
     * @param string $address 地址描述
     * @param string $city 指定所在城市
     * @param string $ret_coordtype 指定坐标系
     * @return array 错误则返回false
     * @throws Exception
     */
    public function encode($address, $city = null, $ret_coordtype = 'bd09ll')
    {
        $data = [
            'address' => $address,
            'ret_coordtype' => $ret_coordtype,
            'output' => 'json'
        ];
        if (!is_null($city)) {
            $data['city'] = $city;
        }
        return $this->httpGet("/geocoder/v2/", $data, 'result');
    }

    /**
     * 逆地理编码
     * @param string $location 坐标地址，格式为lat<纬度>,lng<经度>
     * @param string $coordtype 坐标的类型
     * @param string $ret_coordtype 返回的坐标的类型
     * @param bool $batch 是否批量解析
     * @param int $pois 是否召回传入坐标周边的poi，0为不召回，1为召回
     * @param int $radius poi召回半径，允许设置区间为0-1000米，超过1000米按1000米召回。
     * @param string $extensions_poi extensions_poi=null时，后端不调用poi相关服务，可减少服务访问时延。
     * @param bool $extensions_road 当取值为true时，召回坐标周围最近的3条道路数据
     * @param bool $extensions_town 当取值为true时，行政区划返回乡镇级数据。默认不访问。
     * @param int $latest_admin 是否访问最新版行政区划数据，1（访问），0（不访问）
     * @return array 错误则返回false
     * @throws Exception
     */
    public function decode($location, $coordtype = null, $ret_coordtype = null, $batch = false, $pois = 0, $radius = 1000, $extensions_poi = null, $extensions_road = false, $extensions_town = null, $latest_admin = 0)
    {
        $data = [
            'location' => $location,
            'batch' => $batch,
            'pois' => $pois,
            'radius' => $radius,
            'output' => 'json',
            'extensions_road' => $extensions_road,
            'latest_admin' => $latest_admin
        ];
        if (!is_null($coordtype)) {
            $data['coordtype'] = $coordtype;
        }
        if (!is_null($ret_coordtype)) {
            $data['ret_coordtype'] = $ret_coordtype;
        }
        if (!is_null($extensions_poi)) {
            $data['extensions_poi'] = $extensions_poi;
        }
        if (!is_null($extensions_town)) {
            $data['extensions_town'] = $extensions_town;
        }
        return $this->httpGet("/geocoder/v2/", $data, 'result');
    }
}