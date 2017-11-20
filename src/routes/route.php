<?php

$app->get('/', function ($request, $response, $args) {

});


$app->get('/user/{id:[0-9]+}', 'Myapp\UserController:showUser')->setName('show-user-details');

$app->group('/admin', function () {
    $this->get('/login', 'Myapp\UserController:loginUser')->setName('user-login-form');
});



$app->get('/flash', function($request, $response, $args) {

    $messages = $this->flash->getMessages();

    print_r($messages);

    $test = $this->flash->getFirstMessage('Test');

    print_r($test);

});

$app->get('/view/{name}', function($request, $response, $args) {

    //print_r($args);

    $data['name'] = $request->getAttribute('name');

    return $this->view->render($response, 'home.html', $data);

});



$app->get('/admin', function($request, $response, $args) {
    return $response->withStatus(400)->write('Bad Request');
})->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "admin" => '$2y$10$hmVXO8kwt56be4IctTqm2ONvug43aWBeO77.CIePON/DbHkY6nF4C'
    ]
]));

$app->get('/redirect', function($request, $response, $args) {
    return $response->withStatus(302)->withHeader('Location', 'your-new-uri');
});

// csrf

//$app->add($container->get('csrf'));

$app->get('/foo', function ($request, $response, $args) {
    // CSRF token name and value
    $nameKey = $this->csrf->getTokenNameKey();
    $valueKey = $this->csrf->getTokenValueKey();
    $name = $request->getAttribute($nameKey);
    $value = $request->getAttribute($valueKey);

    echo $nameKey . ": " . $name;
    echo "<br>";
    echo $valueKey . ": " . $value;

})->add($container->get('csrf'));

$app->post('/bar', function ($request, $response, $args) {
    // CSRF protection successful if you reached
    // this far.
})->add($container->get('csrf'));