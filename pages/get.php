<?php

  function randPass($upper=3,$lower=3,$numeric=3,$other=3) {

    $passOrder = Array(); $passWord = '';

    for($i=0; $i<$upper; $i++)
      $passOrder[] = chr(rand(65, 90));

    for($i=0; $i<$lower; $i++)
      $passOrder[] = chr(rand( 97, 122));

    for($i=0; $i<$numeric; $i++)
      $passOrder[] = chr(rand(48, 57));

	  for($i=0; $i<$other; $i++)
      $passOrder[] = chr(rand(33, 47));

	  shuffle ($passOrder);

	  foreach ($passOrder as $char)
      $passWord .= $char;

		return $passWord;

  }

  if (isset($_GET['tip_r']) && !empty($_GET['tip_r'])) {

    list($tips, $num) = explode("_", $_GET['tip_r']);

    switch($num) {                      
      case '1':
        $tips = str_replace("1", "12", $tips);
      break;
      case '2':
        $tips = str_replace("1", "6", $tips);
      break;
      case '3':
        $tips = str_replace("1", "4", $tips);
      break;
      case '4':
        $tips = str_replace("1", "3", $tips);
      break;    
    }

    $rp = explode("|", $tips);
    echo randPass($rp[0], $rp[1], $rp[2], $rp[3]);

  } else {
    echo randPass();
  }