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
                            cssClass: "my-edit-button",
                            disabled: function (e) {
                                return e.row.key.status !== 1;
                            },
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
                    caption: "E Mail",
                    minwidth: 100
                },
                {
                    dataField: "phone_number",
                    caption: "Telefon",
                    minwidth: 100
                },
                {
                    dataField: "message_content",
                    caption: "Mesaj",
                    minWidth: 200
                },
                {
                    dataField: "send_date",
                    caption: "Gönderim Tarihi",
                    dataType: "date",
                    displayFormat: "dd.MM.yyyy",
                    dateSerializationFormat: "yyyy-MM-dd",
                    width: 150,
                    sortIndex: 0,
                    sortOrder: "desc"
                },
                {
                    dataField: "status",
                    caption: "Durum",
                    minWidth: 100,

                    lookup: {
                        dataSource: {
                            store: {
                                type: "array",
                                data: [
                                    {id: 1, name: "Beklemede"},
                                    {id: 2, name: "Cevaplandı"},

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
            wordWrapEnabled: true,
            filterRow: {
                visible: true,
                applyFilter: 'auto',
            },

        });


    $('#gridContainerSendMail').dxDataGrid(
        {
            keyExpr: "Id",
            dataSource: '/rudder/contact-response-list',
            columns: [

                {
                    dataField: "subject",
                    caption: "Konu",
                    minwidth: 100
                },
                {
                    dataField: "body",
                    caption: "İçerik",
                    minwidth: 200
                },



            ],

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
            wordWrapEnabled: true,
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


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'contact/' + formId,
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


            var result;
            $.ajax({
                type: "GET",
                url: 'contact' + '/' + formId + '/edit',
                datatype: "json",
                async: false,
                success: function (data) {
                    result = data;
                }
            });

            $('#modelHeading').html("Contact Düzenle");
            let formJson = await contactInsertUpdateForm(result);
            $("#frmEditContact").dxForm(formJson);
            let formJsonMail = await mailSendForm(result);
            $("#frmSendMail").dxForm(formJsonMail);




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
        $("#btnSendMail").unbind();
        $("#btnSendMail").on("click", function () {
            var frm = $("#frmSendMail").dxForm("instance");
            var validate = frm.validate();
            if (validate.isValid) {

                var json = frm.option("formData");

                console.log(json);
                sendMail(json);
            }
        });

    }
    const contactInsertUpdateForm = async (data = {}) => {

        // console.log("data", data);
        return {
            labelLocation: 'top',
            colCount: 2,
            formData: data,
            items: [{
                itemType: "group",
                caption: "Form Bilgileri",
                colSpan: 2,
            },
                {

                    dataField: "name",
                    label: {
                        text: 'Adı'

                    },
                    editorOptions: {
                        readOnly: true
                    },

                },

                {
                    dataField: "surname",
                    label: {
                        text: 'Soyadı'
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
                        text: 'Telefon'

                    },
                    editorOptions: {
                        readOnly: true
                    },
                },
                {
                    dataField: "message_content",
                    editorType: 'dxTextArea',
                    label: {
                        text: 'Mesaj'
                    },
                    editorOptions: {
                        height: 200,
                        readOnly: true
                    },
                },
                {
                    dataField: "send_date",
                    label: {
                        text: 'Gönderim Tarihi',
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        dataType: "date",
                        readOnly: true,
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },
                },
                {
                    dataField: "status",
                    editorType: 'dxSelectBox',
                    label: {
                        text: 'Durum'
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

    const mailSendForm = async (data = {}) => {

        // console.log("data", data);
        return {
            labelLocation: 'top',
            colCount: 2,
            formData: data,
            items: [{
                itemType: "group",
                caption: "Mail",
                colSpan: 2,
            },
                {

                    dataField: "subject",
                    label: {
                        text: 'Konu'

                    },


                },

                {
                    dataField: "body",
                    editorType: 'dxTextArea',
                    label: {
                        text: 'Mesaj'
                    },
                    editorOptions: {
                        height: 200,
                    },
                },

            ]
        }
    };

    const saveContact = async (json) => {

        $.ajax({
            data: json,
            url: "contact",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                msg('Düzenlenme Başarılı', "success");
                //console.log("result"+JSON.stringify(data));
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateContact').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }
    const sendMail = async (json) => {

        $.ajax({
            data: json,
            url: "/sendMail",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                msg(data.message, data.type);
                //console.log("result"+JSON.stringify(data));
                //$("#gridContainer").dxDataGrid("instance").refresh();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }

});
