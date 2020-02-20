<?php

namespace fize\third\baidu\map\v3\geodata;

use fize\third\baidu\Map;


/**
 * 批量操作任务查询接口
 *
 * 百度地图LBS云存储API接口
 */
class Job extends Map
{

    /**
     * 批量上传进度查询,支持查询成功，失败poi
     * @param int $geotable_id 指定表ID
     * @param string $job_id 导入接口返回的job_id
     * @param int $status Poi导入的状态，默认为0 全部 1失败 2成功
     * @param int $page_index 分页索引，默认为0
     * @param int $page_size 分页数目，默认为10，上限为100
     * @param int $timestamp 时间戳，不指定时为null
     * @return array 错误时返回false
     */
    public function listimportdata($geotable_id, $job_id, $status = 0, $page_index = 0, $page_size = 10, $timestamp = null)
    {
        $data = [
            'geotable_id' => $geotable_id,
            'job_id'      => $job_id,
            'status'      => $status,
            'page_index'  => $page_index,
            'page_size'   => $page_size,
            'timestamp'   => is_null($timestamp) ? time() : $timestamp,
        ];

        $return_column = ['total', 'size', 'process_status', 'process_total', 'process_failed', 'process_success', 'datas', 'header', 'time'];

        return $this->httpGet("/geodata/v3/job/listimportdata", $data, $return_column);
    }

    /**
     * 批量操作任务查询
     * @param int $type 指定类型
     * @param int $status 状态，目前是1：新增，2：正在处理，3：完成。
     * @return array 错误时返回false
     * @todo 指定类型的全部枚举还未清楚
     */
    public function lists($type = null, $status = null)
    {
        $data = [];
        if (!is_null($type)) {
            $data['type'] = $type;
        }
        if (!is_null($status)) {
            $data['status'] = $status;
        }

        return $this->httpGet("/geodata/v3/job/list", $data, 'jobs');
    }

    public function detail($id)
    {
        $data = ['id' => $id];
        return $this->httpGet("/geodata/v3/job/detail", $data, 'job');
    }
}
