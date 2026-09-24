// js vai receber os dados crus e ter verificacoes e metodos proprios para uso no front(não faz sentido o php ter a função falar se quem vai alterar a div é o js)
function cliente(id_cliente, nome, cpf, telefone, email){
    this.id_cliente = id_cliente; // publico
    this.nome = nome;             // publico
    this.telefone = telefone;     // publico
    cpf = validaCpf(cpf);         // privada
    email = validaEmail(email);   // privada

    this.setId = function(id_cliente){
        this.id_cliente = id_cliente;
    }
    this.getId = function(){
        return this.id_cliente;
    }

    this.setNome = function(nome){
        this.nome = nome;
    }
    this.getNome = function(){
        return this.nome;
    }

    this.setTelefone = function(telefone){
        this.telefone = telefone;
    }
    this.getTelefone = function(){
        return this.telefone;
    }

    this.setCpf = function(novoCpf){
        cpf = validaCpf(novoCpf);
    }
    this.getCpf = function(){
        return cpf;
    }

    this.setEmail = function(novoEmail){
        email = validaEmail(novoEmail);
    }
    this.getEmail = function(){
        return email;
    }

    function validaEmail(email){
        if (!email) return '';
        let emailLimpo = email.trim();
        if(emailLimpo.includes('@') && emailLimpo.lastIndexOf('.') > emailLimpo.indexOf('@')){
            return emailLimpo;
        }else{
            throw new Error("Email inválido!");
        }
    }
    this.validaEmail = validaEmail;

    function validaCpf(cpf){
        let cpfLimpo = cpf ? String(cpf).trim().replace(/\D/g, '') : '';
        if(cpfLimpo.length === 11){
            return String(cpf).trim();
        }else{
            throw new Error("CPF inválido! Deve conter 11 dígitos.");
        }
    }
    this.validaCpf = validaCpf;
}
