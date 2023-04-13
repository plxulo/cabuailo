const limparButton = document.getElementById("limpar")
const inputsLimpaveis = [...document.getElementsByClassName("limpavel--botao")];;

//percorrer array para ser escalável
function limparCampos () {
    inputsLimpaveis.forEach(function (input) {
        input.value = "";
      });
};
