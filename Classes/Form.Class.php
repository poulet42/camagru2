<?php

/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/08/2016
 * Time: 20:44
 */
class Form
{

    static $verbose = false;

    public $method = "POST";

    public $action;

    private $inputs;

    private $errors;

    public $suffix;

    private $submit;

    public function __construct(Array $args)
    {
        $verboseLogs = "Création du formulaire" . PHP_EOL;
        if (!empty($args['method']) && $args['method'] == "GET")
            $this->method = $args['method'];
        else
            $verboseLogs .= "La methode spécifiée est incorrecte, POST sera utilisé par défaut" . PHP_EOL;
        if (!empty($args['action']))
            $this->action = $args['action'];
        if (!empty($args['suffix']))
            $this->suffix = $args['suffix'];
        if (self::$verbose) {
            echo $verboseLogs;
        }
    }

    public function addInput(Input $input)
    {
        $this->inputs[] = $input;
    }

    public function display()
    {
        echo "<form method='" . $this->method . "' >";
        foreach ($this->inputs as $input) {
            $name = !empty($this->suffix) ? $this->suffix . '[' . $input->name . ']' : $input->name;
            echo "<input type='", $input->type, "' name='", $name, "' placeholder= '" . $input->placeholder . "' >";
        }
        echo "<input type='submit' value='" . $this->submit . "' name='{$this->suffix}[submit]'>";
        echo '</form>';
    }

    public function validate($post)
    {
        foreach ($this->inputs as $input) {
            $this->errors[] = $input->check($post["$input->name"]);
        }

    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setSubmit($value)
    {
        $this->submit = $value;
    }
}