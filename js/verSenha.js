//Variavel global para ver se a senha esta visivel ou não
var visivel = false;

function mostrar(){
    var senha = document.getElementById("cSenha");

    //Se a senha nao estiver visivel e o usuario clicar no icone
    if(visivel == false){
        //Mude o tipo do input para "text"
        senha.type = 'text';
        //a senha fica visivel
        visivel = true;
    }

    //ao clicar novamente
    else{
        senha.type = 'password';
        visivel = false;
    }
}