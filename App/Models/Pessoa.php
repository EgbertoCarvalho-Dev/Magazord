<?php

namespace App\Models;

use App\Models\Base;

class Pessoa extends Base
{
    public function getPessoa()
    {

        echo $this->entityManager;

        die();
    }
}
