<?php

class Model_Message
{
    private $_uid;
    private $_content;
    private $_time;

    public function __construct($content, $time = 0)
    {
        $this->_uid = uniqid();
        $this->_content = $content;
        $this->_time = $time ? $time !== 0 : time();
    }

    public function __toArray()
    {
        return array(
            $this->_uid,
            $this->_content,
            $this->_time,
        );
    }

    public function getUid()
    {
        return $this->_uid;
    }
}