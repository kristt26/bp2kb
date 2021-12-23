<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="laporanController">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-tools mb-3">
                            <a href="<?= base_url('admin/laporan/download')?>" target="_blank"
                                class="btn btn-primary btn-sm">Download</a>
                        </div>
                        <div id="cetak">
                            <div class="table-responsive" ng-repeat="item in datas"
                                style="margin-bottom: 15px; margin-top: 15px; margin-left: 15px; margin-right: 15px">
                                <h4 class="card-title">Distrik {{item.kecamatan}}</h4>
                                <table class="table table-bordered mb-5">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>No</th>
                                            <th>Kelurahan</th>
                                            <th>Total RW</th>
                                            <th>Total RT</th>
                                            <th>Total KK</th>
                                            <th>Total Penduduk Laki-laki</th>
                                            <th>Total Penduduk Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="kel in item.kelurahan">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{kel.kelurahan}}</td>
                                            <td>{{kel.rw}}</td>
                                            <td>{{kel.rt}}</td>
                                            <td>{{kel.kk}}</td>
                                            <td>{{kel.pria}}</td>
                                            <td>{{kel.wanita}}</td>
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
<style>
@media screen {
    #print {
        /* font-family:verdana, arial, sans-serif; */
    }

    .screen {
        display: none;
    }

    .settt {
        display: block;
    }

    @page {
        size: landscape
    }
}

@media print {

    /* #print {font-family:georgia, times, serif;} */
    .screen {
        display: block;
    }

    .settt {
        display: none;
    }
}
</style>
<?=$this->endSection()?>