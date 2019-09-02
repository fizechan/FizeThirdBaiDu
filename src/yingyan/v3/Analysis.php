<?php
/**
 * 百度鹰眼WEB服务API
 * 轨迹分析
 */

namespace fize\third\baidu\yingyan\v3;

use fize\third\baidu\yingyan\Api;
use Exception;

class Analysis extends Api
{

    /**
     * 停留点查询
     * @param int $service_id service的ID
     * @param string $entity_name entity名称
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param int $stay_time 停留时间，单位秒
     * @param int $stay_radius 停留半径，单位米
     * @param string $process_option 纠偏选项，用于控制返回坐标的纠偏处理方式
     * @param string $coord_type_output 返回的坐标类型
     * @return array
     * @throws Exception
     */
    public function staypoint($service_id, $entity_name, $start_time, $end_time, $stay_time = 600, $stay_radius = 20, $process_option = null, $coord_type_output = 'bd09ll')
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'stay_time' => $stay_time,
            'stay_radius' => $stay_radius,
            'coord_type_output' => $coord_type_output
        ];
        if(!is_null($process_option)){
            $data['process_option'] = $process_option;
        }
        return $this->httpGet("/api/v3/analysis/staypoint", $data, ['staypoint_num', 'stay_points']);
    }

    /**
     * 驾驶行为分析
     * @param int $service_id service的ID
     * @param string $entity_name entity名称
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param float $speeding_threshold 固定限速值
     * @param float $harsh_acceleration_threshold 急加速的加速度阈值
     * @param float $harsh_breaking_threshold 急减速的加速度阈值
     * @param float $harsh_steering_threshold 急转弯的向心加速度阈值
     * @param string $process_option 纠偏选项，用于控制返回坐标的纠偏处理方式，不填则按默认纠偏方式处理
     * @param string $coord_type_output 返回的坐标类型
     * @return array
     * @throws Exception
     */
    public function drivingbehavior($service_id, $entity_name, $start_time, $end_time, $speeding_threshold = null, $harsh_acceleration_threshold = null, $harsh_breaking_threshold = null, $harsh_steering_threshold = null, $process_option = null, $coord_type_output = null)
    {
        $data = [
            'service_id' => $service_id,
            'entity_name' => $entity_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
        if(!is_null($speeding_threshold)){
            $data['speeding_threshold'] = $speeding_threshold;
        }
        if(!is_null($harsh_acceleration_threshold)){
            $data['harsh_acceleration_threshold'] = $harsh_acceleration_threshold;
        }
        if(!is_null($harsh_breaking_threshold)){
            $data['harsh_breaking_threshold'] = $harsh_breaking_threshold;
        }
        if(!is_null($harsh_steering_threshold)){
            $data['harsh_steering_threshold'] = $harsh_steering_threshold;
        }
        if(!is_null($process_option)){
            $data['process_option'] = $process_option;
        }
        if(!is_null($coord_type_output)){
            $data['coord_type_output'] = $coord_type_output;
        }
        return $this->httpGet("/api/v3/analysis/drivingbehavior", $data, ['distance', 'duration', 'average_speed', 'max_speed', 'speeding_num', 'harsh_acceleration_num', 'harsh_breaking_num', 'harsh_steering_num', 'start_point', 'end_point', 'speeding', 'harsh_acceleration', 'harsh_breaking', 'harsh_steering']);
    }
}