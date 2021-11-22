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
    $scope.showForm = false;

    pendudukServices.get().then(res => {
        $scope.datas = res;
        console.log(res.kelurahan);
    })
    $scope.add = () => {
        $scope.showForm = true;
    }

    $scope.check = (item) => {
        console.log(item);
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
    kuesionerServices.get().then(res=>{
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

