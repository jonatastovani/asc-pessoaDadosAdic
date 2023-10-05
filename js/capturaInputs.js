function obterValoresDoFormulario(idForm) {
    // Seleciona o formulário pelo ID
    const formulario = document.getElementById(idForm);
  
    // Cria um objeto vazio para armazenar os valores do formulário
    const dadosDoFormulario = {};
  
    // Obtém todos os elementos de entrada no formulário
    const elementosDeEntrada = formulario.elements;
    let strRetorno = '';

    // Itera sobre os elementos de entrada
    for (let i = 0; i < elementosDeEntrada.length; i++) {
      const elemento = elementosDeEntrada[i];
      const nome = elemento.name;
      const valor = elemento.value;
  
      // Verifica se o elemento tem um nome (é um input com nome)
      if (nome) {
        // Adiciona o nome e o valor ao objeto de dados
        dadosDoFormulario[nome] = valor;
        strRetorno += `${nome}:${valor}\n`;
      }
    }
  
    // Agora, você tem um objeto com todos os valores do formulário
    console.log(dadosDoFormulario);
    console.log(strRetorno);
  }
  