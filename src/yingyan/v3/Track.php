<?php
/**
 * 百度鹰眼WEB服务API
 * 轨迹管理
 */

namespace fize\third\baidu\yingyan\v3;

use fize\third\baidu\yingyan\Api;
use fize\crypt\Json;
use Exception;


class Track extends Api
{
    /**
     * 上传单个轨迹点,为一个entity上传一个轨迹点
     * @param int $service_id servicede ID
     * @param string $entity_name entity唯一标识
     * @param float $latitude 纬度
     * @param float $longitude 经度
     * @param int $loc_time 定位时设备的时间戳
     * @param string $coord_type_input 坐标类型
     * @param float $speed 速度，单位：km/h
     * @param int $direction 方向，范围为[0,359]，0度为正北方向，顺时针
     * @param float $height 高度
     * @param float $radius 定位精度，GPS或定位SDK返回的值
     * @param string $object_name 对象数据名称，通过鹰眼 SDK 上传的图像文件名称
     * @param array $column track的自定义字段
     * @return bool
     * @throws Exception
     */
    public function addpoint($service_id, $entity_name, $latitude, $longitude, $loc_time, $coord_type_input = 'bd09ll', $speed = null, $direction = null, $height = null, $radius = null, $object_name = null, array $column = [])
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'loc_time' => $loc_time,
            'coord_type_input' => $coord_type_input
        ];
        if(!is_null($speed)){
            $data['speed'] = $speed;
        }
        if(!is_null($direction)){
            $data['direction'] = $direction;
        }
        if(!is_null($height)){
            $data['height'] = $height;
        }
        if(!is_null($radius)){
            $data['radius'] = $radius;
        }
        if(!is_null($object_name)){
            $data['object_name'] = $object_name;
        }
        if (!empty($column)) {
            $data = array_merge($data, $column);
        }
        $rst = $this->httpPost("/api/v3/track/addpoint", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 批量添加轨迹点
     * @param int $service_id service唯一标识
     * @param array $point_list 轨迹点列表
     * @return array
     * @throws Exception
     */
    public function addpoints($service_id, array $point_list)
    {
        $data = [
            'service_id' => $service_id,
            'point_list' => Json::encode($point_list)
        ];
        return $this->httpPost("/api/v3/track/addpoints", $data, ['success_num', 'fail_info']);
    }

    /**
     * 实时纠偏
     * @param int $service_id service唯一标识
     * @param string $entity_name entity唯一标识
     * @param string $process_option 纠偏选项
     * @param string $coord_type_output 返回的坐标类型,默认值：bd09ll
     * @return array
     * @throws Exception
     */
    public function getlatestpoint($service_id, $entity_name, $process_option = null, $coord_type_output = null)
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name
        ];
        if(!is_null($process_option)){
            $data['process_option'] = $process_option;
        }
        if(!is_null($coord_type_output)){
            $data['coord_type_output'] = $coord_type_output;
        }
        return $this->httpGet("/api/v3/track/getlatestpoint", $data, ['latest_point', 'limit_speed']);
    }

    /**
     * 查询轨迹里程
     * @param int $service_id service唯一标识
     * @param string $entity_name entity唯一标识
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param int $is_processed 是否返回纠偏后里程
     * @param string $process_option 纠偏选项
     * @param string $supplement_mode 里程补偿方式
     * @return float
     * @throws Exception
     */
    public function getdistance($service_id, $entity_name, $start_time, $end_time, $is_processed = 0, $process_option = null, $supplement_mode = 'no_supplement')
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => $is_processed,
            'supplement_mode' => $supplement_mode
        ];
        if(!is_null($process_option)){
            $data['process_option'] = $process_option;
        }
        return $this->httpGet("/api/v3/track/getdistance", $data, 'distance');
    }

    /**
     * 轨迹查询与纠偏
     * @param int $service_id service唯一标识
     * @param string $entity_name entity唯一标识
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param int $is_processed 是否返回纠偏后里程
     * @param string $process_option 纠偏选项
     * @param string $supplement_mode 里程补偿方式
     * @param string $coord_type_output 返回的坐标类型
     * @param string $sort_type 返回轨迹点的排序规则
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     * @throws Exception
     */
    public function gettrack($service_id, $entity_name, $start_time, $end_time, $is_processed = 0, $process_option = null, $supplement_mode = 'no_supplement', $coord_type_output = 'bd09ll', $sort_type = 'asc', $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => $is_processed,
            'supplement_mode' => $supplement_mode,
            'coord_type_output' => $coord_type_output,
            'sort_type' => $sort_type,
            'page_index' => $page_index,
            'page_size' => $page_size
        ];
        if(!is_null($process_option)){
            $data['process_option'] = $process_option;
        }
        return $this->httpGet("/api/v3/track/gettrack", $data, ['total', 'size', 'distance', 'toll_distance', 'start_point', 'end_point', 'points']);
    }
}