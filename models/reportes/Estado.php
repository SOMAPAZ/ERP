<?php

namespace Reportes;

use Model\ActiveRecord;

class Estado extends ActiveRecord
{
    protected static $tabla = 'status_report';
    protected static $columnasDB = ['id', 'name'];

    public $id;
    public $name;
}
