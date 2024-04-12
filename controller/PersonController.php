<?php

namespace Controller;

use Model\Connect;

class PersonController
{

    public function addPerson(): void
    {

        require "view/persons/addPerson.php";
    }
}