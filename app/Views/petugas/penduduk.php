<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="pendudukKontroller">
        <div ng-class="{'container rotate': showForm}" ng-if="!showForm">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="card-title">Data Penduduk</h4>
                        <div class="card-tools mb-4" ng-hide="tambah || setDetail">
                            <button type="button" class="btn btn-primary btn-sm" ng-click="add()">Tambah</button>
                        </div>
                        <div class="table-responsive">
                            <table datatable="ng" class="table table-striped table-sm table-bordered">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>NIK</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in datas.penduduk">
                                        <td scope="row">{{$index+1}}</td>
                                        <td>{{item.nama}}</td>
                                        <td>{{item.nik}}</td>
                                        <td>Valid</td>
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
        <div class="container">
            <form id="msform" ng-show="showForm">
                <fieldset name="start" id="next1">
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
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-options="item as item.rw for item in datas.kelurahan.rw"
                                ng-model="rws">
                                <option value="">Pilih RW/Dusun</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-options="item as item.rt for item in rws.rt" ng-model="rts"
                                ng-change="model.rtid=rts.id">
                                <option disabled value="">Pilih RT</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <input type="number" class="form-control" placeholder="No. Rumah" ng-model="model.no_rumah">
                        </div>
                        <div class="col-sm-6 mb-4">
                            <input type="text" class="form-control" placeholder="No. Telepon/HP"
                                ng-model="model.kontak">
                        </div>
                        <div class="col-sm-6 mb-4">
                            <input type="number" class="form-control" required placeholder="Jumlah Anggota Keluarga"
                                ng-model="model.jumlah_anggota" ng-change="setPenduduk(model.jumlah_anggota)">
                        </div>
                        <div class="col-sm-12 mb-4">
                            <textarea class="form-control" rows=" 4" placeholder="Alamat"
                                ng-model="model.alamat"></textarea>
                        </div>
                    </div>
                    <!-- <input type="text" name="fname" placeholder="First Name" />
                    <input type="text" name="lname" placeholder="Last Name" />
                    <input type="text" name="phone" placeholder="Phone" /> -->
                    <!-- <input type="button" name="next" class="next action-button" ng-click="next()" value="Next" /> -->
                    <input type="button" name="next" class="next action-button" ng-click="next('#next1', '#next2')"
                        value="Next" />
                </fieldset>

                <fieldset ng-repeat="item in model.penduduk" name="stage{{$index}}" id="next{{$index+2}}">
                    <h2 class="card-title">Form Data Kependudukan</h2>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="" value="{{$index+1}}"
                                ng-model="item.urut" disabled>
                        </div>
                        <div class="col-sm-5 mb-4">
                            <input type="text" class="form-control" placeholder="Nama Anggota Keluarga"
                                ng-model="item.nama"
                                ng-focus="autoSet($index, 'hubunganKeluarga', item.hubungan_keluarga)">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="NIK" ng-model="item.nik">
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.jenis_kelamin">
                                <option disabled value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <input type="date" class="form-control" placeholder="Tanggal Lahir"
                                ng-model="item.tanggal_lahir">
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.status_kawin">
                                <option disabled value="">Status Perkawinan</option>
                                <option value="Belum Kawin">1. Belum Kawin</option>
                                <option value="Kawin">2. Kawin</option>
                                <option value="Cerai Hidup">3. Cerai Hidup</option>
                                <option value="Cerai Mati">4. Cerai Mati</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <input type="number" class="form-control" placeholder="Usia Perkawinan Pertama"
                                ng-model="item.usia_kawin">
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.akta_lahir">
                                <option disabled value="">Memiliki Akta Lahir</option>
                                <option value="Ya">1. Ya</option>
                                <option value="Tidak">2. Tidak</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.hubungan_keluarga"
                                ng-options="item as (item.no + ' '+item.nama) for item in hubunganKeluarga"
                                ng-change="autoSet($index, 'ibuKandung', item.hubungan_keluarga)"
                                ng-disabled="$index==0">
                                <option disabled value="">Hubungan dengan kepala keluarga</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.ibu_kandung"
                                ng-options="item as item.nama for item in ibuKandung"
                                ng-disabled="item.hubungan_keluarga.no == '1' || item.hubungan_keluarga.no == '2' || $index==0">
                                <option disabled value="">Kode Ibu Kandung</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.agama">
                                <option disabled value="">Agama</option>
                                <option value="Islam">1. Islam</option>
                                <option value="Kristen">2. Kristen</option>
                                <option value="Katolik">3. Katolik</option>
                                <option value="Hindu">4. Hindu</option>
                                <option value="Budha">5. Budha</option>
                                <option value="Konghucu">6. Konghucu</option>
                                <option value="Penghayat Kepercayaan">7. Penghayat Kepercayaan</option>
                                <option value="Lainnya">8. Lainnya</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.pekerjaan">
                                <option disabled value="">Status Pekerjaan</option>
                                <option value="Tidak/Belum Bekerja">1. Tidak/Belum Bekerja</option>
                                <option value="Petani">2. Petani</option>
                                <option value="Nelayan">3. Nelayan</option>
                                <option value="Pedagang">4. Pedagang</option>
                                <option value="Pejabat Negara">5. Pejabat Negara</option>
                                <option value="PNS/TNI/POLRI">6. PNS/TNI/POLRI</option>
                                <option value="Pegawai Swasta">7. Pegawai Swasta</option>
                                <option value="Wiraswasta">8. Wiraswasta</option>
                                <option value="Pensiunan">9. Pensiunan</option>
                                <option value="Pekerja Lepas">10. Pekerja Lepas</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.pendidikan">
                                <option disabled value="">Pendidikan</option>
                                <option value="Tidak/Belum Sekolah">1. Tidak/Belum Sekolah</option>
                                <option value="Tidak Tamat SD/Sederajat">2. Tidak Tamat SD/Sederajat</option>
                                <option value="Masih SD/Sederajat">3. Masih SD/Sederajat</option>
                                <option value="Tamat SD/Sederajat">4. Tamat SD/Sederajat</option>
                                <option value="Masih SLTP/Sederajat">5. Masih SLTP/Sederajat</option>
                                <option value="Tamat SLTP/Sederajat">6. Tamat SLTP/Sederajat</option>
                                <option value="Masih SLTA/Sederajat">7. Masih SLTA/Sederajat</option>
                                <option value="Tamat SLTA/Sederajat">8. Tamat SLTA/Sederajat</option>
                                <option value="Masih PT/Akademik">9. Masih PT/Akademik</option>
                                <option value="Tamat PT/Akademik">10. Tamat PT/Akademik </option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.asuransi">
                                <option disabled value="">Kepesertaan JKN/Asuransi Kesehatan lainnya</option>
                                <option value="BPJS-PBI/Jamkesmas/Jamkesda">1. BPJS-PBI/Jamkesmas/Jamkesda</option>
                                <option value="BPJS-Non PBI">2. BPJS-Non PBI</option>
                                <option value="Swasta">3. Swasta</option>
                                <option value="Tidak Memiliki">4. Tidak Memiliki</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-4">
                            <select class="form-control" ng-model="item.keberadaan">
                                <option disabled value="">Keberadaan anggota keluarga</option>
                                <option value="Dalam Rumah">1. Di Dalam Rumah</option>
                                <option value="Luar Rumah">2. Di Luar Rumah</option>
                                <option value="Luar Negeri">3. Di Luar Negeri</option>
                            </select>
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous"
                        ng-click="previous('#next'+($index+2), '#next'+($index+1))" value="Previous" />
                    <input type="button" name="next" class="next action-button"
                        ng-click="next('#next'+($index+2), '#next'+($index+3))" value="Next" />
                </fieldset>
                <fieldset ng-repeat="item in kb" id="next{{(model.penduduk.length+2+$index)}}">
                    <h2 class="fs-title">Form Keluarga Berencana</h2>
                    <hr>
                    <h3 class="text-left"><strong class="bg-warning"
                            style="border-radius:50%; padding: 10px; width:15px; line-height: 32px;">{{$index+1}}</strong>&nbsp;
                        {{item.pertanyaan}}
                    </h3>
                    <hr>
                    <div class="text-left mb-3">
                        <div ng-if="item.setJawaban=='jawaban'" ng-repeat="opsi in item.opsi">
                            <input type="number" class="col-md-1" name="twitter" ng-model="item.jawaban" />
                            {{opsi.nama}}
                        </div>
                        <div ng-if="item.setJawaban=='opsi'">
                            <div class="form-check" ng-repeat="opsi in item.opsi">
                                <input style="width:5%; font-size: 23px;" class=" form-check-input" type="radio"
                                    name="exampleRadios{{item.id}}" id="exampleRadioskb{{$index+1}}"
                                    ng-value="opsi.nama" ng-model="item.jawaban">
                                <label class="form-check-label" for="exampleRadioskb{{$index+1}}">
                                    {{opsi.nama}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div ng-if="item.sub_status=='1'">
                        <ol type="a" class="pl-3">
                            <div ng-repeat="sub in item.subPertanyaan">
                                <li style="font-size:20px">
                                    <h3 class="text-left">
                                        {{sub.pertanyaan}}
                                    </h3>
                                </li>
                                <div class="text-left" ng-if="sub.setJawabanSub=='jawaban'"
                                    ng-repeat="opsisub in sub.opsi">
                                    <input type="number" class="col-md-1" name="twitter" ng-model="opsisub.jawaban" />
                                    {{opsisub.nama}}
                                </div>
                                <div ng-if="sub.setJawabanSub=='opsi'">
                                    <div class="form-check" ng-repeat="opsisub in sub.opsi">
                                        <input style="width:5%; font-size: 23px;" class=" form-check-input" type="radio"
                                            name="exampleRadios{{sub.id}}" id="exampleRadiossubkb{{$index+1}}"
                                            ng-value="opsisub.nama" ng-model="opsisub.jawaban">
                                        <label class="form-check-label" for="exampleRadiossubkb{{$index+1}}">
                                            {{opsisub.nama}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </ol>

                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                        ng-click="previous('#next'+(model.penduduk.length+2+$index), '#next'+(model.penduduk.length+1+($index)))" />
                    <input type="button" name="next" class="next action-button" value="Next"
                        ng-click="next('#next'+(model.penduduk.length+2+$index), '#next'+(model.penduduk.length+2+($index+1)))" />
                </fieldset>
                <fieldset ng-repeat="item in pb" id="next{{((kb.length) + (model.penduduk.length+2+$index))}}">
                    <h2 class="fs-title">Form Pembangunan Keluarga</h2>
                    <hr>
                    <h3 class="text-left"><strong class="bg-warning"
                            style="border-radius:50%; padding: 10px; width:15px; line-height: 32px;">{{kb.length + $index+1}}</strong>&nbsp;
                        {{item.pertanyaan}}
                    </h3>
                    <hr>
                    <div class="text-left mb-3">
                        <div ng-if="item.setJawaban=='jawaban'" class="text-left" ng-repeat="opsi in item.opsi">
                            <input type="text" class="col-md-1" name="twitter" ng-model="opsi.jawaban" /> {{opsi.nama}}
                        </div>
                        <div ng-if="item.setJawaban=='opsi'">
                            <div ng-class="{'row': item.opsi.length>3}">
                                <div class="col-md-6" ng-repeat="opsi in item.opsi">
                                    <div class="form-check">
                                        <input style="width:5%; font-size: 23px;" class=" form-check-input" type="radio"
                                            name="exampleRadios{{item.id}}" id="exampleRadiospb{{$index+1}}"
                                            ng-value="opsi.nama" ng-model="item.jawaban">
                                        <label class="form-check-label" for="exampleRadiospb{{$index+1}}">
                                            {{opsi.nama}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div ng-if="item.setJawaban=='pilihan'">
                            <div class="form-group">
                                <div class="form-check" ng-repeat="opsi in item.opsi">
                                    <input style="width:5%; font-size: 23px;" class="form-check-input" type="checkbox"
                                        value="opsi.nama" id="defaultCheck{{$index+1}}" ng-model="opsi.jawaban">
                                    <label class="form-check-label" for="defaultCheck{{$index+1}}">
                                        {{opsi.nama}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                        ng-click="previous('#next'+((kb.length+1)+model.penduduk.length+1+$index), '#next'+((kb.length+1)+model.penduduk.length+$index))" />
                    <input type="button" name="next" class="next action-button" value="Next"
                        ng-click="next('#next'+((kb.length+1)+model.penduduk.length+1+$index), '#next'+((kb.length+1)+model.penduduk.length+1+$index+1))" />
                </fieldset>
                <fieldset id="next{{kb.length + pb.length + model.penduduk.length + 2}}">
                    <h2 class="fs-title mb-4">Preview {{model.id ? 'Edit': 'Tambah'}} Data</h2>
                    <hr>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h3>Data KK</h3>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body text-left">
                                    <div class="col-lg-12">
                                        <div class="row"
                                            style="font-size:1rem; font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif; font-weight: 400; line-height: 1.5; letter-spacing: 0.00938em;">
                                            <div class="col-lg-6" style="padding: 8px;">Provinsi</div>
                                            <div class="col-lg-6" style="padding: 8px;">: Papua</div>
                                            <div class="col-lg-6" style="padding: 8px;">Kabupaten/Kota</div>
                                            <div class="col-lg-6" style="padding: 8px;">: Jayapura</div>
                                            <div class="col-lg-6" style="padding: 8px;">Kecamatan</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{datas.kecamatan.kecamatan}}
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">Desa/Kel</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{datas.kelurahan.kelurahan}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row"
                                            style="font-size:1rem; font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif; font-weight: 400; line-height: 1.5; letter-spacing: 0.00938em;">
                                            <div class="col-lg-6" style="padding: 8px;">RW/Dusun</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{rws.rw}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">RT</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{rts.rt}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">No. Rumah</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{model.no_rumah}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">No. Telepon/Hp</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{model.kontak}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Jumlah Anggota Keluarga</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{model.jumlah_anggota}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Alamat</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{model.alamat}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <h3>Data Anggota Keluarga</h3>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body text-left">
                                    <div class="col-lg-12" ng-repeat="item in model.penduduk">
                                        <div class="row"
                                            style="font-size:1rem; font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif; font-weight: 400; line-height: 1.5; letter-spacing: 0.00938em;">
                                            <div class="col-lg-6"
                                                style="padding: 8px; background-color: rgba(3, 138, 246, 0.5);">Anggota
                                                Keluarga {{$index+1}}
                                            </div>
                                        </div>
                                        <hr style="margin-left: -1rem; margin-top: 0.5rem !important;">
                                        <div class="row"
                                            style="font-size:1rem; font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif; font-weight: 400; line-height: 1.5; letter-spacing: 0.00938em;">
                                            <div class="col-lg-6" style="padding: 8px;">NIK</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{item.nik}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Nama</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{item.nama}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Jenis Kelamin</div>
                                            <div class="col-lg-6" style="padding: 8px;">:
                                                {{item.jenis_kelamin=='L' ? 'Laki-laki' : 'Perempuan'}}
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">Tanggal Lahir</div>
                                            <div class="col-lg-6" style="padding: 8px;">:
                                                {{item.tanggal_lahir | date:'d MMMM y'}}
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">Status Perkawinan</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{item.status_kawin}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Usia Kawin Pertama</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{item.usia_kawin}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Memiliki Akta Lahir</div>
                                            <div class="col-lg-6" style="padding: 8px;">: {{item.akta_lahir}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Hubungan Dengan Kepala Keluarga
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">:
                                                {{item.hubungan_keluarga.nama}}
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">Kode Ibu Kandung</div>
                                            <div class="col-lg-6" style="padding: 8px;">:
                                                {{item.ibu_kandung ? 'item.ibu_kandung.nama' : '0'}}
                                            </div>
                                            <div class="col-lg-6" style="padding: 8px;">Agama</div>
                                            <div class="col-lg-6" style="padding: 8px;">:{{item.agama}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Pekerjaan</div>
                                            <div class="col-lg-6" style="padding: 8px;">:{{item.pekerjaan}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Pendidikan</div>
                                            <div class="col-lg-6" style="padding: 8px;">:{{item.pendidikan}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Kepesertaan JKN/Asurasnsi</div>
                                            <div class="col-lg-6" style="padding: 8px;">:{{item.asuransi}}</div>
                                            <div class="col-lg-6" style="padding: 8px;">Keberadaa Anggota Keluarga</div>
                                            <div class="col-lg-6" style="padding: 8px;">:{{item.keberadaan}}</div>
                                        </div>
                                        <hr style="margin-left: -1rem; margin-bottom: 0.5rem !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous"
                        ng-click="previous('#next'+((kb.length+1)+(model.penduduk.length+1)+(pb.length)), '#next'+((kb.length+1)+(model.penduduk.length+1)+(pb.length-1)))" />
                    <input type="submit" name="submit" class="submit action-button" ng-click="save()"
                        value="{{model.id ? 'Update': 'Simpan'}}" />
                </fieldset>
            </form>
        </div>
    </div>

</div>
<style>
input {
    font-size: 19px !important;
}
</style>
<?=$this->endSection()?>