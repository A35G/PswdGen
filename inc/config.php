<?php

/**
 *  PassGen - PHP Password Generator
 *  developed by Gianluigi 'A35G'
 *  http://www.hackworld.it
 *  
 *  Last rev. Oct 2013
 **/
  
  /** Default length of password **/
  define('default_length', 12);

  /** Default lang of script **/
  define('default_lang','en');
  
  /** Define default enabled values **/
  define('upp_chr', true);
  define('low_chr', true);
  define('num_chr', true);
  define('sym_chr', false);

  /** Please, don't edit **/

  /** Actual version of script **/  
  define('version_script', '0.1.11');

  /** Year of first publication **/
  define('first_pub', '2012');

  /** Script developer **/
  define('author_script', 'A35G');

  require_once($path_page.'inc'.$slg.'pswd.class.php');
  $pass = new PswdGen;
  
  $base = Array (
    'script_copy' => $pass->scriptCopy(),
    'upp_abl' => $pass->checkSel(upp_chr),
    'low_abl' => $pass->checkSel(low_chr),
    'num_abl' => $pass->checkSel(num_chr),
    'sym_abl' => $pass->checkSel(sym_chr),
    'len_phr' => default_length
  );
  
  $lng = $pass->searchLang();
  
  if ($lng) {
    if (@file_exists($path_page.'locale'.$slg.$lng.'.php')) {
      include($path_page.'locale'.$slg.$lng.'.php');
    } else {
      if(defined(default_lang))
        include($path_page.'locale'.$slg.default_lang.'.php');
      else
        include($path_page.'locale'.$slg.'en.php');
    }
  }