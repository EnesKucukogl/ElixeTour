$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'treatment-list',
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
                        name: "active",
                        hint: "Aktif",
                        icon: "fa fa-arrow-rotate-left",
                        onClick: function (e) {
                            var result = DevExpress.ui.dialog.confirm("<i>Bu kayıdı güncellemek istediğinize emin misiniz?</i>", "Aktif/Pasif");
                            result.done(function (dialogResult) {
                                if (dialogResult) {

                                    if (e.row.key.active == 0) {
                                        active = 1;
                                    } else if (e.row.key.active == 1) {
                                        active = 0;
                                    }

                                    changeStatus(e.row.key.Id, active);
                                }
                            });
                        }
                    }

                ]
            },
            {
                dataField: "Id",
                caption: "ID"
            },

            {
                dataField: "treatment_text_content",
                caption: "Tedavi Adı",
                calculateCellValue: function (data) {
                    var text = "";
                    data.treatment_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },

            {
                dataField: "description_text_content",
                caption: "Tedavi Açıklama",
                calculateCellValue: function (data) {
                    var text = "";
                    data.description_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "active",
                caption: "Aktif",
                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                {id: 0, name: "Hayır"},
                                {id: 1, name: "Evet"},
                            ],
                            key: "id"
                        }
                    },
                    valueExpr: "id", // contains the same values as the "statusId" field provides
                    displayExpr: "name" // provides display values
                }
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

    $('#addTreatment').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'treatment/' + formId,
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                console.log(data.message);
                msg(data.message,'success');
                $("#gridContainer").dxDataGrid("instance").refresh();

            },
            error: function (data) {
                console.log('Error:', data);

            }
        });
    }

    const getFormById = async (formId) => {

        if (formId == "-1") {
            $("#modelHeading").html("Tedavi Ekle");
            var languages;
            $.ajax({
                type: "GET",
                url: 'get-language-detail',
                datatype: "json",
                async: false,
                success: function (data) {
                    languages = data;
                }
            });

            $(".language").empty();
            $.each(languages, function (index, value) {
                $(".language").append("<div class='col-md-6 mt-3' id='frmLanguageMenu" + value.symbol + "'></div>");
                getLanguageFormById(null,null, value.symbol)
            });

            let formJson = await treatmentInsertUpdateForm(null);
            $("#frmEditTreatment").dxForm(formJson);

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'treatment' + '/' + formId + '/edit',
                datatype: "json",
                async: false,
                success: function (data) {
                    result = data;
                }
            });
            var languages;
            $.ajax({
                type: "GET",
                url: 'get-language-detail',
                datatype: "json",
                async: false,
                success: function (data) {
                    languages = data;
                }
            });
            $(".language").empty();
            $.each(languages, function (index, value) {
                $(".language").append("<div class='col-md-6 mt-3'  id='frmLanguageMenu" + value.symbol + "'></div>");
                getLanguageFormById(result.treatment_name_content_id,result.description_content_id, value.symbol)
            });

            $('#modelHeading').html("Tedavi Düzenle");
            let formJson = await treatmentInsertUpdateForm(result);
            $("#frmEditTreatment").dxForm(formJson);

        }

        $('#updateTreatment').modal('show');
        $("#btnSaveTreatment").unbind();
        $("#btnSaveTreatment").on("click", function () {
            var frm = $("#frmEditTreatment").dxForm("instance");

            var validate = frm.validate();
            if (validate.isValid) {

                const frmLang = [];

                var json = frm.option("formData");
                console.log(json);
                $.each(languages, function (index, value) {
                    var frmData = $("#frmLanguageMenu" + value.symbol).dxForm("instance").option("formData");
                    if (!frmData.text_content_id_treatment)
                    {
                        frmData["text_content_id_treatment"] = json.treatment_name_content_id;
                    }
                    frmLang.push(frmData);
                });
                json['frmLang'] = frmLang;
                console.log(json);
                saveTreatment(json);
            }
        });
    }

    const treatmentInsertUpdateForm = async (data = {}) => {

        //console.log("data", data);

        let active = [{ Id: 0, status: "Pasif" }, { Id: 1, status: "Aktif" }];
        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "active",
                    label: {
                        text: 'Aktif'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: active,
                        displayExpr: "status",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Aktiflik boş geçilemez !"
                    }]

                },
            ]
        }
    };


    const getLanguageFormById = async (treatmentTextContentId,descriptionTextContentId, symbol) => {

        if (descriptionTextContentId == null) {
            var resultDesc;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultDesc = data;
                }
            });

        }else{

            var resultDesc;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: descriptionTextContentId, symbol: symbol,name:'description'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultDesc = data;
                }
            });
        }
        if (treatmentTextContentId == null) {
            var resultTreatment;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol,name:'treatment'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultTreatment = data;
                }
            });

        } else {
            var resultTreatment;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: treatmentTextContentId, symbol: symbol,name:'treatment'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultTreatment = data;
                }
            });

        }

        var combined = $.extend({}, resultTreatment, resultDesc);

        let formJson = await languageInsertUpdateForm(combined);
        $("#frmLanguageMenu" + symbol).dxForm(formJson);

    }

    const languageInsertUpdateForm = async (data = {}) => {

        console.log("data", data);

        return {
            colCount: 1,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "translation_treatment",
                    label: {
                        text: 'Tedavi Adı (' + data.symbol + ')'
                    },

                },
                {
                    dataField: "translation_description",
                    label: {
                        text: 'Tedavi Açıklama (' + data.symbol+ ')'
                    },
                    editorType: "dxTextArea",
                    editorOptions: {
                        height: 100
                    }
                },
            ]
        }
    };

    const saveTreatment = async (json) => {

        $.ajax({
            data: json,
            url: "treatment",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message,data.type);
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateTreatment').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }


});
