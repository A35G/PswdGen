function empty( mixed_var ) {
  return ( mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || mixed_var === undefined || mixed_var.length === 0 );
}

jQuery.ajaxSetup({
  cache: false
});

var chkb = new Array ( "opt1", "opt2", "opt3", "opt4" );

function gen() {

  var err = 0;
  var datastr = "";

  for ( var i = 0; i < chkb.length; i++ ) {

    if ( !$("#" + chkb[i] + "").attr ("checked") ) {

      datastr += "0|";
      err++;

    } else { datastr += "1|"; }

  }

  datastr = datastr.substr ( 0, ( datastr.length -1 ) );

  if ( err < chkb.length ) {

    datastr += "_" + ( chkb.length - err );

    $.ajax({
      type: "GET",
      url: "./pages/get.php",
      data: { tip_r: datastr },
      cache: false,
      success: function(result){
        if ( !empty ( result ) ) {
          $("#box_text").html ( result );
        }
      }
    })

  } else { alert("Selezionare almeno una tipologia!"); }

}

$(document).ready(function() {

  /*for ( var i = 0; i < chkb.length; i++ ) {
    $("#" + chkb[i] + "").attr ( "checked", "checked" );
  }*/

  $.ajax({
    type: "GET",
    url: "./pages/get.php",
    cache: false,
    success: function(result){
      if ( !empty ( result ) ) {
        $("#box_text").html ( result );
      }
    }
  })

});