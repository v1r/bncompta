$(document).ready(function() { 	
    Cufon.replace('h1,h2,h4');
    $("select, input.mf,input, input:radio, input:file").uniform();
  
    $("ul.nav").superfish({
        animation:{
            height: "show",
            width: "show"
        }, 
        speed : 100
    });
    //tooltip
    $(".tooltip").easyTooltip();		
    // Accordion
    
    var icons = {
        header: "ui-icon-circle-arrow-e",
        headerSelected: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
        icons: icons,
        autoHeight: false
    });    
});
 