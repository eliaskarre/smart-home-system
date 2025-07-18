
//Wischgesten Erkennung für Smartphone (Kopiert)

document.addEventListener('touchstart', handleTouchStart, false);        
document.addEventListener('touchmove', handleTouchMove, false);

var xDown = null;                                                        
var yDown = null;


//Setze URL Parameter für den Bearbeitungsmodus und den aktuell ausgewählten Reiter wenn nicht definiert

var url = new URL(window.location.href);

if (!url.searchParams.get("tab") && !url.searchParams.get("edit")) {

    window.history.pushState(null, null, '?tab=1');
    insertParam("edit","0");

}


//Ändere ausgewählten Reiter auf Wert im URL-Parameter

var url_tab = url.searchParams.get("tab")
var url_edit = url.searchParams.get("edit")

for (var i = 1; i <= 3; i++) {
    
    if (parseInt(url.searchParams.get("tab")) == i) {

    var menucounter = i;

    } 
}

if (!menucounter) {

    var menucounter = 1;
}


//Bearbeitungsmodus Style-Klassen zuordnen 

if (url.searchParams.get("edit") == "1") {

   $('.control_menu').removeClass("hide");
   $(document).ready(function() {
        $('.body').addClass("border_red");
        $('#editmode').addClass("activated");
    });
}


cleartabs();


//Wenn Seite geladen

window.onload = function() {
  
  update();

  if (url.searchParams.get("edit") == "1") { 
    $('.control_menu').toggleClass('hide');     //Zeige Bearbeitungsmodus-Elemente
   }
}


//Wischgesten Erkennung für Smartphone (Kopiert)

function getTouches(evt) {
  return evt.touches ||             // browser API
         evt.originalEvent.touches; // jQuery
}                                                     

function handleTouchStart(evt) {
    
    const firstTouch = getTouches(evt)[0];                                      
    xDown = firstTouch.clientX;                                      
    yDown = firstTouch.clientY;                                      
};                                                
update();
function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        
        return;
    }

    var xUp = evt.touches[0].clientX;                                    
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;

    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
        if ( xDiff > 0 && menucounter != 3 ) {
            
            menucounter++;
            update();
        } 

        if ( xDiff < 0 && menucounter != 1 ) {
            
            menucounter--;
            update();
        }                       
    } 

    /* reset values */
    xDown = null;
    yDown = null;                                             
};


//Menüführung -> Klick auf Menüelemente

$(document).ready(function() {
    
   $('#slide-item-1').click(function(){
    
    menucounter= 1;     //Ändere Menüvarible auf geklickten Reiter


    //Zeige Inhalt von geklickten Reiter und verstecke die anderen

    $('#tab2').addClass("hide");
    $('#tab3').addClass("hide");
    $('#tab4').addClass("hide");
    $('#tab1').removeClass("hide");
    $('#groups').removeClass("hide");

    setUrlParameter(window.location.href, "tab", "1");  //setze URL-Parameter auf geklickten Reiter 

    refresh = false;
    
    });

   $('#slide-item-2').click(function(){
    
    menucounter= 2;

    $('#tab1').addClass("hide");
    $('#tab3').addClass("hide");
    $('#tab4').addClass("hide");
    $('#tab2').removeClass("hide");
    $('#groups').removeClass("hide");

    setUrlParameter(window.location.href, "tab", "2");

    refresh = false;
    
    });

   $('#slide-item-3').click(function(){
    
    menucounter= 3;

    $('#tab1').addClass("hide");
    $('#tab2').addClass("hide");
    $('#tab4').addClass("hide");
    $('#groups').addClass("hide");
    $('#tab3').removeClass("hide");

    setUrlParameter(window.location.href, "tab", "3");
    
    refresh = true;     //Scanner soll nur im Reiter "Verwaltung" Daten aktualisieren

    });
});


//Wenn Menüvarible geändert -> update()-Funktion -> Simuliere Klick auf ein Menüelement

    function update() {
        
        if (menucounter == 1) {
            $(document).ready(function() { 
                $('#slide-item-1').trigger("click");
            });
        }
    
        if (menucounter == 2) {
            $(document).ready(function() { 
                $('#slide-item-2').trigger("click");
            });
        }

        if (menucounter == 3) {
            $(document).ready(function() { 
                $('#slide-item-3').trigger("click");
            });
        }
    }


//alle Reiter-Bodys verstecken

    function cleartabs() {
    
    $(document).ready(function() {
        $('#tab1').addClass("hide");
        $('#tab2').addClass("hide");
        $('#tab3').addClass("hide");
        //$('#tab4').addClass("hide");
        $('#groups').addClass("hide");
    });

    }


//Bearbeitungsmodus Knopf -> URL Paramter und Style-Klassen für Kontrollmenü

    $(document).ready(function() {
            
            $('#editmode').click(function(){

                $('.control_menu').toggleClass('hide');
                
                var url = new URL(window.location.href);
                //var location = window.location.href;

                if (url.searchParams.get("edit") == "0") {

                    //window.history.pushState(null, null, '?edit=' + "1");
                    setUrlParameter(window.location.href, "edit", "1");
                    
                    $(document).ready(function() {
                        $('.body').addClass("border_red");
                        $('#editmode').addClass("activated");
                    });
                    
                    return;
                }

                if (url.searchParams.get("edit") == "1") {

                    setUrlParameter(window.location.href, "edit", "0");
                    
                    $(document).ready(function() {
                        $('.body').removeClass("border_red");
                        $('#editmode').removeClass("activated");
                    });
                    
                    return;
                }
            });
    });


//(alte) Seite-Neuladen-Funktion

function reloadTab(tab) {
    /*
    if (url.searchParams.get("tab") != tab) {
        //window.location.href = window.location.href + "?tab="+tab;
        //window.location.search = jQuery.query.set("tab", tab);
        window.history.pushState(null, null, '?tab=' + tab);
        
        location.reload();
    } else {

    location.reload();

    } */
    
    location.reload();

}


//URL-Parameter ganz hinten an der URL anfügen (Kopiert)

function insertParam(key, value) {
    
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&'); 
}


//Setze Wert eines URL-Parameter (Kopiert)

function setUrlParameter(url, key, value) {
    var key = encodeURIComponent(key),
        value = encodeURIComponent(value);

    var baseUrl = url.split('?')[0],
        newParam = key + '=' + value,
        params = '?' + newParam;

    if (url.split('?')[1] == undefined){ // if there are no query strings, make urlQueryString empty
        urlQueryString = '';
    } else {
        urlQueryString = '?' + url.split('?')[1];
    }

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if (typeof value === 'undefined' || value === null || value === "") { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace(/[&;]$/, "");
            
        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);
            
        } else if (urlQueryString=="") { // If there are no query strings
            params = '?' + newParam;
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params === '?' ? '' : params;


    window.history.pushState(null, null, params);
    return baseUrl + params;
}