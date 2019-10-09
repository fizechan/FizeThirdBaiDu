<?php

/*
 * 测试百度
 */

namespace app\controller;

use fize\third\baidu\map\v4\geodata\Geotable;
use fize\third\baidu\map\v4\geodata\Column;
use fize\third\baidu\map\v4\geodata\Poi;
use fize\third\baidu\map\v4\geodata\Job;
use fize\third\baidu\map\v3\Geosearch;
use fize\third\baidu\map\v1\Geocoder;
use fize\third\baidu\map\v2\Geocoder as GeocoderV2;
use fize\third\baidu\map\Location;
use fize\third\baidu\map\v1\TimeZone;
use fize\third\baidu\map\Parking;


class ControllerFizeBaidu
{
    /**
     * @var Geotable
     */
    private $geotable;

    /**
     * @var Column
     */
    private $column;

    /**
     * @var Poi
     */
    private $poi;

    /**
     * @var Job
     */
    private $job;

    /**
     * @var Geosearch
     */
    private $geosearch;

    /**
     * @var Geocoder
     */
    private $geocoding;

    /**
     * @var GeocoderV2
     */
    private $geocoderV2;

    /**
     * @var TimeZone
     */
    private $timezone;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var Parking
     */
    private $parking;

    public function __construct()
    {
        $ak = 'w8rN8ROTU5tmN1HnGBgf1GvSUNuwvRwz';
        $sk = 'OqrEINdaRtAfbkM74FH3Sa1e6LbM3Mud';
        $this->geotable = new Geotable($ak, $sk);
        $this->column = new Column($ak, $sk);
        $this->poi = new Poi($ak, $sk);
        $this->job = new Job($ak, $sk);
        $this->geosearch = new Geosearch($ak, $sk);
        $this->geocoding = new Geocoder($ak, $sk);
        $this->geocoderV2 = new GeocoderV2($ak, $sk);
        $this->location = new Location($ak, $sk);
        $this->timezone = new TimeZone($ak, $sk);
        $this->parking = new Parking($ak, $sk);
    }

    public function actionGeotableCreate()
    {
        $id = $this->geotable->create('好租客2');
        var_dump($id);
    }

    public function actionGeotableLists()
    {
        $list = $this->geotable->lists();
        var_dump($list);
    }

    public function actionGeotableDetail()
    {
        $id = '1000003167';
        $geotables = $this->geotable->detail($id);
        var_dump($geotables);
    }

    public function actionGeotableUpdate()
    {
        $id = '1000003167';
        $result = $this->geotable->update($id, 1, '好租客32');
        var_dump($result);
    }

    public function actionGeotableDelete()
    {
        $id = '1000003167';
        $geotables = $this->geotable->delete($id);
        var_dump($geotables);
    }

    public function actionColumnCreate()
    {
        $geotable_id = '1000003168';
        $name = '店名';
        $key = 'name';
        $type = 3;
        $is_search_field = 1;
        $is_index_field = 1;
        $id = $this->column->create($geotable_id, $name, $key, $type, $is_search_field, $is_index_field);
        var_dump($id);
    }

    public function actionColumnLists()
    {
        $geotable_id = '1000003168';
        $list = $this->column->lists($geotable_id);
        var_dump($list);
    }

    public function actionColumnDetail()
    {
        $geotable_id = '1000003168';
        $id = '1000004112';
        $column = $this->column->detail($geotable_id, $id);
        var_dump($column);
    }

    public function actionColumnUpdate()
    {
        $geotable_id = '1000003168';
        $id = '1000004112';
        $result = $this->column->update($geotable_id, $id, '好租客32');
        var_dump($result);
    }

    public function actionColumnDelete()
    {
        $geotable_id = '1000003168';
        $id = '1000004112';
        $geotables = $this->column->delete($geotable_id, $id);
        var_dump($geotables);
    }

    public function actionPoiCreate()
    {
        $geotable_id = '1000003168';
        $latitude = 24.514668;
        $longitude = 117.645733;
        $coord_type = 3;
        $title = '闽南师范大学达理公寓';
        $address = '前直街360号';
        $tags = '学校 大学 公寓';
        $id = $this->poi->create($geotable_id, $latitude, $longitude, $coord_type, $title, $address, $tags);
        var_dump($id);
    }

    public function actionPoiLists()
    {
        $geotable_id = '1000003168';
        $coord_type = 3;
        $list = $this->poi->lists($geotable_id, $coord_type);
        var_dump($list);
    }

    public function actionPoiDetail()
    {
        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $column = $this->poi->detail($geotable_id, $id);
        var_dump($column);
    }

    public function actionPoiUpdate()
    {
        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $result = $this->poi->update($geotable_id, $id, '达理公寓');
        var_dump($result);
    }

    public function actionPoiDelete()
    {
        $geotable_id = '1000003168';
        $id = '962598629107867867';
        $result = $this->poi->delete($geotable_id, $id);
        var_dump($result);
    }

    public function actionPoiUpload()
    {
        $geotable_id = '1000003168';
        $file = 'H:\baidu.csv';
        $result = $this->poi->upload($geotable_id, $file);
        var_dump($this->poi->errMsg);
        var_dump($result);
    }

    public function actionJobLists()
    {
        $geotable_id = '1000003168';
        //$job_id = '962611269125308068';
        $job_id = null;
        $list = $this->job->lists($geotable_id, $job_id);
        var_dump($this->job->errMsg);
        var_dump($list);
    }

    public function actionGeosearchNearby()
    {
        $geotable_id = '163461';
        $location = '114.178956,22.269999';
        $result = $this->geosearch->nearby($geotable_id, $location);
        var_dump($this->geosearch->errMsg);
        var_dump($result);
    }

    public function actionGeosearchBound()
    {
        $geotable_id = '163461';
        $bounds = '113.178956,21.269999;115.178956,23.269999';
        $result = $this->geosearch->bound($geotable_id, $bounds, '');
        var_dump($this->geosearch->errMsg);
        var_dump($result);
    }

    public function actionGeosearchLocal()
    {
        $geotable_id = '163461';
        $q = '博物馆';
        $result = $this->geosearch->local($geotable_id, $q);
        var_dump($this->geosearch->errMsg);
        var_dump($result);
    }

    public function actionGeosearchDetail()
    {
        $geotable_id = '163461';
        $uid = '2014103527';
        $result = $this->geosearch->detail($geotable_id, $uid);
        var_dump($this->geosearch->errMsg);
        var_dump($result);
    }

    public function actionGeocodingCloudgc()
    {
        $q = '博物馆';
        $geotable_id = '163461';
        $result = $this->geocoding->cloudgc($q, null, $geotable_id);
        var_dump($this->geocoding->errMsg);
        var_dump($result);
    }

    public function actionGeocodingCloudrgc()
    {
        $geotable_id = '163461';
        $location = '22.270,114.179';
        $result = $this->geocoding->cloudrgc($location, $geotable_id, null, 'bd09ll');
        var_dump($this->geocoding->errMsg);
        var_dump($result);
    }

    public function actionGeocoderV2Encode()
    {
        $address = '软件园二期';
        $city = '厦门';
        $result = $this->geocoderV2->encode($address, $city);
        var_dump($result);
        var_dump($this->geocoderV2->errMsg);
        var_dump($this->geocoderV2->errCode);
    }

    public function actionGeocoderV2Decode()
    {
        $location = '24.489894054258,118.18747373356';
        $result = $this->geocoderV2->decode($location);
        var_dump($result);
        var_dump($this->geocoderV2->errMsg);
        var_dump($this->geocoderV2->errCode);
    }

    public function actionLocationIp()
    {
        $result = $this->location->ip();
        var_dump($result);
        var_dump($this->geocoderV2->errMsg);
        var_dump($this->geocoderV2->errCode);
    }

    public function actionTimeZone()
    {
        $location = '24.489894054258,118.18747373356';
        $result = $this->timezone->timezone($location);
        var_dump($result);
        var_dump($this->timezone->errMsg);
        var_dump($this->timezone->errCode);
    }

    public function actionParking()
    {
        $location = '24.489894054258,118.18747373356';
        $location = '118.18747373356,24.489894054258';
        $result = $this->parking->search($location);
        var_dump($result);
        var_dump($this->parking->errMsg);
        var_dump($this->parking->errCode);
    }
}
