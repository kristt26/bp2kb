<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="pendudukKontroller">
        <div ng-class="{'container rotate': showForm}" ng-if="!showForm">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="card-title">Data Penduduk</h4>
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
        <form id="msform" ng-show="showForm">
            <fieldset>
                <h2 class="card-title">Form Data Kependudukan</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <label class="col-md-6 col-form-label"> Provinsi: PAPUA</label>
                        <label class="col-md-6 col-form-label">Kecamatan: {{}}</label>
                    </div>
                    <div class="col-md-6 text-left">
                        <label class="col-md-6 col-form-label">Kabupaten/Kota: Jayapura</label>
                        <label class="col-md-6 col-form-label">Kecamatan:{{}}</label>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Kecamatan" ng-model="model.kecamatan">
                    </div>
                </div>
                <!-- <input type="text" name="fname" placeholder="First Name" />
                <input type="text" name="lname" placeholder="Last Name" />
                <input type="text" name="phone" placeholder="Phone" />
                <input type="button" name="next" class="next action-button" value="Next" /> -->
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Social Profiles</h2>
                <h3 class="fs-subtitle">Your presence on the social network</h3>
                <input type="text" name="twitter" placeholder="Twitter" />
                <input type="text" name="facebook" placeholder="Facebook" />
                <input type="text" name="gplus" placeholder="Google Plus" />
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Social Profiles</h2>
                <h3 class="fs-subtitle">Your presence on the social network</h3>
                <input type="text" name="twitter" placeholder="Twitter" />
                <input type="text" name="facebook" placeholder="Facebook" />
                <input type="text" name="gplus" placeholder="Google Plus" />
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Create your account</h2>
                <h3 class="fs-subtitle">Fill in your credentials</h3>
                <input type="text" name="email" placeholder="Email" />
                <input type="password" name="pass" placeholder="Password" />
                <input type="password" name="cpass" placeholder="Confirm Password" />
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="submit" name="submit" class="submit action-button" value="Submit" />
            </fieldset>
        </form>
    </div>
    <script>

    </script>
</div>
<?=$this->endSection()?>