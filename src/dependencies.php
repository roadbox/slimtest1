<?php

$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['name'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['logger'] = function($c) {
    $logfile = $c->get('settings')['monolog']['logfile'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($logfile);
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['view'] = function ($c) {
    $v = $c->get('settings')['view'];
    $view = new \Slim\Views\Twig($v['template_path'], $v['twig']);  
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());
    $view->addExtension(new Myapp\TwigExtension($c['flash']));

    return $view;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};

//----------

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response->withStatus(404), 'errors/404.html');
    };
};

//----------

$container['Myapp\UserController'] = function ($c) {
    return new Myapp\UserController($c['db'], $c['view'], $c['router'], $c['flash'], $c['logger']);
};