<?php

/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 04/08/2016
 * Time: 18:00
 */
class Validator
{
  private $_errors;

  private $_elems;

  private $_arr;

  public function __construct($post)
  {
    $this->_arr = $post;
  }

  public function add(String $name, Array $args)
  {
    $this->_elems[$name] = $args;
    return $this;
  }

  public function validate()
  {

    foreach ($this->_elems as $name => $args) {
      if (isset($this->_arr[$name]))
        $this->check($this->_arr[$name], $args);
    }
    return empty($this->_errors);
  }

  private function check($string, $constraints)
  {
    $length = strlen($string);
    $maxlen = rine($constraints['maxlen'], $length);
    $minlen = rine($constraints['minlen'], 0);
    $errorname = rine($constraints['errname'], "");
    if ($length < $minlen)
      $this->_errors[] = "Le champ \"" . $errorname . "\" doit contenir au moins " . $minlen . " caractères.";
    if ($length > $maxlen)
      $this->_errors[] = "Le champ \"" . $errorname . "\" doit contenir au plus " . $maxlen . " caractères.";
    if (isset($constraints['regex'])) {
      if (!preg_match("/" . $constraints['regex'] . "/", $string, $res))
        $this->_errors[] = "Veuillez remplir le champ \"" . $errorname . "\" correctement";
    }
  }

  public function constraint($value1, $value2, $constraint, $error_msg = NULL)
  {
    $error = rine($error_msg, "Les champs " . $value1 . " et " . $value2 . " ne respectent pas la contrainte");
    if ($constraint == "equals" && $this->_arr[$value1] != $this->_arr[$value2])
      $this->_errors[] = $error;
    elseif ($constraint == "not equals" && $this->_arr[$value1] == $this->_arr[$value2])
      $this->_errors[] = $error;
    return $this;
  }
  public function getErrors()
  {
    return $this->_errors;
  }
  public function addCustomError($string)
  {
    $this->_errors[] = $string;
  }
}