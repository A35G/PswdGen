<?php

	class sysTemplate {

	  var $template;

	  function sysTemplate ($tpl) {

      (@file_exists($tpl)) ? $this->template = @file_get_contents($tpl) : die ($this->getErrorTemp("{$tpl} not exists!"));

    	@ob_start();

    	$contenuto = @ob_get_contents();

    	@ob_end_clean();

  	}

  	function getErrorTemp($t_err) { return $t_err; }

  	function show() { return $this->template; }

	}