/**
 *  Core JS for PassGen script
 *  vers. 0.2.0.1 - Oct 2013
 *  Base version - In development
 *  
 *  Gianluigi 'A35G'
 *  http://www.hackworld.it/     
*/

function empty(mixed_var) {
  return ( mixed_var === '' || mixed_var === 0 || mixed_var === '0' || 
  mixed_var === null || mixed_var === false || mixed_var === undefined || 
  mixed_var.length === 0 );
}

function isNum(num) {
  return (!isNaN(num) && !isNaN(parseFloat(num)));
}

jQuery.ajaxSetup({
  cache: false
});

var chkb = new Array ( 'opt1', 'opt2', 'opt3', 'opt4' );

function selAll() {

  for ( var c=0; c < chkb.length; c++)
    $('#'+chkb[c]+'').attr('checked', 'checked');
    
  return '1|1|1|1_4';

}

function checkOpt() {

  var datastr = ''; var err = 0;

  for (var i=0; i < chkb.length; i++) {

    if (!$('#'+chkb[i]+'').attr('checked')) {
      datastr += '0|'; err++;
    } else {
      datastr += '1|';
    }

  }
  
  datastr = datastr.substr(0, (datastr.length -1));

  if (err == chkb.length)
    datastr = selAll();
  else
    datastr += "_" + ( chkb.length - err );
  
  return datastr;

}

function gen(dim_pswd) {

  var datastr = checkOpt();
  
  var length_pswd = dim_pswd;

  if(!empty(length_pswd)) {
    if(isNum(length_pswd))
      var inum = parseInt(length_pswd);
    else
      var inum = ''; 
  } else {
    var inum = '';
  }
  
  if (!empty(datastr)) {

    $.ajax({
      type: 'GET',
      url: 'pages/get.php',
      data: {tip_r: datastr, dim_p: inum},
      cache: false,
      success: function(result){
        if (!empty(result))
          $('#box_text').html(result);
      }
    })
    
  }

}

$(document).ready(function() {
  gen();
});