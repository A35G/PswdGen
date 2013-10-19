<?php

  class PswdGen {
  
    var $incode;
    var $dpub = first_pub;
    var $author = author_script;
	  var $template;

    private function getFile($doc) {

    	@ob_start();

    	include($doc);

    	$contenuto = @ob_get_contents();

    	@ob_end_clean();

    	return $contenuto;

  	}

    private function parserT($ts) {

    	if (@count($ts) > 0) {

      	foreach($ts as $t => $d) {

        	$d = (@file_exists($d)) ? $this->getFile($d) : $d;

        	$this->template = @str_replace("[[".$t."]]", $d, $this->template);

      	}

    	} else { die($this->getErrorTemp("Error during replace the tags!")); }
  	
  	}

	  function sysTemplate($ts, $tpl) {

      (@file_exists($tpl)) ? $this->template = @file_get_contents($tpl) : die($this->getErrorTemp("{$tpl} not exists!"));

      $this->parserT($ts);
      
      return $this->template;

  	}

    private function getCopy() {
        
      $data_pub = $this->dpub;
      $scr_auth = $this->author;
      $act_year = date('Y');

      if(intval($data_pub) == intval($act_year)) {$copyd = intval($data_pub);}
      elseif(intval($data_pub) < intval($act_year)) {$copyd = intval($data_pub)." - ".intval($act_year);}

      return $copyd."&nbsp;".$scr_auth;
    
    }

    private function checkLang() {
      $langs = array();
      if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
        if (count($lang_parse[1])) {
          $langs = array_combine($lang_parse[1], $lang_parse[4]);
          foreach ($langs as $lang => $value) {
            if (empty($value)) $langs[$lang] = 1;
          }
          arsort($langs, SORT_NUMERIC);
        }
      }
      
      foreach ($langs as $lang => $value) { break; }
      
      if (stristr($lang,"-")) {
        $tmp = explode("-",$lang);
        $lang = $tmp[0];
      }
      
      return $lang;
      
    }

    function parse_lang($text_l, $_LANG) {
      
      if ( array_key_exists ( $text_l, $_LANG ) ) {
        return $this->textpl = str_replace ( $text_l, $_LANG[$text_l], $text_l );
      }
  
    }

    function scriptCopy() { return $this->getCopy(); }
    function searchLang() { return $this->checkLang(); }
  	
  	function getErrorTemp($t_err) { return $t_err; }

  }