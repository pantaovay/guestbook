<?php

class Loader
{
    /**
     * 加载第三方库路径
     */
    public static function includeLibrary()
    {
        $libraryPath = dirname(__FILE__) . '/library';
        set_include_path(get_include_path() . PATH_SEPARATOR . $libraryPath);
    }

    /**
     * uri解析
     */
    public static function extractUri()
    {
        $route = array();
        $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $uri = ltrim($uri, '/');
        empty($uri) && $uri = Tool_Basic::getConfig('defaultController') . '/';
        if (false === strpos($uri, '/')) {
            $uri .= '/';
        }
        // 默认控制器
        $uri = explode('/', $uri);
        $route['method'] = array_pop($uri);
        empty($route['method']) && $route['method'] = 'index';
        $route['controller'] = 'controller_' . implode('_', $uri);

        return $route;
    }

    /**
     * 自动加载类autoLoad
     */
    public static function autoLoad($class)
    {
        $class = strtolower($class);
        $file = str_replace('_', '/', $class) . '.php';
        file_exists($file) && require $file;

        return class_exists($class);
    }
}
