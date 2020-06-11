var urlAtual = window.location.href;
var splitUrl = urlAtual.split("/");
window.MyUrl = "";

if(splitUrl[2] == "localhost"){
    MyUrl = splitUrl[0] + "/" + splitUrl[1] + "/" + splitUrl[2] + "/" + splitUrl[3];
}else{
    MyUrl = splitUrl[0] + "/" +  splitUrl[1] + "/" +  splitUrl[2];
}

function ValidarEmail (email) {
    var emailPattern =  /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
     return emailPattern.test(email); 
}