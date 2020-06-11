<div class="container-fluid page-body-wrapper">
  <div  id="VueUser" class="main-panel">
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{Title}}</h4>
                        <p class="card-description">
                            {{Description}}
                        </p>
                            <!--
                            <div class="form-group" :style="Nome.StyleFormGroup">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" :style="Nome.StyleInput"><i class="mdi mdi-account-outline"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome" :style="Nome.StyleInput" v-model="Nome.Value">
                                </div>
                                <label :class="Nome.ErrorClass" :style="Nome.Style" for="cname">{{Nome.ErrorMsg}}</label>
                            </div>
                            -->

                        <form class="forms-sample">
                            <div :class="Name.ClassDiv">
                                <label for="Name">{{Name.Label}}</label>
                                <input type="text" class="form-control" id="Name" :placeholder="Name.Placeholder" v-model="Name.Value">
                                <label :class="Name.ErrorClass" :style="Name.StyleError" >{{Name.ErrorMsg}}</label>
                            </div>
                            <div :class="Password.ClassDiv">
                                <label for="Password">{{Password.Label}}</label>
                                <input type="text" class="form-control" id="Password" :placeholder="Password.Placeholder" v-model="Password.Value">
                                <label :class="Password.ErrorClass" :style="Password.StyleError" >{{Password.ErrorMsg}}</label>
                            </div>
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                </span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mr-2">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>