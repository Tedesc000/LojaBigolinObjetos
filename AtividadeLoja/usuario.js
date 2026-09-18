function usuario(nome, dataNasc, senha){
    this.nome = nome;
    let dataNasc = dataNasc;
    let idade;

    this.verificaSenha = function(senha){
        const maiuscula = senha.toUpperCase();
        const minuscula = senha.toLowerCase();
        
    }

    this.calculaIdade = function(dataNasc){
        const diaHoje = new Date();
        const nascimento = new Date(dataNasc);
        idade = diaHoje.getFullYear() - nascimento.getFullYear;
    }
}