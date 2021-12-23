<?=$this->extend('template/layout')?>
<?=$this->section('content')?>
<div class="col-md-12">
    <div ng-controller="laporanPetugasController">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-tools mb-3">
                            <a href="<?= base_url('petugas/laporan/download')?>" target="_blank"
                                class="btn btn-primary btn-sm">Download</a>
                        </div>
                        <div id="cetak">
                            <div class="table-responsive" ng-repeat="item in datas.rws"
                                style="margin-bottom: 15px; margin-top: 15px; margin-left: 15px; margin-right: 15px">
                                <h4 class="card-title">RW: {{item.rw}}</h4>
                                <table class="table table-bordered mb-5">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>No</th>
                                            <th>RT</th>
                                            <th>Total KK</th>
                                            <th>Total Penduduk Laki-laki</th>
                                            <th>Total Penduduk Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="rt in item.rt">
                                            <td scope="row">{{$index+1}}</td>
                                            <td>{{rt.rt}}</td>
                                            <td>{{rt.kk}}</td>
                                            <td>{{rt.pria}}</td>
                                            <td>{{rt.wanita}}</td>
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