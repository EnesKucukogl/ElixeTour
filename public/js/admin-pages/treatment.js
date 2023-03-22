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
                dataField: "slug",
                caption: "Slug"
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

            {
                dataField: "highlighted",
                caption: "Anasayfada Göster",
                minWidth:50,
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
            let formJsonResim = await resimInsertUpdateForm(null);
            $("#frmEditTreatment").dxForm(formJson);
            $("#frmResimMenu").dxForm(formJsonResim);

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
            let formJsonResim = await resimInsertUpdateForm(result);
            $("#frmEditTreatment").dxForm(formJson);
            $("#frmResimMenu").dxForm(formJsonResim);

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
        let highlighted = [{Id: 0, status: "Hayır"}, {Id: 1, status: "Evet"}];
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
                {
                    dataField: "highlighted",
                    label: {
                        text: 'Anasayfada göster'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: highlighted,
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

    const resimInsertUpdateForm = async (data = {}) => {
        console.log("ddsdsds" + data);
        if(data !== null){
            var file;
            $.ajax({
                type: "POST",
                url: 'get-file-list',
                data: {id: data.Id, file_type_id: 2},
                datatype: "json",
                async: false,
                success: function (data) {
                    file = data;

                }
            });
        }
        let cover_image = [{Id: 0, status: "Hayır"}, {Id: 1, status: "Evet"}];
        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "cover_image",
                    label: {
                        text: 'Ana Resim'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: cover_image,
                        displayExpr: "status",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Ana Resim boş geçilemez !"
                    }]

                },
                {
                    dataField: "Dosya",
                    colSpan: 2,
                    editorType: "dxFileUploader",
                    //visible: data.Id == undefined || data.Id < 0,
                    label: {
                        text: "Dosya"
                    },
                    editorOptions: {
                        uploadHeaders: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },
                        multiple: false,
                        //accept: "*",
                        allowedFileExtensions: [".jpg", ".png", ".jpeg",".webp"],
                        value: [],
                        uploadMode: "useButtons",
                        uploadUrl: 'file-upload',
                        activeStateEnabled: true,
                        onValueChanged: function (e) {
                            var values = e.component.option("values");
                            $.each(values, function (index, value) {
                                e.element.find(".dx-fileuploader-upload-button").hide();
                            });
                            e.element.find(".dx-fileuploader-upload-button").hide();
                        },
                        onUploaded: function (e) {

                            e.file["guid"] = e.request.responseText;

                            const obj = JSON.parse(e.file["guid"]);

                            e.file['guid'] = obj;
                            saveUploadFile();
                        }
                    },

                },
                {
                    itemType: "button",
                    colSpan: 2,
                    horizontalAlignment: "right",
                    cssClass: "add-contact-button",
                    buttonOptions: {
                        icon: "add",
                        text: "Resim Ekle",
                        onClick: async function () {
                            //debugger;
                            var formElement = $('#frmEditTreatment').dxForm("instance");

                            var dataa = formElement.option("formData");
                            var formElementResim = $('#frmResimMenu').dxForm("instance");
                            var dataaResim = formElementResim.option("formData");

                            if (!dataa.Id) {
                                msg("Önce tedaviyi kaydediniz,sonra dosya yükleyiniz!", "error");
                            } else {
                                var checkFiles = formElementResim.getEditor("Dosya");

                                if (checkFiles._files.length > 0) {
                                    var coverFileCheck;
                                    $.ajax({
                                        type: "POST",
                                        url: 'check-cover-file',
                                        data: {id: data.Id, file_type_id: 2},
                                        datatype: "json",
                                        async: false,
                                        success: function (data) {
                                            coverFileCheck = data;

                                        }
                                    });

                                    console.log("dsdsds"+coverFileCheck);
                                    console.log("dsdsds"+dataaResim.cover_image);
                                    if(coverFileCheck !== '' && dataaResim.cover_image == 1 ){
                                        msg("Ana resim zaten mevcuttur", "error");
                                    }
                                    else
                                    {
                                        await saveImage();

                                    }
                                } else msg("Lütfen dosya yükleyiniz!", "error");
                            }
                        }
                    }
                },
                {
                    editorType: "dxDataGrid",
                    name: "documents",
                    colSpan: 2,
                    editorOptions: {
                        dataSource: file,
                        rowAlternationEnabled: true,
                        filterRow: {visible: true},
                        showBorders: true,
                        keyExpr: "Id",
                        columns: [
                            {
                                type: "buttons",
                                //width: 40,
                                buttons: [{
                                    hint: "Sil",
                                    icon: "fa fa-remove fa-lg text-danger",
                                    onClick: function (e) {
                                        var result = DevExpress.ui.dialog.confirm("<i>" + "Kayıdı silmek istediğinize emin misiniz?" + "</i>", "Kayıt silme işlemi");
                                        result.done(function (dialogResult) {
                                            if (dialogResult) {
                                                removeDokuman(e.row.key);
                                            }
                                        });
                                        e.event.preventDefault();
                                    }
                                }]
                            },
                            {
                                dataField: "name",
                                caption: "Adı",
                                wordWrapEnabled: true,
                                cellTemplate: function (container, options) {
                                    //console.log("options" + options.data.name);
                                    container.append($("<a>", {
                                        "href": "/"+options.data.file_path,
                                        "text": options.data.name,
                                        "target": "blank"
                                    }));
                                }
                            },
                            {
                                dataField: "cover_image",
                                caption: "Ana Resim",
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
                        columnAutoWidth: true
                    },
                },
            ]
        }
    };

    function refreshDokuman() {
        let grid = $("#frmResimMenu").dxForm("instance").getEditor("documents");
        grid.refresh();
    }

    const removeDokuman = async (id) => {
        $.ajax({
            data: {Id: id, active: 0},
            url: 'delete-file',
            type: "POST",
            dataType: 'json',
            success: function (data) {
                //console.log(data.message);
                msg(data.message, 'success');
                refreshDokuman();

            },
            error: function (data) {
                console.log('Error:', data);

            }
        });
    }




    const saveImage = async () => {

        var form = $("#frmResimMenu").dxForm("instance");
        var validate = form.validate();
        if (validate.isValid) {
            var uploader = form.getEditor("Dosya");
            uploader._uploadFiles();
        }
    }

    const saveUploadFile = async (file) => {

        //debugger;
        var form = $("#frmResimMenu").dxForm("instance");
        var json = form.option("formData");


        //console.log("tmpp"+json.Dosya[0].guid.tmp);
        //var jsonParse = JSON.parse();

        let postData = {
            file_type_id: 2,
            tmp_name: json.Dosya[0].guid.tmp,
            name: json.Dosya[0].guid.name,
            general_id: json.Id,
            cover_image: json.cover_image,
        };

        form.getEditor("Dosya").reset();
        console.log(postData);

        $.ajax({
            data: JSON.stringify(postData),
            url: "treatment-file-upload",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                //console.log("result"+JSON.stringify(data));
                msg(data.message, data.type);
                refreshDokuman();

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }

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
                        text: 'Tedavi Açıklaması (' + data.symbol + ')'
                    },
                    editorType: "dxHtmlEditor",
                    editorOptions: {
                        height: 300,
                        toolbar: {
                            items: [
                                'undo', 'redo', 'separator',
                                {
                                    name: 'size',
                                    acceptedValues: ['8pt', '10pt', '12pt', '14pt', '18pt', '24pt', '36pt'],
                                },
                                {
                                    name: 'font',
                                    acceptedValues: ['Arial', 'Courier New', 'Georgia', 'Impact', 'Lucida Console', 'Tahoma', 'Times New Roman', 'Verdana'],
                                },
                                'separator', 'bold', 'italic', 'strike', 'underline', 'separator',
                                'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'separator',
                                'orderedList', 'bulletList', 'separator',
                                {
                                    name: 'header',
                                    acceptedValues: [false, 1, 2, 3, 4, 5],
                                }
                            ],
                        },
                        mediaResizing: {
                            enabled: true,
                        }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Tedavi Açıklaması boş geçilemez !"
                    }]
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

