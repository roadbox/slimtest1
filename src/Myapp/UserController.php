<?php

namespace Myapp;

final class UserController
{
    private $view;
    private $router;
    private $flash;
    private $db;
    private $logger;

    public function __construct($db, $view, $router, $flash, $logger)
    {
        $this->view = $view;
        $this->router = $router;
        $this->flash = $flash;
        $this->db = $db;
        $this->logger = $logger;
    }

    public function showUser($request, $response, $args)
    {

        $this->logger->info("Showing user");

        $this->flash->addMessage('User', 'User displayed');

        $data = array();

        $data['user_name'] = 'Bill';
        $data['user_id'] = $args['id'];

        //echo $request->getAttribute('id');

        return $this->view->render($response, 'user.html', $data);
    }

    public function loginUser($request, $response, $args)
    {

        $this->logger->info("Showing user login form");

        $this->flash->addMessage('User', 'User login form displayed');

        $data = array();

        //echo $request->getAttribute('id');

        return $this->view->render($response, 'admin/user-login.html', $data);
    }    

}
