function usuario(nome, dataNasc, email, senha){
    this.nome = nome;//publico
    let dataNasc = validaDataNasc(dataNasc);
    let idade = calculaIdade();//privada
    let email = validaEmail(email);

    this.setSenha = function(senha){
        this.senha = validaSenha(senha);
    }
    this.getSenha = function(){
        return this.senha;
    }
    this.setEmail = function(email){
        this.email = validaEmail(email);
    }
    this.getEmail = function(){
        return email;
    }
    this.setDataNasc = function(dataNasc){
        this.dataNasc = validaDataNasc(dataNasc);
    }
    this.getDataNasc = function(){
        return dataNasc;
    }

    this.validaEmail = function(email){
        let email = email.trim();
        if(email.includes('@') && email.includes('@') && email.lastIndexOf('.') > email.indexOf('@')){
            return email;
        }else{
            throw new Exception("Email inválido!");
        }
    }

    this.validaSenha = function(senha){
        let maiuscula = senha.toUpperCase();
        let minuscula = senha.toLowerCase();
        
        if(senha !== maiuscula && senha !== minuscula){
            return senha;
        }else{
            throw new Exception("A senha é muito fraca");
        }
    }

    this.validaDataNasc = function(dataNasc){
        let data = new Date(dataNasc);
        if(data.getTime() > new Date().getTime() || data.getTime < 0){
            throw new Exception("Data de nascimento inválida!");
        }else{
            return data;
        }
    }

    this.calculaIdade = function(){
        let diaHoje = new Date();
        let anos = diaHoje.getFullYear() - dataNasc.getFullYear();
        let meses = diaHoje.getMonth() - dataNasc.getMonth();
        let dias = diaHoje.getDate() - dataNasc.getDate();

        if(anos>0 && meses > 0 && dias > 0){
            return `${anos} anos, ${meses} meses e ${dias} dias`;
        }else{
            throw new Exception("Data de nascimento inválida!");
        }
    }
}