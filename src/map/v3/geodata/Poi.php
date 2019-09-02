<?php
/*
 * 百度地图LBS云存储API接口
 */

namespace fize\third\baidu\map\v3\geodata;


use fize\third\baidu\map\Api;
use CURLFile;

/**
 * 位置数据操作接口
 *
 * @author Fize
 */
class Poi extends Api
{
	
	/**
	 * 创建数据
	 * @param int $geotable_id 记录关联的geotable的标识
	 * @param float $latitude 用户上传的纬度
	 * @param float $longitude 用户上传的经度
	 * @param int $coord_type 1.GPS经纬度坐标，2.国测局加密经纬度坐标，3.百度加密经纬度坐标，4.百度加密墨卡托坐标
	 * @param string $title Poi名称
	 * @param string $address 地址
	 * @param string $tags 标签
	 * @param array $column 自定义列数组
	 * @return int 成功时返回自增id，错误返回false
	 */
	public function create($geotable_id, $latitude, $longitude, $coord_type, $title = null, $address = null, $tags = null, array $column = null){		
		$data = [
			'title' => empty($title) ? '' : $title,
			'address' => empty($address) ? '' : $address,
			'tags' => empty($tags) ?  '' : $tags,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'coord_type' => $coord_type,
			'geotable_id' => $geotable_id,
		];
		
		if(!empty($column)){
			$data = array_merge($data, $column);
		}
		
		var_dump($data);
		
		return $this->httpPost("/geodata/v3/poi/create", $data, 'id');
	}
	
	/**
	 * 查询指定条件的数据
	 * @param int $geotable_id 指定表ID
	 * @param int $page_index 分页索引，默认为0，最大为9
	 * @param int $page_size 分页数目，默认为10，上限为200
	 * @param string $title 记录（数据）名称
	 * @param string $tags 记录的标签（用于检索筛选）
	 * @param string $bounds 查询的矩形区域，格式x1,y1;x2,y2分别代表矩形的左上角和右下角
	 * @param array $column 自定义数组查询
	 * @return array 返回结果，含size,total,pois，错误返回false
	 */
	public function lists($geotable_id, $page_index = 0, $page_size = 10, $title = null, $tags = null, $bounds = null, array $column = null){
		
		$data = [
			'geotable_id' => $geotable_id,
			'page_index' => $page_index,
			'page_size' => $page_size
		];
		if(!is_null($title)){
			$data['title'] = $title;
		}
		if(!is_null($tags)){
			$data['tags'] = $tags;
		}
		if(!is_null($bounds)){
			$data['bounds'] = $bounds;
		}
		if(!empty($column)){
			$data = array_merge($data, $column);
		}
		
		return $this->httpGet("/geodata/v3/poi/list", $data, ['size', 'total', 'pois']);
	}
	
	/**
	 * 查询指定id数据
	 * @param int $geotable_id poi主键
	 * @param int $id 表主键
	 * @return array 成功时返回POI信息数组，错误返回false
	 */
	public function detail($geotable_id, $id){
		
		$data = [
			'geotable_id' => $geotable_id,
			'id' => $id
		];
		
		return $this->httpGet("/geodata/v3/poi/detail", $data, 'poi');
	}
	
	/**
	 * 修改数据
	 * 不需要修改的参数请传递null
	 * @param int $geotable_id 表ID
	 * @param float $latitude 纬度，必填项
	 * @param float $longitude 经度，必填项
	 * @param int $coord_type 用户上传的坐标的类型，必填项 1．GPS经纬度坐标，2．测局加密经纬度坐标，3．度加密经纬度坐标，4．度加密墨卡托坐标
	 * @param int $id Poi的id，如果$column中存在自定义唯一索引key，则id可以不指定(即为null)
	 * @param array $column 自定义列,自定义唯一索引key也在此指定查询，其他字段则进行修改
	 * @param string $title Poi名称
	 * @param string $address 地址
	 * @param string $tags 标签
	 * @return boolean
	 */
	public function update($geotable_id, $latitude, $longitude, $coord_type, $id = null, array $column = null, $title = null, $address = null, $tags = null){
		
		$data = ['geotable_id' => $geotable_id];
		if(!is_null($id)){
			$data['id'] = $id;
		}
		if(!is_null($title)){
			$data['title'] = $title;
		}
		if(!is_null($address)){
			$data['address'] = $address;
		}
		if(!is_null($tags)){
			$data['tags'] = $tags;
		}
		if(!is_null($latitude)){
			$data['latitude'] = $latitude;
		}
		if(!is_null($longitude)){
			$data['longitude'] = $longitude;
		}
		if(!is_null($coord_type)){
			$data['coord_type'] = $coord_type;
		}
		if(!empty($column)){
			$data = array_merge($data, $column);
		}
		
		$rst = $this->httpPost("/geodata/v3/poi/update", $data, 'status');
		if($rst === 0){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 删除数据，可支持批量删除
	 * @param int $geotable_id 指定表ID
	 * @param mixed $id 为null时不指定，为0时删除全部，数字或者数字字符串时指定唯一id，数组或者以,分隔的id列表指定多个id
	 * @param string $title 左右匹配标题，为null时不指定
	 * @param string $tags 匹配标签，为null时不指定
	 * @param string $bounds 指定查询的矩形区域，格式x1,y1;x2,y2分别代表矩形的左上角和右下角，为null时不指定
	 * @param array $column 自定义的查询键值对，为null时不指定
	 * @return mixed 单个时返回数据id(int)，批量时返回任务id(string)，错误返回false
	 */
	public function delete($geotable_id, $id = null, $title = null, $tags = null, $bounds = null, array $column = null){
		$data = ['geotable_id' => $geotable_id];
		if(!is_null($id)){
			if($id === 0){
				$data['is_total_del'] = 1;
			}else{
				if(is_array($id)){ //数组ids
					$data['ids'] = implode(',', $id);
					$data['is_total_del'] = 1;
				}elseif(is_numeric($id)){ //数字为单个id
					$data['id'] = $id;
				}else{ //以,分隔的id列表
					$data['ids'] = $id;
					$data['is_total_del'] = 1;
				}
			}
		}
		if(!is_null($title)){
			$data['title'] = $title;
		}
		if(!is_null($tags)){
			$data['tags'] = $tags;
		}
		if(!is_null($bounds)){
			$data['bounds'] = $bounds;
		}
		if(!empty($column)){
			$data = array_merge($data, $column);
		}
		
		$rst = $this->httpPost("/geodata/v3/poi/delete", $data, 'id');
		if(empty($rst)){
			return false;
		}else{
			return $rst;
		}
	}
	
	/**
	 * 批量上传数据文件
	 * @param int $geotable_id 指定表ID
	 * @param string $poi_list_file 要上传的CSV文件路径
	 * @param int $timestamp 时间戳，默认为当前
	 * @return string 返回操作任务id(string)，错误时返回false
	 */
	public function upload($geotable_id, $poi_list_file, $timestamp = null){
		$data = [
			'geotable_id' => $geotable_id,
			'poi_list' => new CURLFile($poi_list_file),
		];
		if(!empty($this->sk)){
			if(is_null($timestamp)){
				$timestamp = time();
			}
			$data['timestamp'] = $timestamp;
		}
		
		return $this->httpPost("/geodata/v3/poi/upload", $data, 'job_id');
	}
}