<div class="container-fluid page-body-wrapper">
  <div  id="VueActive" class="main-panel">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-2">
                                <h4 class="card-title">Ativos</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nota</th>
                                            <th>Categoria</th>
                                            <th class="text-center">Botões</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary">
                                            <td>
                                                <input type="text" class="form-control" placeholder="ITUB3" v-model="Codigo">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="100" v-model="Nota">
                                            </td>
                                            <td> </td>
                                            <td class="text-center">
                                                <i :style="StyleLoader" class="fas fa-spinner fa-pulse text-success"></i>
                                                <button :style="StyleInclude" @click="SetTable" class="btn btn-link btn-icons btn-sm" data-toggle="tooltip" title="Adicionar">
                                                    <i class="fa fa-plus text-success" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-for="(row, index) in db">
                                            <td>{{row.codigo}}</td>
                                            <td>{{row.nota}}</td>
                                            <td>{{row.categoria}}</td>
                                            <td class="text-center">
                                                <button @click="EditTable(index)" class="btn btn-link btn-icons btn-sm" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil text-primary" aria-hidden="true"></i>
                                                </button>
                                                <button @click="RemoveTable(index)" class="btn btn-link btn-icons btn-sm" data-toggle="tooltip" title="Excluir">
                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>