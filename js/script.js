/*FUNÇÃO QUE SERVE PARA VALIDAR ENTRADA DE DADOS*/

function validarEntrada(caracter, origem) {
    /*RECEBE O CARACTER E A ORIGEM, QUE INDICA DE ONDE ELE VEIO*/
    var origemV = origem;
    /*TRANSFOCAR O CARACTER EM UM CHARCODE, EM TODOS NAVEGADORES*/
    if (window.event)
        var asc = caracter.charCode;
    else
        var asc = caracter.which;



    /*SE A ORIGEM FOR 2, OU SEJA, SE FOR LETRAS, IRA CANCELAR A ENTRADA*/
    if (origemV == 2) {
        if (asc >= 48 && asc <= 57)
            return false; //cancela o evento da tecla digitada
        //valida apenas a digitação de letras, 
    }
    if (origemV == 1 || origem == 3) {
        console.log(asc)
        if (asc < 48 || asc > 57) {
            return false;
        }

    }
}


function mascaraNumero(obj, caracter) {

    if (validarEntrada(caracter) == false) {
        return false
    } else {
        var input = obj.value;
        var id = obj.id;
        var resultado = input;

        if (input.length == 0)
            resultado = "(";
        else if (input.length == 3)
            resultado += ") ";
        else if (input.length == 10)
            resultado += "-";
        else if (input.length == 15)
            return false;

        document.getElementById(id).value = resultado;
    }



}


function mascaraNumero2(obj, caracter) {

    if (validarEntrada(caracter) == false) {
        return false
    } else {
        var input = obj.value;
        var id = obj.id;
        var resultado = input;

        if (input.length == 5)
            resultado += "-";
        else if (input.length == 10)
            return false;

        document.getElementById(id).value = resultado;
    }



}

// alert('a');


function mascaraData(obj, caracter) {

    if (validarEntrada(caracter) == false) {
        return false
    } else {
        var input = obj.value;
        var id = obj.id;
        var resultado = input;

        if (input.length == 2)
            resultado += "/";
        else if (input.length == 5)
            resultado += "/ ";
        else if (input.length == 11)
            return false;

        document.getElementById(id).value = resultado;
    }



}