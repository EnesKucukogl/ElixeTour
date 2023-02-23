$( document ).ready(function() {
    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/currency-list' ,
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
                        }
                    },
                    {
                        hint: "Sil",
                        icon: "fa fa-trash",
                        onClick: function (e) {
                            var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
                            result.done(function (dialogResult) {
                                if (dialogResult) {

                                    if(e.row.key.active == 1){
                                        active = 0;
                                    }
                                    else {
                                        DevExpress.ui.dialog.confirm("<i>hatalı işlem!!!</i>", "Kayıt silme işlemi");

                                    }
                                    changeStatus(e.row.key.Id,active);
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
                dataField: "active",
                caption: "Aktif",
                minwidth: 100
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


    const changeStatus = async (formId,visible) => {
        $.ajax({
            data: {Id:formId,active:visible},
            url: 'currency/'+formId,
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })};

    const getFormById = async (formId) => {

        if (formId == "-1") {
            $("#modelHeading").html("Dil Ekle");
            let formJson = await CurrencyInsertUpdateForm(null);
            $("#frmEditCurrency").dxForm(formJson);
        }
        else {
            var result;
            $.ajax({
                type: "GET",
                url: 'currency' +'/'+formId+'/edit',
                datatype: "json",
                async: false,
                success: function(data){
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
            ],
        }
    };

    const saveCurrency = async (json) => {
        $.ajax({
            data: json ,
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
                toastr.error("name and symbol column cannot be null");
                console.log('Error:', data);
            }
        });
    }
});

