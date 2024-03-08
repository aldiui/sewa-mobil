const datatableCall = (targetId, url, columns) => {
    $(`#${targetId}`).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "GET",
            data: function (d) {
                d.mode = "datatable";
                d.bulan = $("#bulan_filter").val() ?? null;
                d.tahun = $("#tahun_filter").val() ?? null;
                d.tanggal = $("#tanggal_filter").val() ?? null;
            },
        },
        columns: columns,
        lengthMenu: [
            [25, 50, 100, 250, -1],
            [25, 50, 100, 250, "All"],
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json",
        },
    });
};

const ajaxCall = (url, method, data, successCallback, errorCallback) => {
    $.ajax({
        type: method,
        enctype: "multipart/form-data",
        url,
        cache: false,
        data,
        contentType: false,
        processData: false,
        headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
        dataType: "json",
        success: function (response) {
            successCallback(response);
        },
        error: function (error) {
            errorCallback(error);
        },
    });
};

const getModal = (targetId, url = null, fields = null) => {
    $(`#${targetId}`).modal("show");
    $(`#${targetId} .form-control`).removeClass("is-invalid");
    $(`#${targetId} .invalid-feedback`).html("");
    $(`#${targetId} .error-message`).html("");
    const cekLabelModal = $("#label-modal");
    if (cekLabelModal) {
        $("#id").val("");
        cekLabelModal.text("Tambah");
    }

    if (url && fields !== "detailPeminjaman") {
        cekLabelModal.text("Edit");
        const successCallback = function (response) {
            fields.forEach((field) => {
                if (response.data[field]) {
                    $(`#${targetId} #${field}`)
                        .val(response.data[field])
                        .trigger("change");
                }
            });
        };

        const errorCallback = function (error) {
            console.log(error);
        };
        ajaxCall(url, "GET", null, successCallback, errorCallback);
    } else if (fields == "detailPeminjaman") {
        const successCallback = function (response) {
            $(`#${targetId} #mobil_id`).val(response.data.id).trigger("change");
            $(`#${targetId} #merek-mobil`).html(
                response.data.merek + " - " + response.data.model
            );
            $(`#${targetId} #bg-img`).css(
                "background-image",
                `url('/storage/image/mobil/${response.data.image}')`
            );
        };

        const errorCallback = function (error) {
            console.log(error);
        };
        ajaxCall(url, "GET", null, successCallback, errorCallback);
    }
    $(`#${targetId} .form-control`).val("");
};

const formatRupiah = (angka) => {
    var reverse = angka.toString().split("").reverse().join(""),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(".").split("").reverse().join("");
    return "Rp " + ribuan;
};

const handleSuccess = (
    response,
    dataTableId = null,
    modalId = null,
    redirect = null
) => {
    if (dataTableId !== null) {
        swal({
            title: "Berhasil",
            icon: "success",
            text: response.message,
            timer: 2000,
            buttons: false,
        });
        $(`#${dataTableId}`).DataTable().ajax.reload();
    }

    if (modalId !== null) {
        $(`#${modalId}`).modal("hide");
    }

    if (redirect) {
        swal({
            title: "Berhasil",
            icon: "success",
            text: response.message,
            timer: 2000,
            buttons: false,
        }).then(function () {
            window.location.href = redirect;
        });
    }

    if (redirect == "no") {
        swal({
            title: "Berhasil",
            icon: "success",
            text: response.message,
            timer: 2000,
            buttons: false,
        });
    }
};

const handleValidationErrors = (error, formId = null, fields = null) => {
    if (error.responseJSON.data && fields) {
        fields.forEach((field) => {
            if (error.responseJSON.data[field]) {
                $(`#${formId} #${field}`).addClass("is-invalid");
                $(`#${formId} #error${field}`).html(
                    error.responseJSON.data[field][0]
                );
            } else {
                $(`#${formId} #${field}`).removeClass("is-invalid");
                $(`#${formId} #error${field}`).html("");
            }
        });
    } else {
        swal({
            title: "Gagal",
            icon: "error",
            text: error.responseJSON.message || error,
            timer: 2000,
            buttons: false,
        });
    }
};

const handleSimpleError = (error) => {
    swal({
        title: "Gagal",
        icon: "error",
        text: error,
        timer: 2000,
        buttons: false,
    });
};

const confirmDelete = (url, tableId) => {
    swal({
        title: "Apakah Kamu Yakin?",
        text: "ingin menghapus data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            const data = null;

            const successCallback = function (response) {
                handleSuccess(response, tableId, null);
            };

            const errorCallback = function (error) {
                console.log(error);
            };

            ajaxCall(url, "DELETE", data, successCallback, errorCallback);
        }
    });
};

const setButtonLoadingState = (buttonSelector, isLoading, title = "Simpan") => {
    const buttonText = isLoading
        ? `<i class="fas fa-spinner fa-spin mr-1"></i> ${title}`
        : title;
    $(buttonSelector).prop("disabled", isLoading).html(buttonText);
};

const getMenus = (page) => {
    let search = $("#search").val();
    let status = $("#status").val();
    $.ajax({
        url: `/sewa-mobil?page=${page}`,
        data: {
            search,
            status,
        },
    }).done(function (data) {
        $("#mobils").html(data);
    });
};
const cariPlatNomor = () => {
    const platNomor = $("#nomor_plat").val().trim();
    const url = "/peminjaman?nomor_plat=" + platNomor;

    if (platNomor !== "" && platNomor !== null) {
        $.ajax({
            url,
        })
            .done(function (data) {
                $("#data-pengembalian").html(data);
            })
            .fail(function (data) {
                if (data.responseJSON && data.responseJSON.message) {
                    handleSimpleError(data.responseJSON.message);
                } else {
                    handleSimpleError("Terjadi kesalahan pada server.");
                }
            });
    }
};

const cleanModal = () => {
    $("#nomor_plat").val("");
    $("#data-pengembalian").empty();
};

const getModalDetail = (targetId, url) => {
    $(`#${targetId}`).modal("show");

    $.ajax({
        url,
    })
        .done(function (data) {
            $(`#${targetId} #detail`).html(data);
        })
        .fail(function (data) {
            if (data.responseJSON && data.responseJSON.message) {
                handleSimpleError(data.responseJSON.message);
            } else {
                handleSimpleError("Terjadi kesalahan pada server.");
            }
        });
};
