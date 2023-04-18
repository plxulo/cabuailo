// Adiciona o pre loader para a página selecionando o elemento de ID "pre_loader"
var Loader = document.getElementById("pre_loader");

// Ouvinte de eventos na janela que executa uma função alterando o estilo display do ID "pre_loader"
window.addEventListener("load", function(){
    Loader.style.display = "none";
})

// ================== ANIMAÇÃO ================== //
// ================== LOADING ================== //

// Acessa o documento que executa uma função no mover do mouse
document.addEventListener("mousemove", function(event) {
    var blob = document.getElementById('blob');

    blob.animate ({
        left: event.clientX + 'px', // Posição X do ID "blob"
        top: event.clientY + 'px'  // Posição Y do ID "blob"
    }, { duration: 3000, fill: "forwards" }); // Parâmetros da animação
});