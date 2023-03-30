function validarSenha () {

    condicao = /[A-z]{8}|[1-9]{8}/g;
    input = inputSenha.value;
    inputState = condicao.test(input);

    if (inputState == false) {
        senhaIncorreta.classList.remove("--escondido");
    }

    if (inputState == true) {
        senhaIncorreta.classList.add("--escondido");
    }

}