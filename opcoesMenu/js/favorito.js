window.onload = function() {
    this.coloreBarra(1)



}

//Função para colorir a barra 
function coloreBarra(id) {

    if (id == 1) {
        //Colore uma barra
        var el = document.getElementById(`barraColorida`);
        el.style.width = '100%';
        el.style.transition = '0.5s';
        //Descolore outra
        var el = document.getElementById(`barraColorida2`);
        el.style.width = '0%';
        el.style.transition = '0.5s';
        //Chamando a pagina de restaurante via ajax
        chamaPagina('restaurante')
    } else {
        //Colore uma barra
        var el = document.getElementById(`barraColorida2`);
        el.style.width = '100%';
        el.style.transition = '0.5s';
        //Descolore outra
        var el = document.getElementById(`barraColorida`);
        el.style.width = '0%';
        el.style.transition = '0.5s';
        //Chamando a pagina de evento via ajax
        chamaPagina('evento')
    }

}


//Função de link
function chamaPagina(nome) {

    $.ajax({
        type: 'POST',
        url: '../funcoes/meusFavoritos.php',
        data: {
            nome: nome
        },
        error: function() {
            alert('erro ao trazer os eventos')
        },
        success: function(data) {

            $('#teste').html(data)

            diminuiDiv();
        }
    })
}


function diminuiDiv() {
    var box = document.querySelector('.boxFavoritos')




}