<?php

class IndexController extends Zend_Controller_Action
{

    public function init()    {
        /* Initialize action controller here */
    }

    public function indexAction()    {
       $this->view->indexClass = "active";
       $this->view->contactClass = "";
       $this->view->portfolioClass = "";
   }

   /* public function aboutAction()
    {
        // action body
    }*/

    public function contactAction() {
        $this->view->indexClass = "";
        $this->view->contactClass = "active";
        $this->view->portfolioClass = "";

        $this->view->isPost = $this->getRequest()->isPost();
        $this->view->isPostOk = true;
        if (!$this->getRequest()->isPost()) 
            return;

        $data = $this->getRequest()->getPost();

        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];

        $config = array('port' => '25',
            'ssl' => 'tls', 
            'auth' => 'login', 
            'username' => 'juanjardim@gmail.com', 
            'password' => 'marinaxp1987');
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

        $mail = new Zend_Mail('utf-8');
        $mail->addTo("juanjardim@gmail.com");
        $mail->addCc($email);
        $mail->setSubject('Contact Submition');
        $mail->setFrom('juanjardim@gmail.com', 'Juan Jardim');
        
        $mail->setBodyHtml($message);
        try {
            $mail->send($transport);
        } catch (Exception $e) {
            $this->view->isPostOk = false;
            $this->view->error = $e;
            return;
        }

    }


    public function portfolioAction(){
        $this->view->indexClass = "";
        $this->view->contactClass = "";
        $this->view->portfolioClass = "active";

    }

}





