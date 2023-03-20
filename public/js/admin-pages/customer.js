const statuses = [
    {"Id": 0, "Name": "Üye değil"},
    {"Id": 1, "Name": "Üye"}];

const stats = [
    {"Id": 0, "Name": "Satın alım yok"},
    {"Id": 1, "Name": "Satın alım var"}];

$(document).ready(function () {

    $('#gridContainer').dxDataGrid(

        {
            keyExpr: "Id",
            dataSource: '/rudder/customer-list',
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
                    ]
                },

                {
                    dataField: "Id",
                    caption: "Id",
                    minwidth: 100
                },
                {
                    dataField: "name",
                    caption: "Name",
                    minwidth: 100
                },
                {
                    dataField: "surname",
                    caption: "Surname",
                    minwidth: 100
                },
                {
                    dataField: "e_mail",
                    caption: "E Mail",
                    minwidth: 100
                },
                {
                    dataField: "address",
                    caption: "Adres",
                    minwidth: 100
                },
                {
                    dataField: "phone_number",
                    caption: "Phone Number",
                    minwidth: 100
                },
                {
                    dataField: "date_of_birth",
                    caption: "Doğum tarihi",
                    minwidth: 100
                },
                {
                    dataField: "registration_date",
                    caption: "Kayıt tarihi",
                    minwidth: 100
                },
                {
                    dataField: "membership_status",
                    caption: "Satın alım",
                    width: 200,

                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    { id: 1, name: "Satın alım yok" },
                                    { id: 2, name: "Satın alım var" },

                                ],
                                key: 'Id'
                            }
                        },
                        valueExpr: "id", // contains the same values as the "statusId" field provides
                        displayExpr: "name" // provides display values
                    },
                },
                {
                    dataField: "active",
                    caption: "Müşteri durumu",
                    width: 200,

                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    { id: 0, name: "üye değil" },
                                    { id: 1, name: "üye" },

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
                allowUpdating: true,

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

    const getFormById = async (formId) => {
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

            $('#modelHeading').html("Müşteri Düzenle");
            let formJson = await customerInsertUpdateForm(result);
            $("#frmEditCustomer").dxForm(formJson);

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

    const customerInsertUpdateForm = async (data = {}) => {

        // console.log("data", data);
        return {
            colCount: 2,
            formData: data,
            items: [
                {
                    dataField: "name",
                    label: {
                        text: 'Name '

                    },
                    editorOptions: {
                        readOnly: true
                    },

                },

                {
                    dataField: "surname",
                    label: {
                        text: 'Surname '
                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "e_mail",
                    label: {
                        text: 'E Mail '
                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "address",
                    label: {
                        text: 'Adres '
                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "phone_number",
                    label: {
                        text: 'Telefon numarası '

                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "date_of_birth",
                    label: {
                        text: 'Doğum tarihi',
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        readOnly: true,
                        dataType: "date",
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },
                },
                {
                    dataField: "registration_date",
                    label: {
                        text: 'Kayıt tarihi ',
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        readOnly: true,
                        dataType: "date",
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },
                },
                {
                    dataField: "active",
                    editorType: 'dxSelectBox',
                    label: {
                        text: 'Müşteri durumu '
                    },
                    editorOptions: {
                        items: statuses,
                        searchEnabled: true,
                        displayExpr: 'Name',
                        valueExpr: 'Id'
                    },
                },
                {
                    dataField: "membership_status",
                    editorType: 'dxSelectBox',
                    label: {
                        text: 'Satın alım '
                    },
                    editorOptions: {
                        items: stats,
                        searchEnabled: true,
                        displayExpr: 'Name',
                        valueExpr: 'Id'
                    },
                },
            ]
        }
    };

    const saveCustomer = async (json) => {

        $.ajax({
            data: json ,
            url: "customer",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                msg('Düzenlenme Başarılı',"success");
                //console.log("result"+JSON.stringify(data));
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateCustomer').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }

});
