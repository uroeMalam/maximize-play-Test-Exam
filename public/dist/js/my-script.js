$(document).ready(function () {
    $(document).on("change", 'input[type="file"]', function (e) {
        var fileName = e.target.files[0].name;
        $(".custom-file-label").html(fileName);
    });
    $(".select2").select2({
        theme: "bootstrap4",
    });
    $("body").on("shown.bs.modal", ".modal", function () {
        $(this)
            .find("select")
            .each(function () {
                var dropdownParent = $(document.body);
                if ($(this).parents(".modal.in:first").length !== 0)
                    dropdownParent = $(this).parents(".modal.in:first");
                $(this).select2({
                    dropdownParent: dropdownParent,
                    theme: "bootstrap4",
                });
            });
    });
});

function show_loading(element, buttonType = "icon") {
    $(element).addClass("disabled");
    $(element).attr("disabled", true);

    if (buttonType == "full") {
        $(element).html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading ..."
        );
    } else {
        $(element).html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>"
        );
    }
}

function hide_loading(element, icon, buttonType = "icon", text = "") {
    $(element).removeClass("disabled");
    $(element).attr("disabled", false);

    if (buttonType == "full") {
        if (icon != "") {
            $(element).html(`<i class="fa fa-fw fa-${icon}"></i> ${text}`);
        } else {
            $(element).html(`${text}`);
        }
    } else {
        $(element).html(`<i class="fa fa-fw fa-${icon}"></i>`);
    }
}

function clearInput() {
    $("form")
        .find(
            "input[type=text], input[type=password], input[type=number], input[type=email], textarea"
        )
        .val("");

    $("form").find(".custom-file-label").val("Pilih Gambar");
}

function check_errors_withStyle(errors) {
    for (var k in errors) {
        let split_id = k.split(".");
        let id;
        if (split_id.length > 0) {
            id = `#${split_id[0]}`;
        } else {
            id = `#${k}`;
        }

        $(`small${id}`).html(errors[k]);
        $(`small${id}`).removeClass("d-none");

        $(`input${id}`).addClass("is-invalid");
        $(`textarea${id}`).addClass("is-invalid");
        $(`select${id}`).addClass("is-invalid");
    }
}

function clear_error_withStyle() {
    $(`input`).removeClass("is-invalid");
    $(`select`).removeClass("is-invalid");
    $(`textarea`).removeClass("is-invalid");
    $(`small`).addClass("d-none");
    $(`small`).html("");
}

function deleteConfirm(url, table, text, token, id) {
    Swal.fire({
        title: `Yakin Menghapus ${text}?`,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#FF0000",
        reverseButtons: !0,
    }).then(
        function (e) {
            if (e.value === true) {
                $.ajax({
                    type: "delete",
                    url: url,
                    data: {
                        _token: token,
                        id: id,
                    },
                    dataType: "JSON",
                    success: function (results) {
                        if (results.status) {
                            Swal.fire(
                                "Berhasil!",
                                results.message,
                                "success"
                            ).then(function () {
                                table.ajax.reload();
                            });
                        } else {
                            Swal.fire("Error!", results.message, "error");
                        }
                    },
                });
            } else {
                e.dismiss;
            }
        },
        function (dismiss) {
            return false;
        }
    );
}
