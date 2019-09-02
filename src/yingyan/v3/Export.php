<?php
/**
 * 百度鹰眼WEB服务API
 * 批量导出类接口
 */

namespace fize\third\baidu\yingyan\v3;

use fize\third\baidu\yingyan\Api;
use Exception;

class Export extends Api
{
    /**
     * 创建任务
     * @param int $service_id service的ID
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param string $coord_type_output 返回的坐标类型，默认值：bd09ll
     * @return mixed
     * @throws Exception
     */
    public function createjob($service_id, $start_time, $end_time, $coord_type_output = null)
    {
        $data = [
            'service_id' => $service_id,
            'start_time' => $start_time,
            'end_time' => $end_time
        ];
        if(!is_null($coord_type_output)){
            $data['coord_type_output'] = $coord_type_output;
        }
        return $this->httpPost("/api/v3/export/createjob", $data, 'job_id');
    }

    /**
     * 删除任务
     * @param int $service_id service的ID
     * @param int $job_id 任务id
     * @return bool
     * @throws Exception
     */
    public function deletejob($service_id, $job_id)
    {
        $data = [
            'service_id' => $service_id,
            'job_id' => $job_id,
        ];
        $rst = $this->httpPost("/api/v3/export/deletejob", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 查询任务
     * @param int $service_id service的ID
     * @return array
     * @throws Exception
     */
    public function getjob($service_id)
    {
        $data = [
            'service_id' => $service_id
        ];
        return $this->httpPost("/api/v3/export/getjob", $data, ['total', 'jobs']);
    }
}