const statuses = [
    {"Id": 0, "Name": "Pasif"},
    {"Id": 1, "Name": "Aktif"}];
$(document).ready(function () {
    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/currency-list',
        columns: [
            {
                type: "buttons",
                width: 75,
                buttons: [
                    {
                        name: "edit",
                        hint: "Güncelle",
                        icon: "fa fa-edit",
                        onClick: function (e) {
                            getFormById(e.row.key.Id);
                        },
                        cssClass: "my-edit-button"
                    },
                    {
                        hint: "Sil",
                        icon: "fa fa-arrow-rotate-left",
                        onClick: function (e) {
                            var result = DevExpress.ui.dialog.confirm("<i>Bu kayıdı güncellemek istediğinize emin misiniz?</i>", "Kayıt silme işlemi");
                            result.done(function (dialogResult) {
                                if (dialogResult) {

                                    if (e.row.key.active == 1) {
                                        active = 0;
                                    } else if (e.row.key.active == 0) {
                                        active = 1;
                                    }
                                    changeStatus(e.row.key.Id, active);
                                }
                            });
                        }
                    }

                ]
            },
            {
                dataField: "name",
                caption: "Adı",
                minwidth: 100
            },
            {
                dataField: "symbol",
                caption: "Sembol",
                minwidth: 100
            },
            {
                dataField: "code",
                caption: "Kod",
                minwidth: 100
            },
            {
                dataField: "active",
                caption: "Active",
                width: 200,

                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                {id: 0, name: "Pasif"},
                                {id: 1, name: "Aktif"},

                            ],
                            key: 'Id'
                        }
                    },
                    valueExpr: "id", // contains the same values as the "statusId" field provides
                    displayExpr: "name" // provides display values
                },
            },
        ],

        editing: {
            mode: "row",
            allowUpdating: true
        },
        remoteOperations: false,
        showBorders: true,
        paging: {
            pageSize: 10,
        },

        columnAutoWidth: true,

        pager: {
            showPageSizeSelector: true,
            allowedPageSizes: [10, 25, 50, 100],
            showInfo: true
        },
        allowColumnReordering: true,
        rowAlternationEnabled: true,

        filterRow: {
            visible: true,
            applyFilter: 'auto',
        },

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addCurrency').on('click', function () {
        getFormById(-1);
    });


    const changeStatus = async (formId, visible) => {
        $.ajax({
            data: {Id: formId, active: visible},
            url: 'currency/' + formId,
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    };

    const getFormById = async (formId) => {

        if (formId == "-1") {
            $("#modelHeading").html("Dil Ekle");
            let formJson = await CurrencyInsertUpdateForm(null);
            $("#frmEditCurrency").dxForm(formJson);
        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'currency' + '/' + formId + '/edit',
                datatype: "json",
                async: false,
                success: function (data) {
                    result = data;
                }
            });

            $('#modelHeading').html("Dil Düzenle");
            let formJson = await CurrencyInsertUpdateForm(result);
            $("#frmEditCurrency").dxForm(formJson);

        }
        $('#updateCurrency').modal('show');
        $("#btnSaveCurrency").unbind();
        $("#btnSaveCurrency").on("click", function () {
            var frm = $("#frmEditCurrency").dxForm("instance");
            var validate = frm.validate();
            if (validate.isValid) {

                var json = frm.option("formData");

                console.log(json);
                saveCurrency(json);
            }
        });
    }


    const CurrencyInsertUpdateForm = async (data = {}) => {

        console.log("data", data);

        return {
            colCount: 1,
            formData: data,
            items: [
                {
                    dataField: "name",
                    label: {
                        text: 'İsim',
                    },
                },
                {
                    dataField: "symbol",
                    label: {
                        text: 'Sembol',
                    },
                },
                {
                    dataField: "code",
                    label: {
                        text: 'Kod',
                    },
                },
                {
                    dataField: "active",
                    editorType: 'dxSelectBox',
                    label: {
                        text: 'Status '
                    },
                    editorOptions: {
                        items: statuses,
                        searchEnabled: true,
                        displayExpr: 'Name',
                        valueExpr: 'Id'
                    },
                },
            ],
        }
    };

    const saveCurrency = async (json) => {
        $.ajax({
            data: json,
            url: "currency",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                // console.log("result"+JSON.stringify(data));
                toastr.success("Record saved successfully.");
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateCurrency').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                toastr.error("name symbol and code column cannot be null");
                console.log('Error:', data);
            }
        });
    }
});

