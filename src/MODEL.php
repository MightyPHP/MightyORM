<?php

namespace MightyORM;

class MODEL {

    protected $table = '';
    protected $connection = '';

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

        DB\Connect($this->connection);
    }
}