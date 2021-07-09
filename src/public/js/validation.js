//Speichern aller Variablen des Forms
function validation(sender) {
    const firstname = document.getElementById("firstname");
    const lastname = document.getElementById("lastname");
    const email = document.getElementById("email");
    const reduction = document.getElementById("reduction");
    const concert = document.getElementById("concert");

    //Alle zwingenden Felder Markieren
    if(sender === 'buyTicket') {
        if((firstname.value).length < 1) firstname.style.background = "#ff6600";
        if ((lastname.value).length < 1) lastname.style.background = "#ff6600";
        if ((email.value).length < 1) email.style.background = "#ff6600";
        reduction.style.background = "#ff6600";
        concert.style.background = "#ff6600";
    }

    //Fehler für vorname
    firstname.addEventListener("input", function (event) {
        if ((firstname.value).length < 1) {
            firstname.setCustomValidity("Name must be longer than 0 chars");
            firstname.style.background = "#ff6600";
        } else {
            firstname.style.background = "#ffffff";
        }
    });
    //Fehler für nachname
    lastname.addEventListener("input", function (event) {
        if ((lastname.value).length < 1) {
            lastname.setCustomValidity("Name must be longer than 0 chars");
            lastname.style.background = "#ff6600";
        } else {
            lastname.style.background = "#ffffff";
        }
    });

    //Fehler für email
    email.addEventListener("input", function (event) {
        if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test((email.value))) {
            email.setCustomValidity("email must be longer the 0 chars and contain '. @ .'");
            email.style.background = "#ff6600";
        } else {
            email.style.background = "#ffffff";
        }
    });

    //Fehler für reduction
    reduction.addEventListener("input", function (event) {
        if ((reduction.value).length > 10) {
            reduction.style.background = "#ff6600";
        } else {
            reduction.style.background = "#ffffff";
        }
    });
    
    //Fehler für concert
    concert.addEventListener("input", function (event) {
        if ((concert.value).length !== 0) {
            concert.style.background = "#ff6600";
        } else {
            concert.style.background = "#ffffff";
        }
    });
}
