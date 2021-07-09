// Javascript
//Funktion zum berechnen des zu bezahlenden Tages
function calcPayDate(e, label) {
    var payDateLabel = document.querySelector('#'+label);

    //Tage von Targetvalue Auslesen
    var days = 0;
    if(e.value == 1){
        days = 30;
    }else if(e.value == 2){
        days = 20;
    }else if(e.value == 3){
        days = 15;
    }else if(e.value == 4){
        days = 10;
    }

    //Berechnen des Zahltages
    var date = new Date();
    date.setDate(date.getDate() + parseInt(days));

    payDateLabel.innerHTML = (date.getDate() + "." + date.getMonth() + "." + date.getFullYear());
}
