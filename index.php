<?php
header('Content-type: text/html; charset=utf-8');

  function getPth($sngp='') {

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
      $fin = "\\";
    else
      $fin = "/";

    if (!isset($sngp) || empty($sngp)) {
  
      $len_s = strlen( __DIR__ );
      $num_p = strrpos( __DIR__, $fin);

      if ($len_s != $num_p)
        $pathy = __DIR__.$fin;
      else
        $pathy = __DIR__;
    	
    } else {
      $pathy = $fin;
    }

    return $pathy;

  }
  
  $path_page = getPth();
  $slg = getPth(1);
  
  include($path_page.'inc'.$slg.'config.php');

  $ts = array_merge($base, $pwdLang);

  echo $pass->sysTemplate($ts, $path_page.'tpl'.$slg.'index.html');