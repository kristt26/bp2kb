angular.module('adminctrl', [])
    .controller('pageController', pageController)
    .controller('homeController', homeController)
    .controller('kecamatanKontroller', kecamatanKontroller)
    .controller('kelurahanKontroller', kelurahanKontroller)
    .controller('rwKontroller', rwKontroller)
    .controller('petugasKontroller', petugasKontroller)
    .controller('pendudukKontroller', pendudukKontroller)
    .controller('kuesionerKontroller', kuesionerKontroller)
    ;


function pageController($scope, helperServices) {
    $scope.Title = "Page Header";
}

function homeController($scope, $http, helperServices, homeServices, message) {
    $scope.$emit("SendUp", "Home");
    homeServices.get().then(x => {
        console.log(x);
        var lebel = [];
        var datas = [];
        var color = [];
        x.forEach(element => {
            lebel.push($scope.setBulan(element.stringbln));
            datas.push(element.jumlah);
            color.push("#" + Math.floor(Math.random() * 16777215).toString(16));
        });
        console.log(lebel);
        console.log(datas);
        console.log(color);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lebel,
                datasets: [{
                    data: datas,
                    backgroundColor: color,
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Pemasangan Iklan Tahun ' + new Date().getFullYear(),
                    }
                }
            }
        });
    })

    $scope.setBulan = (bulan) => {
        switch (parseInt(bulan)) {
            case 1:
                return "Januari"
                break;
            case 2:
                return "Februari"
                break;
            case 3:
                return "Maret"
                break;
            case 4:
                return "April"
                break;
            case 5:
                return "Mei"
                break;
            case 6:
                return "Juni"
                break;
            case 7:
                return "Juli"
                break;
            case 8:
                return "Agustus"
                break;
            case 9:
                return "September"
                break;
            case 10:
                return "Oktober"
                break;
            case 11:
                return "November"
                break;

            default:
                return "Desember"
                break;
        }
    }
}

function kecamatanKontroller($scope, kecamatanServices, message, helperServices) {
    $scope.$emit("SendUp", "Dafar Kecamatan");
    $scope.datas = [];
    $scope.model = {};
    $scope.modelKelurahan = {};
    kecamatanServices.get().then(res => {
        $scope.datas = res;
    })

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        $scope.tambah = true;
    }

    $scope.add = () => {
        $scope.tambah = true;
        $scope.setDetail = false;
        $scope.model = {};
    }

    $scope.batal = () => {
        $scope.tambah = false;
    }

    $scope.save = () => {
        message.dialog("Ingin Melanjutkan", "Yakin", "Tidak").then(x => {
            if ($scope.model.id) {
                kecamatanServices.put($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            } else {
                kecamatanServices.post($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            }
        })
    }

    $scope.hapus = (item) => {
        message.dialog("Ingin menghapus", "Ya", "Tidak").then(x => {
            kecamatanServices.deleted(item).then(res => {
                message.info("Berhasil menghapus data");

            })
        })
    }

    $scope.detailKecamatan = (item) => {
        document.location.href = helperServices.url + "admin/kelurahan?kecamatanid=" + item.id
    }
}

function kelurahanKontroller($scope, kelurahanServices, message, helperServices) {
    $scope.$emit("SendUp", "Kelurahan");
    $scope.datas = [];
    $scope.model = {};
    $scope.modelKelurahan = {};
    $scope.titleForm = "Tambah";
    const urlParams = new URLSearchParams(window.location.search);
    kelurahanServices.get(urlParams.get('kecamatanid')).then(res => {
        $scope.datas = res;
    })

    $scope.edit = (item, set) => {
        $scope.model = angular.copy(item);
        $scope.titleForm = set;
        $scope.tambah = true;
    }

    $scope.add = () => {
        $scope.tambah = true;
        $scope.setDetail = false;
    }

    $scope.batal = () => {
        $scope.tambah = false;
        $scope.titleForm = "Tambah";
    }

    $scope.save = () => {
        message.dialog("Ingin Melanjutkan", "Yakin", "Tidak").then(x => {
            if ($scope.model.id) {
                kecamatanServices.put($scope.model).then(res => {
                    $scope.info("Proses Berhasil");
                    $scope.model = {};
                })
            } else {
                kecamatanServices.post($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            }
        })
    }

    $scope.hapus = (item) => {
        message.dialog("Ingin menghapus", "Ya", "Tidak").then(x => {
            kecamatanServices.deleted(item).then(res => {
                message.info("Berhasil menghapus data");

            })
        })
    }

    $scope.detailKelurahan = (item) => {
        document.location.href = helperServices.url + "admin/rw?kelurahanid=" + item.id
    }
}

function rwKontroller($scope, rwServices, message, helperServices) {
    $scope.$emit("SendUp", "Kelurahan");
    $scope.datas = [];
    $scope.datasRt = [];
    $scope.model = {};
    $scope.modelRt = {};
    $scope.titleForm = "Tambah";
    $scope.titleFormRt = "Tambah";
    const urlParams = new URLSearchParams(window.location.search);
    rwServices.get(urlParams.get('kelurahanid')).then(res => {
        $scope.datas = res;
    })

    $scope.edit = (item, set) => {
        $scope.model = angular.copy(item);
        $scope.titleForm = set;
        $scope.tambah = true;
    }

    $scope.add = () => {
        $scope.tambah = true;
        $scope.setDetail = false;
    }

    $scope.batal = () => {
        $scope.tambah = false;
        $scope.titleForm = "Tambah";
    }

    $scope.save = () => {
        message.dialog("Ingin Melanjutkan", "Yakin", "Tidak").then(x => {
            if ($scope.model.id) {
                rwServices.put($scope.model).then(res => {
                    $scope.info("Proses Berhasil");
                    $scope.model = {};
                })
            } else {
                $scope.model.kelurahansid = urlParams.get('kelurahanid');
                rwServices.post($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            }
        })
    }
    $scope.saveRt = () => {
        message.dialog("Ingin Melanjutkan", "Yakin", "Tidak").then(x => {
            if ($scope.modelRt.id) {
                rwServices.putRt($scope.modelRt).then(res => {
                    $scope.info("Proses Berhasil");
                    $scope.modelRt = {};
                })
            } else {
                $scope.modelRt.rwid = angular.copy($scope.rwid);
                rwServices.postRt($scope.modelRt).then(res => {
                    message.info("Proses Berhasil");
                    $scope.modelRt = {};
                    $scope.tambah = false;
                })
            }
        })
    }

    $scope.hapus = (item) => {
        message.dialog("Ingin menghapus", "Ya", "Tidak").then(x => {
            rwServices.deleted(item).then(res => {
                message.info("Berhasil menghapus data");

            })
        })
    }

    $scope.hapusRt = (item) => {
        message.dialog("Ingin menghapus", "Ya", "Tidak").then(x => {
            rwServices.deletedRt(item).then(res => {
                message.info("Berhasil menghapus data");

            })
        })
    }

    $scope.detailRt = (item) => {
        $scope.tambah = false;
        $scope.setDetail = true;
        $scope.datasRt = item.rt
        $scope.rwid = angular.copy(item.id);
    }
}

function petugasKontroller($scope, petugasServices, message, helperServices) {
    $scope.$emit("SendUp", "Petugas");
    $scope.datas = [];
    $scope.kecamatans = {};
    $scope.wilayah = {};
    $scope.model = {};
    $scope.modelRt = {};
    $scope.titleForm = "Tambah";
    $scope.titleFormRt = "Tambah";
    petugasServices.get().then(res => {
        $scope.datas = res;
        $scope.datas.kecamatan.forEach(kecamatan => {
            kecamatan.kelurahan = $scope.datas.kelurahan.filter(x => x.kecamatanid == kecamatan.id);
        });
    })

    $scope.edit = (item, set) => {
        var kel = angular.copy($scope.datas.kelurahan.find(x => x.id == item.kelurahanid));
        var kec = angular.copy($scope.datas.kecamatan.find(x => x.id == kel.kecamatanid))
        $scope.kecamatans = kec;
        $scope.wilayah = kec.kelurahan.find(x => x.id == item.kelurahanid);
        $scope.model = angular.copy(item);
        $scope.titleForm = set;
        $scope.tambah = true;
    }

    $scope.add = () => {
        $scope.tambah = true;
        $scope.setDetail = false;
        $scope.titleForm = "Tambah";
        $scope.model = {};
    }

    $scope.batal = () => {
        $scope.tambah = false;
        $scope.titleForm = "Tambah";
    }

    $scope.save = () => {
        message.dialog("Ingin Melanjutkan", "Yakin", "Tidak").then(x => {
            if ($scope.model.id) {
                petugasServices.put($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            } else {
                petugasServices.post($scope.model).then(res => {
                    message.info("Proses Berhasil");
                    $scope.model = {};
                    $scope.tambah = false;
                })
            }
        })
    }

    $scope.hapus = (item) => {
        message.dialog("Ingin menghapus", "Ya", "Tidak").then(x => {
            petugasServices.deleted(item).then(res => {
                message.info("Berhasil menghapus data");

            })
        })
    }
}

function pendudukKontroller($scope, pendudukServices, message, helperServices) {
    $scope.$emit("SendUp", "Penduduk");
    $scope.datas = [];
    $scope.model = {};
    $scope.hubunganKeluarga = helperServices.hubunganKeluarga;
    $scope.ibuKandung = [];
    $scope.showForm = false;
    $scope.model.penduduk = [];
    $scope.kb = [];
    $scope.pb = [];
    $scope.jawab = "Ya";
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    pendudukServices.get().then(res => {
        $scope.datas = res;
        $scope.kb = $scope.datas.pertanyaan.filter(x=>x.kategori=='KB')
        $scope.pb = $scope.datas.pertanyaan.filter(x=>x.kategori=='PB')
        console.log(res);
    })
    $scope.add = () => {
        $scope.showForm = true;
    }

    $scope.edit = (item)=>{
        pendudukServices.getPenduduk(item.id).then(res=>{
            $scope.$applyAsync(x=>{
                $scope.model = angular.copy(item);
                $scope.model.penduduk = [];
                res.forEach(element => {
                   element.hubungan_keluarga = $scope.hubunganKeluarga.find(x=>x.no == element.hubungan_keluarga.no);
                   $scope.model.penduduk.push(element);
                   element.tanggal_lahir = new Date(element.tanggal_lahir);
                   element.usia_kawin = parseInt(element.usia_kawin);
                   element.urut = parseInt(element.urut);
                });
                $scope.kb = $scope.model.pertanyaan.filter(x=>x.kategori=='KB');
                $scope.pb = $scope.model.pertanyaan.filter(x=>x.kategori=='PB');
                $scope.rws = $scope.datas.kelurahan.rw.find(x=>x.id==item.rwid);
                $scope.rts = $scope.rws.rt.find(x=>x.id==item.rtid);
                $scope.model.no_rumah = parseInt($scope.model.no_rumah);
                $scope.model.jumlah_anggota = parseInt($scope.model.jumlah_anggota);
                console.log($scope.model);
                console.log($scope.kb);
                console.log($scope.pb);
                $scope.showForm = true;
            })
        })
    }

    $scope.check = (item) => {
        console.log(item);
    }

    $scope.setPenduduk = (item) => {
        $scope.$applyAsync(x => {
            $scope.model.penduduk = [];
            for (let index = 1; index <= item; index++) {
                if(index == 1){
                    var pen = { no: index, hubungan_keluarga: $scope.hubunganKeluarga.find(x=>x.no == '1'), urut: index  };
                    $scope.model.penduduk.push(pen);
                }else{
                    var pen = { no: index, urut: index};
                    $scope.model.penduduk.push(pen);
                }
            }
            console.log($scope.model);
        });
    }

    $scope.next = (current, next) => {
        if (animating) return false;
        animating = true;
        current_fs = $(current);
        next_fs = $(next);

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    }

    $scope.previous = (current, prev) => {
        if (animating) return false;
        animating = true;

        current_fs = $(current);
        previous_fs = $(prev);

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'left': left
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    }

    $scope.save = ()=>{
        if($scope.model.id){
            message.dialog('Ingin mengubah data?', 'Ya', 'Tidak').then(x=>{
                $scope.model.pertanyaan = [];
                $scope.kb.forEach(element => {
                    $scope.model.pertanyaan.push(element)
                });
                $scope.pb.forEach(element => {
                    $scope.model.pertanyaan.push(element)
                });
                pendudukServices.put($scope.model).then(res=>{
                    document.location.href = helperServices.url + "petugas/penduduk";
                })
            });
        }else{
            message.dialog('Ingin menyimpan data?', 'Ya', 'Tidak').then(x=>{
                $scope.model.pertanyaan = [];
                $scope.kb.forEach(element => {
                    $scope.model.pertanyaan.push(element)
                });
                $scope.pb.forEach(element => {
                    $scope.model.pertanyaan.push(element)
                });
                pendudukServices.post($scope.model).then(res=>{
                    document.location.href = helperServices.url + "petugas/penduduk";
                })
            });
        }
    }

    $scope.autoSet = (item, set, value )=>{
        if(set=='hubunganKeluarga'){
            if(item == 0){
                // var kepala = $scope.model.penduduk[0];
                // kepala.hubungan_keluarga = $scope.hubunganKeluarga.find(x=>x.no == '1');
                // console.log($scope.model.penduduk);
            }
        }else if(set=='ibuKandung'){
            if(value.no=='3'){
                $scope.ibuKandung = [];
                var check = $scope.model.penduduk[item-1];
                if(check.jenis_kelamin=='Perempuan'){
                    $scope.ibuKandung.push($scope.model.penduduk[item-1]);
                    $scope.ibuKandung.push({nama:"00"});
                }
                // else{

                // }
                // $scope.ibuKandung.push($scope.model.penduduk.find(x=>x.no == 2));
                // $scope.ibuKandung.push({nama:"00"});
                console.log($scope.ibuKandung);
            }
        }
    }

    $scope.hapus = (item)=>{
        pendudukServices.deleted(item).then(res=>{
            document.location.href = helperServices.url + "petugas/penduduk";
        })
    }
}

function kuesionerKontroller($scope, kuesionerServices, message, helperServices) {
    $scope.$emit("SendUp", "Kuesioner");
    $scope.datas = [];
    $scope.jawab = {};
    $scope.jawabSub = {};
    $scope.model = {};
    $scope.modelSub = {};
    $scope.tambah = false;
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
    kuesionerServices.get().then(res => {
        $scope.datas = res;
        console.log(res);
    })
    $scope.add = () => {
        $scope.tambah = true;
        $scope.model.setJawaban = 'tidak';
    }

    $scope.check = (item) => {
        console.log(item);
    }

    $scope.checkStatus = (item) => {
        console.log(item);
    }

    $scope.addItem = (item) => {
        $scope.model.opsi.push(angular.copy(item));
        $scope.jawab = {};
    }

    $scope.addItemSub = (item) => {
        $scope.modelSub.opsi.push(angular.copy(item));
        $scope.jawabSub = {};
    }

    $scope.hapusItem = (item) => {
        var index = $scope.model.opsi.indexOf(item);
        $scope.model.opsi.splice(index, 1);
    }
    $scope.hapusItemSub = (item) => {
        var index = $scope.modelSub.opsi.indexOf(item);
        $scope.modelSub.opsi.splice(index, 1);
    }

    $scope.addSub = () => {
        $scope.model.subPertanyaan.push(angular.copy($scope.modelSub));
        $scope.modelSub = {};
        $("#modelId").modal('hide');
    }

    $scope.save = () => {
        message.dialog("Ingin menambahkan data?", "Ya", "Tidak").then(x => {
            kuesionerServices.post($scope.model).then(res => {
                message.info("Proses Berhasil");
                $scope.jawab = {};
                $scope.jawabSub = {};
                $scope.model = {};
                $scope.modelSub = {};
                $scope.tambah = false;
            })
        })
    }
}

