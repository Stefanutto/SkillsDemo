<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Carteira do Holder</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/iconfonts/simple-line-icon/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo URL; ?>public/images/favicon.png" />
  <script src="<?php echo URL; ?>lib/vue/vue.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://kit.fontawesome.com/be922269e1.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-scroller" id="app">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper auth p-0 theme-two">
        <div class="row d-flex align-items-stretch">
          <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
            <div class="slide-content bg-1" :style="StyleImagem"></div>
          </div>
          <div class="col-12 col-md-8 h-100 bg-white">
            <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
              <div class="nav-get-started">
                <p>{{ LabelTop }}</p>
                <a @click="ChangeTemplate" class="btn get-started-btn btn-success text-white" >{{ButtonTop}}</a>
              </div>
              
              <form>
                <h3 class="mr-auto">{{TitleCenter}}</h3>
                <p class="mb-5 mr-auto">{{LabelCenter}}</p>

                <div class="form-group" :style="Nome.StyleFormGroup">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" :style="Nome.StyleInput"><i class="mdi mdi-account-outline"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nome" :style="Nome.StyleInput" v-model="Nome.Value">
                  </div>
                  <label :class="Nome.ErrorClass" :style="Nome.Style" for="cname">{{Nome.ErrorMsg}}</label>
                </div>

                <div class="form-group has-danger">
                  <div class="input-group" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"  :style="Email.StyleInput"><i class="mdi mdi-email"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="E-mail" :style="Email.StyleInput" v-model="Email.Value">
                  </div>
                  <label :class="Email.ErrorClass" :style="Email.Style" for="cname">{{Email.ErrorMsg}}</label>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" :style="Senha.StyleInput"><i class="mdi mdi-lock-outline"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Senha" :style="Senha.StyleInput" v-model="Senha.Value">
                  </div>
                  <label :class="Senha.ErrorClass" :style="Senha.Style" for="cname">{{Senha.ErrorMsg}}</label>
                </div>
                <div class="form-group" :style="ReSenha.StyleFormGroup">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" :style="ReSenha.StyleInput"><i class="mdi mdi-lock-outline"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Digite sua senha novamente" :style="ReSenha.StyleInput" v-model="ReSenha.Value">
                  </div>
                  <label :class="ReSenha.ErrorClass" :style="ReSenha.Style" for="cname">{{ReSenha.ErrorMsg}}</label>
                </div>
                <div class="form-group">
                
                  <a @click="RecuperarSenha" :style="StyleRecuperarSenha" href="javascript:void(0)">Esqueceu a senha?</a>
                  <button type="button" @click="Submit" class="btn btn-primary submit-btn btn-block">
                    <i :style="StyleLoader" class="fas fa-spinner fa-pulse"></i> &nbsp; {{ButtonCenter}} 
                  </button>
                </div>
                <div class="wrapper mt-5 text-gray">
                  <p class="footer-text">{{Footer}}</p>
                  <ul class="auth-footer text-gray">
                    <!--<li><a href="#">Terms & Conditions</a></li>-->
                    <!--<li><a href="#">Cookie Policy</a></li>-->
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="<?php echo URL; ?>public/js/vendor.bundle.base.js"></script>
  <script src="<?php echo URL; ?>public/js/vendor.bundle.addons.js"></script>
</body>

</html>