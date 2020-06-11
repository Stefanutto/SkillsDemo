new Vue({
    el: '#app',
    data: {
        ActionSignin: true,
        LabelTop: "Não possui uma conta?",
        TitleCenter: "Olá! Vamos começar",
        LabelCenter: "Informe os campos abaixo para entrar.",
        ButtonTop: "Cadastre-se",
        ButtonCenter:"Entrar",
        Footer: "Copyright © 2020 - " + new Date().getFullYear() + " Carteira do Holder. Todos os direitos reservados.",
        StyleImagem:{
            background: "url('" + window.MyUrl + "/public/img/login.png') no-repeat center !important"
        },
        Email:{
            Value:"",
            StyleInput: {},
            Style:{display: "none"},
            ErrorMsg:"E-mail inválido!",
            ErrorClass: ""
        },
        Senha:{
            Value:"",
            StyleInput: {},
            Style:{display: "none"},
            ErrorMsg:"Senha inválida!",
            ErrorClass: ""
        },
        ReSenha:{
            Value:"",
            StyleFormGroup:{display: "none"},
            StyleInput: {},
            Style:{display: "none"},
            ErrorMsg:"Senha inválida!",
            ErrorClass: ""
        },
        Nome:{
            Value:"",
            StyleFormGroup:{display: "none"},
            StyleInput: {},
            Style:{display: "none"},
            ErrorMsg:"Informe o seu nome.",
            ErrorClass: ""
        },
        StyleLoader:{display: "none"},
        StyleRecuperarSenha:""
    },
    mounted(){
        var urlAtual = window.location.href;
        var splitUrl = urlAtual.split("/");

        if(splitUrl[6] == "validation"){
            axios.post(window.MyUrl + '/login/validation/' + splitUrl[7])
            .then(response => {
                if(response.data.error){
                    this.Alert(response.data.menssager, "error");
                }else{
                    this.Alert(response.data.menssager, "success", "Seja, bem vindo!")
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },
    methods: {
        ChangeTemplate(){
            this.ClearErrorLogin(this.Email);
            this.ClearErrorLogin(this.Senha);
            this.ClearErrorLogin(this.ReSenha);
            this.ClearErrorLogin(this.Nome);
            this.Email.Value = "";
            this.Senha.Value = "";
            this.ReSenha.Value = "";
            this.Nome.Value = "";

            if(this.ActionSignin)
                this.TemplateSignUp();
            else
                this.TemplateSignIn();
            
            this.ActionSignin = !this.ActionSignin;
        },
        TemplateSignIn(){
            this.LabelTop = "Não possui uma conta?";
            this.TitleCenter = "Olá! Vamos começar";
            this.LabelCenter = "Informe os campos abaixo para entrar.";
            this.ButtonTop = "Cadastre-se";
            this.ButtonCenter ="Entrar";
            this.ReSenha.StyleFormGroup = {display: "none"};
            this.Nome.StyleFormGroup = {display: "none"};
            this.StyleRecuperarSenha = {};
        },
        TemplateSignUp(){
            this.LabelTop = "Já tem uma conta?";
            this.TitleCenter = "Cadastro";
            this.LabelCenter = "Digite seus dados abaixo.";
            this.ButtonTop = "Acesse";
            this.ButtonCenter ="Cadastre-se";
            this.ReSenha.StyleFormGroup = {};
            this.Nome.StyleFormGroup = {};
            this.StyleRecuperarSenha = {display: "none"};
        },
        Submit(){
            if(this.ActionSignin)  this.SignIn(); else this.SignUp();
        },
        SignUp(){
            //SET MEUS PARAMETROS
            params = new URLSearchParams()
            params.append('email', this.Email.Value);
            params.append('senha', this.Senha.Value);
            params.append('resenha', this.ReSenha.Value);            
            params.append('nome', this.Nome.Value);

            this.StyleLoader = "";

            axios.post(window.MyUrl + '/login/signup',params)
            .then(response => {
                if(response.data.error){
                    this.ClearErrorLogin(this.Email);
                    this.ClearErrorLogin(this.Senha);
                    this.ClearErrorLogin(this.ReSenha);
                    //CHAMO A FUNC QUE VALIDA SE TEM ALGUM ERRO NOS CAMPOS
                    if(!this.ValidField(response.data.errorField)){
                        this.StyleLoader = {display: "none"};
                        return;
                    } 
                    //SWAL É UM ALERT DO TEMPLATE
                    this.Alert(response.data.menssager);
                }else{
                    this.Alert(response.data.menssager, "success");
                    this.ChangeTemplate();
                }
                this.StyleLoader = {display: "none"};
            })
            .catch(function (error) {
                console.log(error);
                this.StyleLoader = {display: "none"};
            });
            

        },
        SignIn(){
            //SET MEUS PARAMETROS
            params = new URLSearchParams()
            params.append('email', this.Email.Value);
            params.append('senha', this.Senha.Value); 
            this.StyleLoader = "";

            axios.post(window.MyUrl + '/login/signin',params)
            .then(response => {
                if(response.data.error){
                    this.ClearErrorLogin(this.Email);
                    this.ClearErrorLogin(this.Senha);
                    //CHAMO A FUNC QUE VALIDA SE TEM ALGUM ERRO NOS CAMPOS
                    if(!this.ValidField(response.data.errorField)){
                        this.StyleLoader = {display: "none"};
                        return;
                    } 
                    //SWAL É UM ALERT DO TEMPLATE
                    this.Alert(response.data.menssager);
                }else{
                    window.location.href = window.MyUrl + "/" + response.data.redirect;
                }
                this.StyleLoader = {display: "none"};
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
                this.StyleLoader = {display: "none"};
            });
        },
        RecuperarSenha(){
            this.ClearErrorLogin(this.Email);
            this.ClearErrorLogin(this.Senha);
            if(this.Email.Value == ""){
                this.SetError(this.Email, "Preencha este campo para recuperar sua senha.");
                return;
            } 

            params = new URLSearchParams();
            params.append('email', this.Email.Value);
            this.StyleLoader = "";

            axios.post(window.MyUrl + '/login/recoverpasswd',params)
            .then(response => {
                if(response.data.error){
                    this.Alert(response.data.menssager);
                }else{
                    this.Alert(response.data.menssager, "success");
                }
                this.StyleLoader = {display: "none"};
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
                this.StyleLoader = {display: "none"};
            });
        },
        ValidField(errorField){
            if(errorField.length > 0){
                errorField.forEach(element => {
                    let json = JSON.parse(element);
                    switch (json.field) {
                        case 'email':
                            this.SetError(this.Email, json.menssager);
                            break;
                        case 'senha':
                            this.SetError(this.Senha, json.menssager);
                            break;
                        case 'resenha':
                            this.SetError(this.ReSenha, json.menssager);
                            break;
                        case 'nome':
                            this.SetError(this.Nome, json.menssager);
                            break;
                        default:
                            console.log("");
                    }
                });
                return false;
            }
            return true;
        },
        SetError(component,menssager){
            component.ErrorMsg = menssager;
            component.Style.display = "";
            component.StyleInput = {'border-color': '#fb0000 !important'};
            component.ErrorClass = "error mt-2 text-danger";
        },
        ClearErrorLogin(component){
            component.ErrorMsg = "";
            component.Style.display = "none";
            component.StyleInput = {};
            component.ErrorClass = "";
        },
        Alert(menssager, icon = 'error', title = 'Atenção!' ){
            swal({
                title: title,
                text: menssager,
                icon: icon,
                button: {
                text: "Ok",
                value: true,
                visible: true,
                className: "btn btn-primary"
                }
            })
        }
    }
})

