<?php 
//  interface Loader { }
  function my_autoload($classe) {
    if (file_exists('classes/' . $classe . '.class.php')) {
      require_once $classe . '.class.php';
    }
    elseif (file_exists('../classes/' . $classe . '.class.php')) {
      require_once $classe . '.class.php';
    }
  }
  spl_autoload_register('my_autoload');
?>
