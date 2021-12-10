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
        <steps ng-show="showForm">
            <step>
                <h1>Step</h1>
                <button step-next>Next</button>
            </step>
            <step ng-repeat="item in model.penduduk">
                <h1>Step {{$index+1}}</h1>
                <button step-next>Next</button>
            </step>
            <step>
                <h1>Step 2</h1>
                <button step-previous>Previous</button>
            </step>
        </steps>

    </div>
    <script>

    </script>

    <style>
    .fade {
        opacity: 0;
        -webkit-transition: opacity 0.25s ease-in;
        -moz-transition: opacity 0.25s ease-in;
        -o-transition: opacity 0.25s ease-in;
        -ms-transition: opacity 0.25s ease-in;
        transition: opacity 0.25s ease-in;
        transition-delay: 0.25s;
    }

    .fade.in {
        opacity: 1;
    }

    .animate-switch-container {
        position: relative;
        overflow: hidden;
        /* height: 500px; */
        /* width: 550px; */
        /* border: solid 1px black; */
        box-shadow: 6px 6px 15px gray;
        padding: 10px;
        border-radius: 10px;
        background-color: white;
        background-size: 50px 50px;
    }

    .animate-switch {
        padding: 10px;
        width: 100%;
    }

    .animate-switch.ng-animate {
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        position: absolute;

    }

    /* hide leaving slide  */
    /* show */
    .animate-switch.ng-leave {
        left: 0;
    }

    /* hide */
    .forward .animate-switch.ng-leave.ng-leave-active {
        left: -100%;
    }

    .backward .animate-switch.ng-leave.ng-leave-active {
        left: 100%;
    }

    /* show entering slide  */
    /* hide */
    .forward .animate-switch.ng-enter {
        left: 100%;
    }

    .backward .animate-switch.ng-enter {
        left: -100%;
    }

    /* show */
    .animate-switch.ng-enter.ng-enter-active {
        left: 0;
    }


    /*-----------------------------------*/
    /*------>>> Validation <<<-----------*/
    /*-----------------------------------*/

    .form-validation input.ng-invalid-maxlength {
        border: 2px solid #D9272D;
    }


    .length-error {
        color: #D9272D;
        display: block;
        font-size: 12px;
        opacity: .8;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        position: relative;
        line-height: 18px;
        padding: 10px 10px 5px 10px;
        margin: -25px 0 20px 0;
        background-color: #E3E3E3;
        border-radius: 0 0 5px 5px;
    }

    .input-error {
        border: 2px solid #D9272D;
    }

    /*-----------------------------------*/
    /*------->>> FORM STYLES <<<---------*/
    /*-----------------------------------*/

    .note {
        display: block;
        font-size: 12px;
        opacity: .8;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        position: relative;
        line-height: 18px;
    }

    .note-input {
        padding: 10px 10px 5px 10px;
        margin: -25px 0 20px 0;
        background-color: #E3E3E3;
        border-radius: 0 0 5px 5px;
    }

    .note-input-error,
    .required-error-banner {
        background-color: rgba(217, 39, 45, 0.5);
    }

    /*-----------------------------------*/
    /*----------->>> HELPERS <<<-------------*/
    /*-----------------------------------*/

    /*
  Allow angular.js to be loaded in body, hiding cloaked elements until
  templates compile.  The !important is important given that there may be
  other selectors that are more specific or come later and might alter display.
 */
    [ng\:cloak],
    [ng-cloak],
    .ng-cloak {
        display: none;
    }
    </style>
</div>
<?=$this->endSection()?>