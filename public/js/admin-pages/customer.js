const statuses = [
    {"Active": 0, "Name": "Üye Değil"},
    {"Active": 1, "Name": "Üye"}];
const prop = [
    {"Stats": 0, "Name": "Satın Alım Yok"},
    {"Stats": 1, "Name": "Satın Alım Var"}];
$( document ).ready(function() {
    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/customer-list' ,
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
                    // {
                    //     hint: "Sil",
                    //     icon: "fa fa-trash",
                    //     onClick: function (e) {
                    //         var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
                    //         result.done(function (dialogResult) {
                    //             if (dialogResult) {
                    //
                    //                 if(e.row.key.active == 1){
                    //                     active = 0;
                    //                 }
                    //                 else {
                    //                     DevExpress.ui.dialog.confirm("<i>hatalı işlem!!!</i>", "Kayıt silme işlemi");
                    //
                    //                 }
                    //                 changeStatus(e.row.key.Id,active);
                    //             }
                    //         });
                    //     }
                    // }

                ]
            },
            {
                dataField: "name",
                caption: "Adı",
                minwidth: 100
            },
            {
                dataField: "surname",
                caption: "Soyadı",
                minwidth: 100
            },
            {
                dataField: "e_mail",
                caption: "E-Mail",
                minwidth: 100
            },
            {
                dataField: "address",
                caption: "Adres",
                minwidth: 100
            },
            {
                dataField: "phone_number",
                caption: "Telefon Numarası",
                minwidth: 100
            },
            {
                dataField: "date_of_birth",
                caption: "Doğum Tarihi",
                minwidth: 100
            },
            {
                dataField: "registration_date",
                caption: "Kayıt tarihi",
                minwidth: 100
            },
            {
                dataField: "active",
                caption: "Aktif",
                width: 100,

                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                { id: 0, name: "Üye Değil" },
                                { id: 1, name: "Üye" },

                            ],
                            key: 'Id'
                        }
                    },
                    valueExpr: "id", // contains the same values as the "statusId" field provides
                    displayExpr: "name" // provides display values
                },
            },
            {
                dataField: "membership_status",
                caption: "Müşteri Durumu",
                width: 200,

                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                { id: 0, name: "Satın Alım Var" },
                                { id: 1, name: "Satın Alım Yok" },

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
    Customer.on('click', function () {
        getFormById(-1);
    });


    const changeStatus = async (formId,visible) => {
        $.ajax({
            data: {Id:formId,active:visible},
            url: 'customer/'+formId,
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
            let formJson = await CustomerInsertUpdateForm(null);
            $("#frmEditCustomer").dxForm(formJson);
        }
        else {
            var result;
            $.ajax({
                type: "GET",
                url: 'customer' +'/'+formId+'/edit',
                datatype: "json",
                async: false,
                success: function(data){
                    result = data;
                }
            });

            $('#modelHeading').html("Dil Düzenle");
            let formJson = await CustomerInsertUpdateForm(result);
            $("#frmEditCustomer").dxForm(formJson);

        }
        $('#updateCustomer').modal('show');
        $("#btnSaveCustomer").unbind();
        $("#btnSaveCustomer").on("click", function () {
            var frm = $("#frmEditCustomer").dxForm("instance");
            var validate = frm.validate();
            if (validate.isValid) {

                var json = frm.option("formData");

                console.log(json);
                saveCustomer(json);
            }
        });
    }


    const CustomerInsertUpdateForm = async (data = {}) => {

        console.log("data", data);

        return {
            colCount: 1,
            formData: data,
            items: [
                {
                    dataField: "name",
                    readonly: true,
                    label: {
                        text: 'İsim',
                    },
                },
                {
                    dataField: "surname",
                    readonly: true,
                    label: {
                        text: 'Soyad',
                    },
                },
                {
                    dataField: "e_mail",
                    readonly: true,
                    label: {
                        text: 'E-Mail',
                    },
                },
                {
                    dataField: "address",
                    readonly: true,
                    label: {
                        text: 'Adres',
                    },
                },
                {
                    dataField: "phone_number",
                    readonly: true,
                    label: {
                        text: 'Telefon Numarası',
                    },
                },
                {
                    dataField: "date_of_birth",
                    readonly: true,
                    label: {
                        text: 'Doğum Tarihi',
                    },
                },
                {
                    dataField: "membership_status",
                    readonly: true,
                    label: {
                        text: 'Müşteri Durumu',
                    },
                },
                {
                    dataField: "registration_date",
                    readonly: true,
                    label: {
                        text: 'Kayıt Tarih',
                    },
                },
                {
                    dataField: "active",
                    label: {
                        text: 'Aktif',
                    },
                },
                {
                    dataField: "membership_status",
                    label: {
                        text: 'Müşteri Durumu',
                    },
                },
            ],
        }
    };

    const saveCustomer = async (json) => {
        $.ajax({
            data: json ,
            url: "customer",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                // console.log("result"+JSON.stringify(data));
                toastr.success("Record saved successfully.");
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateCustomer').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                toastr.error("name and symbol column cannot be null");
                console.log('Error:', data);
            }
        });
    }
});
