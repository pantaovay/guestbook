<?php
/**
 * Class Model_GuestBook
 * 单例模式 保证全局唯一实例
 */
class Model_GuestBook
{
    private static $_instance;
    private static $dataFile;
    private static $messages;

    private function __construct($dataFile)
    {
        self::$dataFile = $dataFile;
        self::$messages = json_decode(file_get_contents($dataFile), true);
    }

    public static function getInstance()
    {
        if (empty(self::$_instance))
        {
            self::$_instance = new Model_GuestBook(Tool_Basic::getConfig('dataFile'));
        }

        return self::$_instance;
    }

    public function save($content)
    {
        $message = new Model_Message($content);
        $messages = self::$messages;
        $messages[$message->getUid()] = $message->__toArray();
        file_put_contents(self::$dataFile, json_encode($messages));
        return $message;
    }

    public function delete($uid)
    {
        $messages = self::$messages;
        unset($messages[$uid]);
        file_put_contents(self::$dataFile, json_encode($messages));
    }

    public function getMessages()
    {
        return self::$messages;
    }
}