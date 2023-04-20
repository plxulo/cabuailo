// Não podemos utilizar um seletor que seleciona vários quando queremos selecionar apenas um
// getElementsByClassName retorna uma coleção, ao contrário de querySelector

const botoes = [...document.querySelectorAll('.alterar_form')]; // Armazena todos os elementos da classe "alterar_form"
const form = document.querySelector('.formulario_admin'); // Retorna apenas o primeiro elemento

function desaparecer() {
    form.style.display = 'none';
}

botoes.forEach(button => {
    button.addEventListener('click', desaparecer);
});