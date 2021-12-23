<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="kelurahanKontroller">
        <div ng-class="{'container rotate': !tambah}">
            <div class="row">
                <div ng-class="{'col-md-4':tambah}" ng-hide="!tambah">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form {{titleForm}} Kelurahan</h4>
                            <form class="forms-sample" ng-submit="save()">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        ng-model="model.kelurahan">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis Kelurahan</label>
                                    <select class="form-control" id="jenis" ng-model="model.jenis">
                                        <option value="Kelurahan">Kelurahan</option>
                                        <option value="Desa">Desa</option>
                                        <option value="Kampung">Kampung</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <button type="button" class="btn btn-light" ng-click="batal()">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                    ng-class="{'col-md-8 rotate': tambah, 'col-md-12 rotate': !tambah && !setDetail, 'col-md-4 rotate' : !tambah && setDetail}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List Kelurahan pada Kecamatan {{datas.kecamatan}}</h4>
                            <div class="card-tools" ng-hide="tambah || setDetail">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>No</th>
                                            <th>Kelurahan</th>
                                            <th>Jenis</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas.kelurahan">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.kelurahan}}</td>
                                            <td>{{item.jenis}}</td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-warning btn-rounded btn-icon mr-2"
                                                    ng-click="edit(item, 'Edit')">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon mr-2"
                                                    ng-click="hapus(item)">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-rounded btn-icon"
                                                    ng-click="detailKelurahan(item)">
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
        </div>
    </div>
</div>
<?=$this->endSection()?>