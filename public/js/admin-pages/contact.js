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
                    width: 200
                },
                {
                    dataField: "send_date",
                    caption: "Gönderim Tarihi",
                    dataType: "date",
                    displayFormat: "dd.MM.yyyy",
                    dateSerializationFormat: "yyyy-MM-dd",
                    width: 100,
                    sortIndex: 0,
                    sortOrder: "desc"
                },
                {
                    dataField: "status",
                    caption: "Durum",
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

        // console.log("data", data);
        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
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
                        height : 200,
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

    const saveContact = async (json) => {

        $.ajax({
            data: json ,
            url: "contact",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                msg('Düzenlenme Başarılı',"success");
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
