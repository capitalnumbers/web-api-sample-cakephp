<?php

namespace App\Controller;

class PostsController extends AppController {

    public function getAll() {
        $this->autoRender = false;
        $this->response->type('json');
        $json = json_encode(array('message' => 'Test Josn Response'));
        $this->response->body($json);
    }

}
