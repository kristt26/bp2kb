<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="kuesionerKontroller">
        <div class="">
            <div class="row">
                <div ng-class="{'col-md-4':tambah}" ng-hide="!tambah">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form {{titleForm}} Kuesiner</h4>
                            <form class="forms-sample" ng-submit="save()">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm"
                                        for="kategori">Kategori</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="kategori" ng-model="model.kategori">
                                            <option value="">--Pilih Kategori Pertanyaan--</option>
                                            <option value="KB">Keluarga Berencana</option>
                                            <option value="PB">Pembangunan Keluarga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm"
                                        for="pertanyaan">Pertanyaan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control  form-control-sm" id="pertanyaan" rows="2"
                                            ng-model="model.pertanyaan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="telepon">Set
                                        Jawaban</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="setJawaban"
                                                        id="setJawaban2" value="tidak" ng-model="model.setJawaban">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="setJawaban"
                                                        id="setJawaban1" value="opsi" ng-model="model.setJawaban"
                                                        ng-change="model.opsi=[]; checkStatus(model)">
                                                    Opsi
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="setJawaban"
                                                        id="setJawaban1" value="pilihan" ng-model="model.setJawaban"
                                                        ng-change="model.opsi=[]; checkStatus(model)">
                                                    Pilihan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="setJawaban"
                                                        id="setJawaban2" value="jawaban" ng-model="model.setJawaban"
                                                        ng-change="model.opsi=[]; checkStatus(model)">
                                                    Jawaban
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row" ng-if="model.setJawaban=='jawaban'">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-inverse table-sm">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Pertanyaan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in model.opsi">
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Nama Opsi" disabled ng-model="item.nama">
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger btn-rounded btn-icon mr-2 btn-sm"
                                                            ng-click="hapusItem(item)">
                                                            <i class="mdi mdi-plus-circle-outline"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Nama Opsi" ng-model="jawab.nama">
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-primary btn-icon mr-2 btn-sm"
                                                            ng-click="addItem(jawab)">
                                                            <i class="mdi mdi-content-save"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row"
                                    ng-if="model.setJawaban=='pilihan' || model.setJawaban=='opsi'">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-inverse table-sm">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Opsi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in model.opsi">
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Nama Opsi" disabled ng-model="item.nama">
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger btn-rounded btn-icon mr-2 btn-sm"
                                                            ng-click="hapusItem(item)">
                                                            <i class="mdi mdi-plus-circle-outline"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Nama Opsi" ng-model="jawab.nama">
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-primary btn-icon mr-2 btn-sm"
                                                            ng-click="addItem(jawab)">
                                                            <i class="mdi mdi-content-save"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label col-form-label-sm" for="telepon">Sub
                                        Pertanyaan</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="membershipRadios"
                                                        id="membershipRadios1" value="1" ng-model="model.sub_status"
                                                        ng-change="model.subPertanyaan = []; check(model.sub_status)">
                                                    Ya
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="membershipRadios"
                                                        id="membershipRadios2" value="0" ng-model="model.sub_status"
                                                        ng-change="check(model.sub_status)">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" ng-if="model.sub_status=='1'">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modelId">
                                        Tambah Sub
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-inverse table-sm">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Pertanyaan Sub</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in model.subPertanyaan">
                                                    <td>{{item.pertanyaan}}</td>
                                                    <td>
                                                        <ul ng-repeat="opsi in item.opsi">
                                                            <li>{{opsi.nama}}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Modal -->

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
                            <h4 class="card-title">Data Kuesioner</h4>
                            <div class="card-tools" ng-hide="tambah || setDetail">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-inverse table-sm">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>#</th>
                                            <th>Kategori</th>
                                            <th width="40%">Pertanyaan</th>
                                            <th>Sub Pertanyaan</th>
                                            <th>Jenis Jawaban</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in datas">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{item.kategori=='KB' ? 'Keluarga Berencana' : 'Pembangunan Keluarga'}}
                                            </td>
                                            <td>{{item.pertanyaan}}</td>
                                            <td>{{item.sub_status=='0' ? 'Tidak ada sub pertanyaan' : 'Ada sub pertanyaan'}}
                                            </td>
                                            <td>{{item.setJawaban}}</td>
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


        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="forms-sample">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm" for="pertanyaanSub">Sub
                                    Pertanyaan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control  form-control-sm" id="alamat" rows="2"
                                        ng-model="modelSub.pertanyaan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm">Set
                                    Jawaban</label>
                                <div class="col-sm-9">
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="setJawabanSub"
                                                    id="setJawaban2" value="tidak" ng-model="modelSub.setJawabanSub">
                                                Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="setJawabanSub"
                                                    id="setJawaban1" value="opsi" ng-model="modelSub.setJawabanSub"
                                                    ng-change="modelSub.opsi=[]; checkStatus(modelSub)">
                                                Opsi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="setJawabanSub"
                                                    id="setJawaban1" value="pilihan" ng-model="modelSub.setJawabanSub"
                                                    ng-change="modelSub.opsi=[]; checkStatus(modelSub)">
                                                Pilihan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="setJawabanSub"
                                                    id="setJawaban2" value="jawaban" ng-model="modelSub.setJawabanSub"
                                                    ng-change="modelSub.opsi=[]; checkStatus(modelSub)">
                                                Jawaban
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row" ng-if="modelSub.setJawabanSub=='jawaban'">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-inverse table-sm">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Pertanyaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in modelSub.opsi">
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Kode" disabled ng-model="item.nama">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger btn-rounded btn-icon mr-2 btn-sm"
                                                        ng-click="hapusItemSub(item)">
                                                        <i class="mdi mdi-plus-circle-outline"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Nama Opsi" ng-model="jawabSub.nama">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon mr-2 btn-sm"
                                                        ng-click="addItemSub(jawabSub)">
                                                        <i class="mdi mdi-content-save"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row"
                                ng-if="modelSub.setJawabanSub=='pilihan' || modelSub.setJawabanSub=='opsi'">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-inverse table-sm">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Opsi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in modelSub.opsi">
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Nama Opsi" disabled ng-model="item.nama">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger btn-rounded btn-icon mr-2 btn-sm"
                                                        ng-click="hapusItemSub(item)">
                                                        <i class="mdi mdi-plus-circle-outline"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Nama Opsi" ng-model="jawabSub.nama">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-icon mr-2 btn-sm"
                                                        ng-click="addItemSub(jawabSub)">
                                                        <i class="mdi mdi-content-save"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" ng-click="addSub()">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>