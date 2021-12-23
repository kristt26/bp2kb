<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="kecamatanKontroller">
        <div ng-class="{'container': !tambah}">
            <div class="row">
                <div ng-class="{'col-md-4':tambah}" ng-hide="!tambah">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Kecamatan</h4>
                            <form class="forms-sample" ng-submit="save()">
                                <div class="form-group row">
                                    <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan"
                                            ng-model="model.kecamatan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis" class="col-sm-3 col-form-label">Status Kecamatan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="jenis" ng-model="model.jenis">
                                            <option value=""></option>
                                            <option value="Kecamatan">Kecamatan</option>
                                            <option value="Distrik">Distrik</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="button" class="btn btn-light" ng-click="batal()">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                    ng-class="{'col-md-8 rotate': tambah, 'col-md-12 rotate': !tambah && !setDetail, 'col-md-4 rotate' : !tambah && setDetail}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List Kecamatan</h4>
                            <div class="card-tools" ng-hide="tambah || setDetail">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>#</th>
                                            <th>Kecamatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.kecamatan}}</td>
                                            <td>{{item.jenis}}</td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-warning btn-rounded btn-icon mr-2"
                                                    ng-click="edit(item)">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon mr-2"
                                                    ng-click="hapus(item)">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-rounded btn-icon"
                                                    ng-click="detailKecamatan(item)">
                                                    <i class="mdi mdi-eye-outline"></i>
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
            <div class="modal fade" id="tambahKelurahan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form Kelurahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        ng-model="modelKelurahan.kelurahan">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis Kelurahan</label>
                                    <select class="form-control" id="jenis" ng-model="modelKelurahan.jenis">
                                        <option value="Kelurahan">Kelurahan</option>
                                        <option value="Desa">Desa</option>
                                        <option value="Kampung">Kampung</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>