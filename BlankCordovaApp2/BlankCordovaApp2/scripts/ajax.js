


$(document).ready(toStaticHTML(function () {       // code direkt nach laden der seite starten

    $('#back').click(function () {


        $('div').load('../index.html');

    });

    $('#produkt').click(function () {
        $('#ajax').load('../html/produkte.html');

    });



}));