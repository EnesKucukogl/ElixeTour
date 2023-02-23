 const statuses = [
    {"Id": 1, "Name": "Beklemede"},
    {"Id": 2, "Name": "Cevaplandı"}];

$(document).ready(function () {

    $('#gridContainer').dxDataGrid(

        {
            keyExpr: "Id",
            dataSource: '/rudder/contact-list',
            columns: [
                {
                    type: "buttons",
                    width: 75,
                    buttons: [
                        {
                            name: "edit",
                            hint: "Güncelle",
                            icon: "fa fa-edit",
                            disabled: function (e) {
                                return !e.row.key.active;
                                },
                            onClick: function (e) {
                                getFormById(e.row.key.Id);
                            }
                        },
                        {
                            hint: "Sil",
                            icon: "fa fa-trash",
                            disabled: function (e){
                                return !e.row.key.active;
                            },
                            onClick: function (e) {
                                var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
                                result.done(function (dialogResult) {
                                    if (dialogResult) {

                                        if(e.row.key.active == 1){
                                            active = 0;
                                        }


                                        changeStatus(e.row.key.Id,active);

                                    }
                                });
                            }
                        }


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
                    dataField: "phone_number",
                    caption: "Phone Number",
                    minwidth: 100
                },
                {
                    dataField: "message_content",
                    caption: "Message Content",
                    width: 200
                },
                {
                    dataField: "send_date",
                    caption: "Send Date",
                    dataType: "date",
                    displayFormat: "dd.MM.yyyy",
                    dateSerializationFormat: "yyyy-MM-dd",
                    width: 100,
                    sortIndex: 0,
                    sortOrder: "desc"
                },
                {
                    dataField: "status",
                    caption: "Status",
                    width: 100,

                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    { id: 1, name: "Beklemede" },
                                    { id: 2, name: "Cevaplandı" },

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
                    caption: "Active",
                    width: 100,

                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    { id: 0, name: "Hayır" },
                                    { id: 1, name: "Evet" },

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

    $('#addContact').on('click', function () {
        getFormById(-1);
    });


    const changeStatus = async (formId,active) => {

        $.ajax({
            data: {Id:formId,active:active},
            url: 'contact/'+formId,
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                $("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    const getFormById = async (formId) => {

        if (formId == "-1") {
            $("#modelHeading").html("Contact Ekle");
            let formJson = await contactInsertUpdateForm(null);
            $("#frmEditContact").dxForm(formJson);
        }
        else {
            var result;
            $.ajax({
                type: "GET",
                url: 'contact' +'/'+formId+'/edit',
                datatype: "json",
                async: false,
                success: function(data){
                    result = data;
                }
            });

            $('#modelHeading').html("Contact Düzenle");
            let formJson = await contactInsertUpdateForm(result);
            $("#frmEditContact").dxForm(formJson);

        }


        $('#updateContact').modal('show');
        $("#btnSaveContact").unbind();
        $("#btnSaveContact").on("click", function () {
            var frm = $("#frmEditContact").dxForm("instance");
            var validate = frm.validate();
            if (validate.isValid) {

                var json = frm.option("formData");

                console.log(json);
                saveContact(json);
            }
        });
    }

    const contactInsertUpdateForm = async (data = {}) => {

        console.log("data", data);


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
                    dataField: "phone_number",
                    label: {
                        text: 'Phone Number '

                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "message_content",
                    editorType: 'dxTextArea',
                    label: {
                        text: 'Message Content '
                    },
                    editorOptions: {
                        height : "200px",
                        readOnly: true
                    },
                },



                {
                    dataField: "send_date",
                    label: {
                        text: 'Send Date ',
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        dataType: "date",
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },

                },
                {
                    dataField: "status",
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
            ]
        }
    };

    const saveContact = async (json) => {

        $.ajax({
            data: json ,
            url: "contact",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                //console.log("result"+JSON.stringify(data));
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateContact').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }

});
