// Adiciona o pre loader para a página selecionando o elemento de ID "pre_loader"
var Loader = document.getElementById("pre_loader");

// Ouvinte de eventos na janela que executa uma função alterando o estilo display do ID "pre_loader"
window.addEventListener("load", function(){
    Loader.style.display = "none";
})