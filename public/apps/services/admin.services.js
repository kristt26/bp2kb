angular.module('admin.service', [])
    .factory('dashboardServices', dashboardServices)
    .factory('homeServices', homeServices)
    .factory('kecamatanServices', kecamatanServices)
    .factory('kelurahanServices', kelurahanServices)
    .factory('rwServices', rwServices)
    .factory('petugasServices', petugasServices)
    .factory('pendudukServices', pendudukServices)
    .factory('kuesionerServices', kuesionerServices)
    ;


function dashboardServices($http, $q, $state, helperServices, AuthService) {
    var controller = helperServices.url + 'users';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        post: post,
        put: put
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller,
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    service.instance = true;
                    service.data = res.data;
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: helperServices.url + 'administrator/createuser/' + param.roles,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: helperServices.url + 'administrator/updateuser/' + param.id,
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.firstName = param.firstName;
                    data.lastName = param.lastName;
                    data.userName = param.userName;
                    data.email = param.email;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

}

function homeServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'admin/home';
    var service = {};
    service.data = [];
    return {
        get: get
    };

    function get() {
        var def = $q.defer();
        if (service.instance) {
            def.resolve(service.data);
        } else {
            $http({
                method: 'get',
                url: controller + "/read",
                headers: AuthService.getHeader()
            }).then(
                (res) => {
                    def.resolve(res.data);
                },
                (err) => {
                    def.reject(err);
                }
            );
        }
        return def.promise;
    }

}

function kecamatanServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/kecamatan';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/",
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { kecamatan: param.kecamatan, jenis: param.jenis};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.kecamatan = param.kecamatan;
                    data.jenis = param.jenis;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}

function kelurahanServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/kelurahan';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted
    };

    function get(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/" + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { kecamatan: param.kecamatan, jenis: param.jenis};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.kecamatan = param.kecamatan;
                    data.jenis = param.jenis;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}

function rwServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/rw';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted,
        postRt: postRt, 
        putRt: putRt, 
        deletedRt: deletedRt
    };

    function get(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/" + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { kecamatan: param.kecamatan, jenis: param.jenis};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.kecamatan = param.kecamatan;
                    data.jenis = param.jenis;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function postRt(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/postrt",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x=>x.id ==param.rwid);
                if(data){
                    data.rt.push(res.data);
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function putRt(param) {
        var item = { rt: param.rt, rwid: param.rwid};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/putrt/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.rwid);
                if (data) {
                    var dataRt = data.rt.find(x=>x.id==param.id);
                    if(dataRt){
                        dataRt.rt = param.rt
                    }
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deletedRt(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/deletert/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.rwid);
                if(data){
                    var index = data.rt.indexOf(param);
                    data.rt.splice(index, 1);
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}

function petugasServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/petugas';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted
    };

    function get(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/" + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.petugas.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { nama: param.nama, telepon: param.telepon, alamat: param.alamat};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.petugas.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.telepon = param.telepon;
                    data.alamat = param.alamat;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}

function pendudukServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'petugas/penduduk';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted
    };

    function get(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/" + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.petugas.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { nama: param.nama, telepon: param.telepon, alamat: param.alamat};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.petugas.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.telepon = param.telepon;
                    data.alamat = param.alamat;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}

function kuesionerServices($http, $q, helperServices, AuthService, message) {
    var controller = helperServices.url + 'admin/kuesioner';
    var service = {};
    service.data = [];
    return {
        get: get, 
        post: post, 
        put: put, 
        deleted: deleted
    };

    function get(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + "/read/" + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/post",
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function put(param) {
        var item = { nama: param.nama, telepon: param.telepon, alamat: param.alamat};
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + "/put/" + param.id,
            data: item,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.petugas.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.telepon = param.telepon;
                    data.alamat = param.alamat;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }
}