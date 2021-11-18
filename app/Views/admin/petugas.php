<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="petugasKontroller">
        <div class="">
            <div class="row">
                <div ng-class="{'col-md-4':tambah}" ng-hide="!tambah">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form {{titleForm}} Petugas</h4>
                            <form class="forms-sample" ng-submit = "save()">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="namaPetugas">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control  form-control-sm" id="namaPetugas" placeholder="Nama Petugas"
                                            ng-model="model.nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="telepon">Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control  form-control-sm" id="telepon" placeholder="Telepon"
                                            ng-model="model.telepon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="alamat">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control  form-control-sm" id="alamat" rows="2"
                                            ng-model="model.alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" ng-show="!model.id">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="email">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control  form-control-sm" id="email" placeholder="Email"
                                            ng-model="model.email">
                                    </div>
                                </div>
                                <div class="form-group row" ng-show="!model.id">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="username">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control  form-control-sm" id="username" placeholder="Username"
                                            ng-model="model.username">
                                    </div>
                                </div>
                                <div class="form-group row" ng-show="!model.id">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="password">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control  form-control-sm" id="password" placeholder="Password"
                                            ng-model="model.password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm"><strong>Wilayah Kerja</strong></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="wilayah">Kecamatan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control  form-control-sm" id="wilayah"
                                            ng-options="item as item.kecamatan for item in datas.kecamatan track by item.id"
                                            ng-model="kecamatans" ng-disabled="model.id">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="wilayah">Kecamatan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control  form-control-sm" id="wilayah"
                                            ng-options="item as item.kelurahan for item in kecamatans.kelurahan track by item.id"
                                            ng-model="wilayah" ng-change="model.kelurahanid=wilayah.id"  ng-disabled="model.id">
                                        </select>
                                    </div>
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
                            <h4 class="card-title">Data Petugas</h4>
                            <div class="card-tools" ng-hide="tambah || setDetail">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-inverse table-sm">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>Wilayah Kerja</th>
                                            <th>Username</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas.petugas">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.nama}}</td>
                                            <td>{{item.telepon}}</td>
                                            <td>{{item.alamat}}</td>
                                            <td>{{item.kelurahan}}</td>
                                            <td>{{item.username}}</td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-warning btn-rounded btn-icon mr-2"
                                                    ng-click="edit(item, 'Edit')">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon mr-2"
                                                    ng-click="hapus(item)">
                                                    <i class="mdi mdi-delete-outline"></i>
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