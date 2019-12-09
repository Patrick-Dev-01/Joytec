function previewIcone(){
    //Pegar o input do file
    var imagem = document.getElementById("cIcone").files[0];
    //Pegar a tag img que servirá de preview
    var preview = document.getElementById("preview");
    
    //Importar uma classe para ler o conteudo da imagem
    var reader = new FileReader();

    //Quando a imagem for lida
    reader.onloadend = function(){
        preview.src = reader.result;
    }
    //Se uma imagem for selecionada, mostrar a preview
    if(imagem){
        reader.readAsDataURL(imagem);
    }

    else{
        preview.src = "";
    }
}