const limparButton = document.getElementById("limpar")
const inputsLimpaveis = [...document.getElementsByClassName("limpavel")];;

function limparCampos () {
    inputsLimpaveis.forEach(function (input) {
        input.value = "";
      });
};