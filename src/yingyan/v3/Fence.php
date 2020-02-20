<?php

namespace fize\third\baidu\yingyan\v3;

use fize\crypt\Json;
use fize\third\baidu\YingYan;

/**
 * 地理围栏管理
 */
class Fence extends YingYan
{

    /**
     * 创建圆形围栏
     * @param int $service_id service的唯一标识
     * @param float $longitude 围栏圆心经度
     * @param float $latitude 围栏圆心纬度
     * @param float $radius 围栏半径
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return mixed
     */
    public function createcirclefence($service_id, $longitude, $latitude, $radius, $coord_type = 'bd09ll', $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'longitude'  => $longitude,
            'latitude'   => $latitude,
            'radius'     => $radius,
            'coord_type' => $coord_type,
        ];
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        return $this->httpPost("/api/v3/fence/createcirclefence", $data, 'fence_id');
    }

    /**
     * 创建多边形围栏
     * @param int $service_id service的唯一标识
     * @param string $vertexes 多边形围栏形状点, 经纬度顺序为：纬度,经度；
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return mixed
     */
    public function createpolygonfence($service_id, $vertexes, $coord_type = 'bd09ll', $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'vertexes'   => $vertexes,
            'coord_type' => $coord_type,
        ];
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        return $this->httpPost("/api/v3/fence/createpolygonfence", $data, 'fence_id');
    }

    /**
     * 创建线型围栏
     * @param int $service_id service的唯一标识
     * @param string $vertexes 线型围栏坐标点
     * @param int $offset 偏离距离
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return mixed
     */
    public function createpolylinefence($service_id, $vertexes, $offset, $coord_type = 'bd09ll', $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'vertexes'   => $vertexes,
            'offset'     => $offset,
            'coord_type' => $coord_type,
        ];
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        return $this->httpPost("/api/v3/fence/createpolylinefence", $data, 'fence_id');
    }

    /**
     * 创建行政区划围栏
     * @param int $service_id service的唯一标识
     * @param string $keyword 行政区划关键字
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return array
     */
    public function createdistrictfence($service_id, $keyword, $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'keyword'    => $keyword
        ];
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        return $this->httpPost("/api/v3/fence/createdistrictfence", $data, ['fence_id', 'district', 'district_list']);
    }

    /**
     * 更新圆形围栏
     * @param int $service_id service的唯一标识
     * @param int $fence_id 围栏的唯一标识
     * @param float $longitude 围栏圆心经度
     * @param float $latitude 围栏圆心纬度
     * @param float $radius 围栏半径
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return bool
     */
    public function updatecirclefence($service_id, $fence_id, $longitude = null, $latitude = null, $radius = null, $coord_type = null, $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'fence_id'   => $fence_id,
        ];
        if (!is_null($longitude)) {
            $data['longitude'] = $longitude;
        }
        if (!is_null($latitude)) {
            $data['latitude'] = $latitude;
        }
        if (!is_null($radius)) {
            $data['radius'] = $radius;
        }
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        $rst = $this->httpPost("/api/v3/fence/updatecirclefence", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新多边形围栏
     * @param int $service_id service的唯一标识
     * @param int $fence_id 围栏的唯一标识
     * @param string $vertexes 多边形围栏形状点, 经纬度顺序为：纬度,经度；
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return bool
     */
    public function updatepolygonfence($service_id, $fence_id, $vertexes = null, $coord_type = null, $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'fence_id'   => $fence_id,
        ];
        if (!is_null($vertexes)) {
            $data['vertexes'] = $vertexes;
        }
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        $rst = $this->httpPost("/api/v3/fence/updatepolygonfence", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新线型围栏
     * @param int $service_id service的唯一标识
     * @param int $fence_id 围栏的唯一标识
     * @param string $vertexes 线型围栏坐标点
     * @param int $offset 偏离距离
     * @param string $coord_type 坐标类型
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return bool
     */
    public function updatepolylinefence($service_id, $fence_id, $vertexes = null, $offset = null, $coord_type = null, $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'fence_id'   => $fence_id,
        ];
        if (!is_null($vertexes)) {
            $data['vertexes'] = $vertexes;
        }
        if (!is_null($offset)) {
            $data['offset'] = $offset;
        }
        if (!is_null($coord_type)) {
            $data['coord_type'] = $coord_type;
        }
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        $rst = $this->httpPost("/api/v3/fence/updatepolylinefence", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新行政区划围栏
     * @param int $service_id service的唯一标识
     * @param int $fence_id 围栏的唯一标识
     * @param string $keyword 行政区划关键字
     * @param string $fence_name 围栏名称
     * @param string $monitored_person 监控对象
     * @param int $denoise 围栏去噪参数
     * @return array
     */
    public function updatedistrictfence($service_id, $fence_id, $keyword = null, $fence_name = null, $monitored_person = null, $denoise = null)
    {
        $data = [
            'service_id' => $service_id,
            'fence_id'   => $fence_id,
        ];
        if (!is_null($keyword)) {
            $data['keyword'] = $keyword;
        }
        if (!is_null($fence_name)) {
            $data['fence_name'] = $fence_name;
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($denoise)) {
            $data['denoise'] = $denoise;
        }
        return $this->httpPost("/api/v3/fence/updatedistrictfence", $data, ['district', 'district_list']);
    }

    /**
     * 删除围栏
     * @param int $service_id service的唯一标识
     * @param array $fence_ids 围栏id列表
     * @param string $monitored_person 监控对象
     * @return mixed
     */
    public function delete($service_id, array $fence_ids = [], $monitored_person = null)
    {
        $data = [
            'service_id' => $service_id
        ];
        if (!empty($fence_ids)) {
            $data['fence_ids'] = implode(',', $fence_ids);
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        return $this->httpPost("/api/v3/fence/delete", $data, 'fence_ids');
    }

    /**
     * 查询围栏
     * @param int $service_id service的唯一标识
     * @param array $fence_ids 围栏id列表
     * @param string $monitored_person 监控对象
     * @param string $coord_type_output 输出坐标类型
     * @return array
     */
    public function lists($service_id, array $fence_ids = [], $monitored_person = null, $coord_type_output = null)
    {
        $data = [
            'service_id' => $service_id
        ];
        if (!empty($fence_ids)) {
            $data['fence_ids'] = implode(',', $fence_ids);
        }
        if (!is_null($monitored_person)) {
            $data['monitored_person'] = $monitored_person;
        }
        if (!is_null($coord_type_output)) {
            $data['coord_type_output'] = $coord_type_output;
        }
        return $this->httpGet("/api/v3/fence/list", $data, ['size', 'fences']);
    }

    /**
     * 增加围栏需监控的entity
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param int $fence_id 围栏的唯一标识
     * @param string $monitored_person 监控对象，支持多个，使用英文逗号分隔
     * @return bool
     */
    public function addmonitoredperson($service_id, $fence_id, $monitored_person)
    {
        $data = [
            'service_id'       => $service_id,
            '$fence_id'        => $fence_id,
            'monitored_person' => $monitored_person
        ];
        $rst = $this->httpPost("/api/v3/fence/addmonitoredperson", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除围栏可去除监控的entity
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param int $fence_id 围栏的唯一标识
     * @param string $monitored_person 监控对象，支持多个，使用英文逗号分隔
     * @return bool
     */
    public function deletemonitoredperson($service_id, $fence_id, $monitored_person)
    {
        $data = [
            'service_id'       => $service_id,
            '$fence_id'        => $fence_id,
            'monitored_person' => $monitored_person
        ];
        $rst = $this->httpPost("/api/v3/fence/deletemonitoredperson", $data, 'status');
        if ($rst === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 查询围栏监控的所有entity
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param int $fence_id 围栏的唯一标识
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function listmonitoredperson($service_id, $fence_id, $page_index = 1, $page_size = 100)
    {
        $data = [
            'service_id' => $service_id,
            'fence_id'   => $fence_id,
            'page_index' => $page_index,
            'page_size'  => $page_size
        ];
        return $this->httpGet("/api/v3/fence/listmonitoredperson", $data, ['total', 'size', 'monitored_person']);
    }

    /**
     * 查询监控对象相对围栏的状态
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param string $monitored_person 监控对象的 entity_name
     * @param array $fence_ids 围栏实体的id列表,若不填，则查询监控对象上的所有围栏状态
     * @return array
     */
    public function querystatus($service_id, $monitored_person, array $fence_ids = [])
    {
        $data = [
            'service_id'       => $service_id,
            'monitored_person' => $monitored_person
        ];
        if (!empty($fence_ids)) {
            $data['fence_ids'] = implode(',', $fence_ids);
        }
        return $this->httpGet("/api/v3/fence/querystatus", $data, ['size', 'monitored_statuses']);
    }

    /**
     * 查询某监控对象的围栏报警信息
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param string $monitored_person 监控对象的 entity_name
     * @param array $fence_ids 围栏实体的id列表,若不填，则查询监控对象上的所有围栏状态
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param string $coord_type_output 返回坐标类型
     * @return array
     */
    public function historyalarm($service_id, $monitored_person, array $fence_ids = [], $start_time = null, $end_time = null, $coord_type_output = null)
    {
        $data = [
            'service_id'       => $service_id,
            'monitored_person' => $monitored_person
        ];
        if (!empty($fence_ids)) {
            $data['fence_ids'] = implode(',', $fence_ids);
        }
        if (!is_null($start_time)) {
            $data['start_time'] = $start_time;
        }
        if (!is_null($end_time)) {
            $data['end_time'] = $end_time;
        }
        if (!is_null($coord_type_output)) {
            $data['coord_type_output'] = $coord_type_output;
        }
        return $this->httpGet("/api/v3/fence/historyalarm", $data, ['size', 'alarms']);
    }

    /**
     * 批量查询所有围栏报警信息.批量查询某 service 7天内任意1小时，所有围栏的报警信息。
     * @param int $service_id 该围栏实体所属的轨迹服务ID
     * @param int $start_time 开始时间戳
     * @param int $end_time 结束时间戳
     * @param string $coord_type_output 返回坐标类型
     * @param int $page_index 分页索引
     * @param int $page_size 分页大小
     * @return array
     */
    public function batchhistoryalarm($service_id, $start_time, $end_time, $coord_type_output = 'bd09ll', $page_index = 1, $page_size = 500)
    {
        $data = [
            'service_id'        => $service_id,
            'start_time'        => $start_time,
            'end_time'          => $end_time,
            'coord_type_output' => $coord_type_output,
            'page_index'        => $page_index,
            'page_size'         => $page_size
        ];
        return $this->httpGet("/api/v3/fence/batchhistoryalarm", $data, ['total', 'size', 'alarms']);
    }

    /**
     * 服务端围栏报警信息推送
     * @param callable $handle 操作方法，参数为所得的json数组，返回为[status, message]
     */
    public function notify(callable $handle)
    {
        header('Content-type: application/json');
        header('SignId: baidu_yingyan');
        $request = file_get_contents("php://input");
        if (empty($request)) {
            $out = [
                'status'  => 1,
                'message' => '未接收到参数'
            ];
            echo Json::encode($out);
            return;
        }
        $request = Json::decode($request);
        if (!$request) {
            $out = [
                'status'  => 2,
                'message' => '参数格式错误'
            ];
            echo Json::encode($out);
            return;
        }
        list($status, $message) = $handle($request);
        $out = [
            'status'  => $status,
            'message' => $message
        ];
        echo Json::encode($out);
    }
}
