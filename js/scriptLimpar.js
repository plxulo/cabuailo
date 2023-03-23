const limparButton = document.getElementById("limpar")
const inputsLimpaveis = [...document.getElementsByClassName("limpavel--botao")];;

function limparCampos () {
    inputsLimpaveis.forEach(function (input) {
        input.value = "";
      });
};