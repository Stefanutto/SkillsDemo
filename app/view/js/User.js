new Vue({
    el: "#VueUser",
    data:{
        Title:"Atualização de cadastro.",
        Description:"Preencha os campos com as suas informações.",
        Name:{
            Value: "",
            Label:"Nome",
            Placeholder:"Informe seu nome completo",
            StyleError:{display: "none"},
            ErrorMsg:"",
            ErrorClass: "error mt-2 text-danger",
            ClassDiv: "form-group" //has-danger
        },
        Password:{
            Value: "",
            Label:"Senha",
            Placeholder:"Informe sua senha.",
            StyleError:{display: "none"},
            ErrorMsg:"",
            ErrorClass: "error mt-2 text-danger",
            ClassDiv: "form-group" //has-danger
        }
    },
    mounted(){

    },
    methods: {

    }
})