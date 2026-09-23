function usuario(nome, dataNasc, email, senha){
    this.nome = nome;//publico
    let dataNasc = validaDataNasc(dataNasc);
    let idade;//privada
    let email = validaEmail(email);

    this.setSenha(senha){
        this.senha = validaSenha(senha);
    }
    this.getSenha(){
        return this.senha;
    }


    this.getEmail = function(){
        return email;
    }

    this.validaEmail = function(){

    }

    this.validaSenha = function(senha){
        let maiuscula = senha.toUpperCase();
        let minuscula = senha.toLowerCase();
        
        if(senha !== maiuscula && senha !== minuscula){
            return this.senha = senha;
        }else{
            throw new Exception("A senha é muito fraca");
        }
    }



    this.calculaIdade = function(dataNasc){
        let diaHoje = new Date();
        let nascimento = new Date(dataNasc);
        idade = diaHoje.getFullYear() - nascimento.getFullYear;
    }
}