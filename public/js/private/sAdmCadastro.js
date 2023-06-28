// Não podemos utilizar um seletor que seleciona vários quando queremos selecionar apenas um
// getElementsByClassName retorna uma coleção, ao contrário de querySelector

// Pega os botões com base no id de cada um deles e adiciona um ouvinte de eventos para cada clique nos mesmos]
// Quando são clicados executam a função que altera o formId na função exibirFormulario(formId)

document.getElementById('btn_formulario_inserir').addEventListener('click', function() {
    exibirFormulario('formulario_inserir');
})

document.getElementById('btn_formulario_alterar').addEventListener('click', function() {
    exibirFormulario('formulario_alterar');
})

document.getElementById('btn_formulario_deletar').addEventListener('click', function() {
    exibirFormulario('formulario_deletar');
})

// A função oculta todos os formulários no iníco percorrendo-os como um array e depois
// exibe apenas o formulário específicado pelo botão e pelo formId

function exibirFormulario(formId) {
  // Ocultar todos os formulários
  const formularios = document.querySelectorAll("form");
  formularios.forEach(function(form) {
    form.style.display = "none";
  });

  // Exibir o formulário especificado
  document.getElementById(formId).style.display = "flex";
}