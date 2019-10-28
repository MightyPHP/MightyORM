<?php

namespace MightyORM;

class MODEL {

    protected $table = '';
    protected $connection = '';

    private $__db = null;

    public function __construct() {

        /**
         * If table not declared, assume the model class name
         */
        if(empty($this->table)){
            $this->table = str_replace('Model', '', static::class);
        }

        /**
         * If connection not declared, assume the default
         */
        if(empty($this->connection)){
            $this->connection = 'default';
        }

        /**
         * Initiates DB connection
         */
        $this->__db = new MYSQL\DB($this->connection);

        MYSQL\DB::describe($this->table, $this);
    }
}