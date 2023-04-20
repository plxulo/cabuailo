// Não podemos utilizar um seletor que seleciona vários quando queremos selecionar apenas um
// getElementsByClassName retorna uma coleção, ao contrário de querySelector

document.getElementById('btn_formulario_inserir').addEventListener('click', function() {
    exibirFormulario('formulario_inserir');
})

document.getElementById('btn_formulario_alterar').addEventListener('click', function() {
    exibirFormulario('formulario_alterar');
})

document.getElementById('btn_formulario_deletar').addEventListener('click', function() {
    exibirFormulario('formulario_deletar');
})

function exibirFormulario(formId) {
  // Ocultar todos os formulários
  const formularios = document.querySelectorAll("form");
  formularios.forEach(function(form) {
    form.style.display = "none";
  });

  // Exibir o formulário especificado
  document.getElementById(formId).style.display = "flex";
}