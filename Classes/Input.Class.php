<?php

/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/08/2016
 * Time: 21:54
 */
class Input
{
    public $type = "text";
    public $name;
    public $placeholder;
    public $required = false;
    private $validation;

    public function __construct(Array $attr, Array $validation)
    {
        $this->name = $attr['name'];
        $this->placeholder = $attr['placeholder'];
        $this->validation = $validation;
    }

    public function check()
    {

    }
}