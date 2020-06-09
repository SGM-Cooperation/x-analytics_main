<?php
// +++++++++++++++++
//  Put INIT file at top of every page
// +++++++++++++++++

// session start

// Globals Config ?

spl_autoload_register("autoloader");

function autoloader($className)
{
  $path = "classes/";
  $extension = ".class.php";
  $fullPath = $path . $className . $extension;
  echo $fullPath;
  if(!file_exists($fullPath)){
    return false;
  }
  include_once $fullPath;
}

include "functions/sanitize.func.php";
