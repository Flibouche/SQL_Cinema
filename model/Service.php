<?php

namespace Model;

use Model\Connect;

abstract class Service {

    public static function exists($table, $id) {

        $primaryKey = ucfirst($table);

        $pdo = Connect::toLogIn();
        $req = $pdo->prepare("SELECT * FROM $table WHERE id$primaryKey = :id");
        $req->execute(["id" => $id]);
        return $req->fetch();
    }
}