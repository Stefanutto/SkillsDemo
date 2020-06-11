<div class="container-fluid page-body-wrapper">
  <div  id="VueAssets" class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-2">
                                <h4 class="card-title">Sua Carteira de investimentos</h4>
                                <h4 class="card-title">{{CarteiraPorCento}}</h4>
                            </div>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-success" role="progressbar" :style="{width: CarteiraPorCento}" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <div class="alert alert-danger" role="alert" :style="StyleAlert">
                                <i class="mdi mdi-alert-circle"></i>
                                O valor total da carteira não pode passar de 100%!
                            </div>
                            <button @click="Save"  :disabled="SalvarDisabled == 1"  type="button" class="btn btn-info btn-fw"> <i :style="StyleLoader" class="fas fa-spinner fa-pulse"></i> &nbsp; Salvar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ações</h4>
                            <div class="template-demo">
                                <div class="slider-wrap">
                                    <p class="page-description">
                                        Defina a % que deseja ter em ações.
                                    </p>
                                    <br>
                                    <div class="row" style="padding:15px;">
                                        <div class="col-md-9">
                                            <div id="acoes" class="ul-slider slider-primary"></div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input  class="form-control  border-primary" type="number" v-model="Acoes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">FIIs</h4>
                            <div class="template-demo">
                                <div class="slider-wrap">
                                    <p class="page-description">
                                        Defina a % que deseja ter em FIIs.
                                    </p>
                                    <br>
                                    <div class="row" style="padding:15px;">
                                        <div class="col-md-9">
                                            <div id="fiis" class="ul-slider slider-primary"></div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input  class="form-control  border-primary" type="number" v-model="Fiis">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ETFs</h4>
                            <div class="template-demo">
                                <div class="slider-wrap">
                                    <p class="page-description">
                                        Defina a % que deseja ter em ETFs.
                                    </p>
                                    <br>
                                    <div class="row" style="padding:15px;">
                                        <div class="col-md-9">
                                            <div id="etfs" class="ul-slider slider-primary"></div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input  class="form-control  border-primary" type="number" v-model="Etfs">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Renda Fixa</h4>
                            <div class="template-demo">
                                <div class="slider-wrap">
                                    <p class="page-description">
                                        Defina a % que deseja ter em renda fixa.
                                    </p>
                                    <br>
                                    <div class="row" style="padding:15px;">
                                        <div class="col-md-9">
                                            <div id="rf" class="ul-slider slider-primary"></div>
                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input  class="form-control  border-primary" type="number" v-model="Rf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>