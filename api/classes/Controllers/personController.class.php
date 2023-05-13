<?php

namespace Controllers;

use Models\Person;

class personController {

    
    public function index() {
        $person = new Person();
        echo json_encode($person->all());
    }

    public function show($id) {
        $person = new Person();
        echo json_encode( $person->show($id));
    }

    public function store($data) {
        $person = new Person();
        echo json_encode( $person->store($data));
    }

    public function update($data, $id) {
        $person = new Person();
        echo json_encode( $person->update($data, $id));
    }

    public function destroy($id) {
        $person = new Person();
        echo json_encode( $person->delete($id));
    }
}
