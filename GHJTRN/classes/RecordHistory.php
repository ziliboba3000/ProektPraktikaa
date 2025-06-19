<?php

abstract class RecordHistory {
    private $_id;
    private $_sources;
    private $_table;

    public $attributes;

    static function getTable() {
        $pieces = preg_split('/(?=[A-Z])/', self::class);
        foreach ($pieces as &$piece) $piece = strtolower($piece);

        return implode('_', $pieces);
    }
    public function __construct($data) {
        $this->_table = self::getTable();
        $this->_sources = $data;

        echo'<pre>';
        print_r($data);

        $data = array_merge($data[0], $data[1]);
        $this->_id = $data['id'];

        echo'<pre>';
        print_r($data);
        
        foreach ($data as $prop => $value) {
            $this->attributes[$prop] = $value;
            @$this->$prop = &$this->attributes[$prop];
        }
        
    }

    public function save() {
    }
}

?>