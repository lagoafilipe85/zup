<?php


// get all todos
$app->get('/api/todos', function ($request, $response, $args) {
     $sth = $this->db->prepare("SELECT * FROM modelos ORDER BY id ASC");
    $sth->execute();
    $todos = $sth->fetchAll();
    return $this->response->withJson($todos);
});

// Retrieve todo with id 
$app->get('/api/todo/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM modelos WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $todos = $sth->fetchObject();
    return $this->response->withJson($todos);
});


// Search for todo with given search teram in their name
$app->get('/api/todos/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM modelos WHERE UPPER(modelo) LIKE :query ORDER BY modelo");
    $query = "%".$args['query']."%";
    $sth->bindParam("query", $query);
    $sth->execute();
    $todos = $sth->fetchAll();
    return $this->response->withJson($todos);
});

// Add a new todo
$app->post('/api/todo', function ($request, $response) {
    $input = $request->getParsedBody();
    //var_dump($input['modelo']);
    $sql = "INSERT INTO modelos (name, description, price, category) VALUES (:name, :description, :price, :category)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("name", $input['name']);
    $sth->bindParam("description", $input['description']);
    $sth->bindParam("price", $input['price']);
    $sth->bindParam("category", $input['category']);
    $sth->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});
    

// DELETE a todo with given id
$app->delete('/api/todo/[{id}]', function ($request, $response, $args) {
     $sth = $this->db->prepare("DELETE FROM modelos WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $sth = $this->db->prepare("SELECT * FROM modelos ORDER BY id ASC");
    $sth->execute();
    $todos = $sth->fetchAll();
    return $this->response->withJson($todos);
});

// Update todo with given id
$app->put('/api/todo/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE modelos SET name=:name, description=:description, price=:price, category=:category WHERE id=:id";
     $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("name", $input['name']);
    $sth->bindParam("description", $input['description']);
    $sth->bindParam("price", $input['price']);
    $sth->bindParam("category", $input['category']);
    $sth->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});
    
$app->get('/modelo/[{id}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $args['slug'] = 'modelo';
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/[{slug}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
