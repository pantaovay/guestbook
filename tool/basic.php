<?php

class Tool_Basic
{
    /**
     * 加载配置
     *
     * @param string $key 配置项
     *
     * @return array
     */
    public static function getConfig($key)
    {
        $config = require "config.php";

        return isset($config[$key]) ? $config[$key] : array();
    }
}
