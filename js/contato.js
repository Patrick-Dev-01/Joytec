function esvaziar(){
    //Pegar todos os campos
    var titulo = document.getElementById("cTitulo");
    var mensagem = document.getElementById("cMensagem");

    //Usei um Array para armazenar cada um dos campos
    var campos = [titulo, mensagem];
    
    //Usei um "FOR" para percorrer o Vetor e limpar os campos
    for(pos = 0; pos <= campos.length; pos++){
        //Para cada posição limpe o campo
        campos[pos].value = '';
    }
}

function status(){
    //Importar a classe para ver a hora em tempo real
    var data = new Date();
    //Pegar apenas a Hora atual 
    var hora = data.getHours();
    //Pegar a div com a mensagem do status do suporte
    var suporte = document.getElementById("suporte");
    

    //se a hora atual estiver entre as 8hrs e 20hrs o suporte estara Online
    if(hora > 8 && hora < 20){
        suporte.innerHTML = 'Suporte Online';
        suporte.style.backgroundColor = 'green';
    }

    //Se não, o suporte fica Offline
    else{
        suporte.innerHTML = "Suporte Offline";
        suporte.style.backgroundColor = 'red';
    }
}