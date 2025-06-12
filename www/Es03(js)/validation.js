window.onload = function () {
    inputs = document.getElementsByTagName("input");
    for (i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("change", validateInput);
    }
}

function validateInput() {
    switch (this.id) {
        case "nome":
            validateNome(this);
            break;
        case "cognome":
            validateCognome(this);
            break;
        case "data":
            validateData(this);
            break;
        case "codice_f":
            validateCF(this);
            break;
        case "email":
            validateEmail(this);
            break;
        case "tel":
            validateTel(this);
            break;
        case "via":
            validateVia(this);
            break;
        case "n.civico":
            validateNCivico(this);
            break;
        case "cap":
            validateCAP(this);
            break;
        case "comune":
            validateComune(this);
            break;
        case "provincia":
            validateProvincia(this);
            break;
        case "username":
            validateUsername(this);
            break;
        case "password":
            validatePassword(this);
            break;
    }
}


function validateNome(elemento) {
    nomeRegex = /^[a-zA-Z]+$/;
    if (!nomeRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateCognome(elemento) {
    nomeRegex = /[a-zA-Z'\s]+/;
    if (!nomeRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateData(elemento) {
    data = elemento.value.split('-');
    if (data.length != 3 || isNaN(data[0]) || isNaN(data[1]) || isNaN(data[2])) {

        if (data[0] > 2024 || data[0] < 1900) {
            elemento.style.background = 'red';
        }
        else if (data[1] > 12 || data[1] < 1) {
            elemento.style.background = 'red';
        }
        else if (data[2] > 31 || data[2] < 1) {
            elemento.style.background = 'red';
        }

    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
    console.log(data)
}

function validateCF(elemento) {
    cfRegex = /^[A-Za-z]{6}[0-9]{2}[A-Za-z][0-9]{2}[A-Za-z][0-9]{3}[A-Za-z]$/;
    if (!cfRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateEmail(elemento) {
    emailRegex = /[A-Za-z.-_!+]+[@]{1}[A-Za-z]+[.]{1}[a-zA-Z]+/;
    if (!emailRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateTel(elemento) {
    telRegex = /[0-9]{12}/;
    if (!telRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateVia(elemento) {
    viaRegex = /[a-zA-Z]+/;
    if (!viaRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateNCivico(elemento) {
    ncivicoRegex = /[0-9]+/;
    if (!ncivicoRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateCAP(elemento) {
    capRegex = /[0-9]{5}/;
    if (!capRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateComune(elemento) {
    comuneRegex = /[a-zA-Z]+/;
    if (!comuneRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateProvincia(elemento) {
    provinciaRegex = /[a-zA-Z]{2}/;
    if (!provinciaRegex.test(elemento.value)) {
        elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}

function validateUsername(elemento) {
    usernameRegex = /[a-zA-Z0-9]+/;
    if (usernameRegex.test(elemento.value) && !(elemento.value.includes(inputs[0].value.toLowerCase()) || elemento.value.includes(inputs[1].value.toLowerCase()))) {
        elemento.style.border = '2px solid green';
        elemento.style.background = 'white';
    } else {
        elemento.style.background = 'red';
    }
}

function validatePassword(elemento) {
    passwordRegex = /.*/;
    if (!passwordRegex.test(elemento.value)) {
         elemento.style.background = 'red';
    } else {
        elemento.style.background = 'white';
        elemento.style.border = '2px solid green';
    }
}