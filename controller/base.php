<?php

class Controller_Base
{
    protected $tpl_path = 'tpl/'; // 模板路径

    /**
     * render页面
     */
    protected function render($vars, $tpl)
    {
        extract($vars);
        require strtolower($this->tpl_path . $tpl) . '.phtml';
    }
}
