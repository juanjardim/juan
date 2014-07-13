<?php

class IndexController extends Zend_Controller_Action
{

    public function init()    {
    }

    public function indexAction()    {

 }


    public function contactAction() {
        $this->view->isPost = $this->getRequest()->isPost();
        $this->view->isPostOk = true;
        if (!$this->getRequest()->isPost())
            $this->_helper->redirector->setCode(404);

        $this->_helper->layout->setLayout('contact-layout');

        $data = $this->getRequest()->getPost();

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $name = $firstname .  " " . $lastname;
        $email = $data['email'];
        $message = $data['message'];
        try {
            $headers    = array
            (
                'MIME-Version: 1.0',
                'Content-Type: text/html; charset="UTF-8";',
                'Content-Transfer-Encoding: 7bit',
                'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
                'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
                'From: ' . $email,
                'Reply-To: ' .  $email,
                'Return-Path: ' .  $email,
                'Cc:'.$email,
                'X-Mailer: PHP/' . phpversion(),
                'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
                );


            mail('juanjardim@gmail.com', '=?UTF-8?B?' . base64_encode("You have got a message from: $name") . '?=', $message, implode("\n", $headers));

        } catch (Exception $e) {
            $this->view->isPostOk = false;
            $this->view->error = $e;
            return;
        }


    }


    public function portfolioAction(){
        $this->_helper->layout->setLayout('portfolio-layout');
    }

}





