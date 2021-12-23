<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="rwKontroller">
        <div ng-class="{'container rotate': (setDetail!=true && tambah!=true)}">
            <div class="row">
                <div ng-class="{'col-md-4':tambah}" ng-hide="!tambah">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form {{titleForm}} RW</h4>
                            <form class="forms-sample" ng-submit="save()">
                                <div class="form-group">
                                    <label for="rw">No RW</label>
                                    <input type="text" class="form-control" id="rw" placeholder="No RW"
                                        ng-model="model.rw">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <button type="button" class="btn btn-light" ng-click="batal()">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                    ng-class="{'col-md-8 rotate': tambah, 'col-md-12 rotate': !tambah && !setDetail, 'col-md-6 rotate' : !tambah && setDetail}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List RW pada Kelurahan/Kampung {{datas.kecamatan}}</h4>
                            <div class="card-tools" ng-hide="tambah">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                            </div>
                            <div class="table-responsive" style="height:300px">
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>No</th>
                                            <th>No RW</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.rw}}</td>
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
                                                    ng-click="detailRt(item)">
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
                <div ng-class="{'col-md-1': !setDetail, 'col-md-6 rotate': setDetail}" ng-show="setDetail">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List RT</h4>
                            <div class="card-tools" ng-hide="!setDetail">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    ng-click="titleFormRt='Tambah'" data-target="#addRt">Tambah</button>
                            </div>
                            <div class="table-responsive" style="height:300px">
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>No</th>
                                            <th>No RW</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datasRt">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.rt}}</td>
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

        <div class="modal fade" id="addRt" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form {{titleFormRt}} RT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample" ng-submit="saveRt()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rw">No RT</label>
                                <input type="text" class="form-control" id="rw" placeholder="No RT"
                                    ng-model="modelRt.rt">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>