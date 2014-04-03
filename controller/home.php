<?php

class Controller_Home extends Controller_Base
{
    private $guestBook;

    /*
     * 初始化guestBook全局实例
     */
    public function __construct()
    {
        $this->guestBook = Model_GuestBook::getInstance();
    }

    /**
     * 默认handler
     */
    public function index()
    {
        $data = array(
            'title' => '首页',
            'messages' => $this->guestBook->getMessages(),
        );
        $this->render($data, 'home');
    }

    public function add()
    {
        $content = $_POST['content'];
        $message = $this->guestBook->save($content);
        echo json_encode($message->__toArray());
    }

    public function del()
    {
        $uid = $_POST['uid'];
        $this->guestBook->delete($uid);
        echo json_encode(array('success'));
    }
}
