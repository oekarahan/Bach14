

$(document).ready(function(){       // code direkt nach laden der seite starten

    $('#zurück a, #content a').live('click', function(){ //click funtkion zuweisen
        
        var pageToLoad = $(this).attr('href'); // das ziel-link auslesen und zwischenspeichern

        $('#content').load(pageToLoad); // dem div content den inhalt zuweisen 


        return false;
    });
    });