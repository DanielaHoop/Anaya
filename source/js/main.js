

$(document).ready(function(){
	var dict = {
      "Home": {
        pt: "Inicio"
      },
      "Download plugin": {
         pt: "Descarregar plugin",
         en: "Download plugin"
      }
    }
    var translator = $('body').translate({lang: "en", t: dict}); //use English
    translator.lang("es"); //change to Portuguese

});


