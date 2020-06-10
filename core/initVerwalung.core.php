<?php
if(isset($productVW)){
  if (!($productVW instanceof Produktverwaltung)){
    unset($productVW);
    $productVW = new Produktverwaltung();
  }
}else{
  $productVW = new Produktverwaltung();
}

if(isset($userVW)){
  if (!($userVW instanceof Nutzerverwaltung)){
    unset($userVW);
    $userVW = new Nutzerverwaltung();
  }
}else {
  $userVW = new Nutzerverwaltung();
}

?>
