<?php

namespace fize\third\baidu;

use fize\third\baidu\Map as Common;

/**
 * 百度鹰眼接口请求基类
 */
class YingYan extends Common
{
    /**
     * 主URL域名
     */
    protected static $DOMAIN_API = "http://yingyan.baidu.com";

    /**
     * 实例化
     * @param string $ak 应用AK
     * @param string $sk SK
     */
    public function __construct($ak, $sk = null)
    {
        parent::$DOMAIN_API = self::$DOMAIN_API;
        parent::__construct($ak, $sk);
    }
}
