"use strict";

var KTUsersList = function () {
    var e, t, n, r;
    var o = document.getElementById("kt_table_users");

    var c = () => {
        o.querySelectorAll('[data-kt-users-table-filter="delete_row"]').forEach((t) => {
            t.addEventListener("click", function (t) {
                t.preventDefault();

                const n = t.target.closest("tr");
                const r = n.querySelectorAll("td")[1].querySelectorAll("a")[1].innerText;

                Swal.fire({
                    text: "Are you sure you want to delete " + r + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + r + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn fw-bold btn-primary" }
                        }).then(() => {
                            e.row($(n)).remove().draw();
                        }).then(() => { a(); });
                    } else if (result.dismiss === "cancel") {
                        Swal.fire({
                            text: r + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn fw-bold btn-primary" }
                        });
                    }
                });
            });
        });
    };

    var l = () => {
        const checkboxes = o.querySelectorAll('[type="checkbox"]');
        t = document.querySelector('[data-kt-user-table-toolbar="base"]');
        n = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        r = document.querySelector('[data-kt-user-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

        checkboxes.forEach((e) => {
            e.addEventListener("click", function () {
                setTimeout(() => { a(); }, 50);
            });
        });

        deleteSelected.addEventListener("click", function () {
            Swal.fire({
                text: "Are you sure you want to delete selected customers?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        text: "You have deleted all selected customers!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn fw-bold btn-primary" }
                    }).then(() => {
                        checkboxes.forEach((t) => {
                            if (t.checked) {
                                e.row($(t.closest("tbody tr"))).remove().draw();
                            }
                        });
                        o.querySelectorAll('[type="checkbox"]')[0].checked = false;
                    }).then(() => {
                        a();
                        l();
                    });
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Selected customers were not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn fw-bold btn-primary" }
                    });
                }
            });
        });
    };

    const a = () => {
        const e = o.querySelectorAll('tbody [type="checkbox"]');
        let hasSelection = false;
        let selectedCount = 0;

        e.forEach((checkbox) => {
            if (checkbox.checked) {
                hasSelection = true;
                selectedCount++;
            }
        });

        if (hasSelection) {
            r.innerHTML = selectedCount;
            t.classList.add("d-none");
            n.classList.remove("d-none");
        } else {
            t.classList.remove("d-none");
            n.classList.add("d-none");
        }
    };

    return {
        init: function () {
            if (!o) return;

            var totalColumns = $(o).find('thead th').length; // Menghitung jumlah kolom
            var nonOrderableColumns = [0, totalColumns - 1];

            e = $(o).DataTable({
                info: true,
                order: [],
                pageLength: 10,
                lengthChange: true,
                columnDefs: nonOrderableColumns.map(col => ({
                    orderable: false,
                    targets: col
                }))
            }).on("draw", function () {
                l();
                c();
                a();
            });

            l();
            document.querySelector('[data-kt-user-table-filter="search"]').addEventListener("keyup", function (t) {
                e.search(t.target.value).draw();
            });

            document.querySelector('[data-kt-user-table-filter="reset"]').addEventListener("click", function () {
                document.querySelector('[data-kt-user-table-filter="form"]').querySelectorAll("select").forEach((e) => {
                    $(e).val("").trigger("change");
                });
                e.search(" ").draw();
            });

            c();

            (() => {
                const t = document.querySelector('[data-kt-user-table-filter="form"]');
                const n = t.querySelector('[data-kt-user-table-filter="filter"]');
                const r = t.querySelectorAll("select");

                n.addEventListener("click", function () {
                    var filterQuery = "";
                    r.forEach((e, index) => {
                        if (e.value && e.value !== "") {
                            if (index !== 0) filterQuery += " ";
                            filterQuery += e.value;
                        }
                    });
                    e.search(filterQuery).draw();
                });
            })();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
