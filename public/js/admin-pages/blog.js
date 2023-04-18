const Active = [
    {"id": 0, "Name": "Pasif"},
    {"id": 1, "Name": "Aktif"}];

const Visible = [
    {"id": 0, "Name": "Hayır"},
    {"id": 1, "Name": "Evet"}];

$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'blog-list',
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
                dataField: "title_text_content",
                caption: "Metin Başlığı",
                calculateCellValue: function (data) {
                    var text = "";
                    // console.log(data);
                    data.title_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                },
            },
            {
                dataField: "slug",
                caption: "Url",
                minWidth:70,
            },
            {
                dataField: "active",
                caption: "Aktif",
                minWidth:150,
                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                {id: 0, name: "Pasif"},
                                {id: 1, name: "Aktif"},
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
                minWidth:150,
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

    $('#addBlog').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'blog/' + formId,
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                console.log(data.message);
                msg(data.message, 'success');
                $("#gridContainer").dxDataGrid("instance").refresh();

            },
            error: function (data) {
                console.log('Error:', data);

            }
        });
    }

    const getFormById = async (formId) => {

        if (formId == "-1") {
            $("#modelHeading").html("Blog Ekle");
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
                $(".language").append("<div class='col-md-6 mt-3' id='frmLanguageBlog" + value.symbol + "'></div>");
                getLanguageFormById(null, null, null,value.symbol)
            });

            let formJson = await blogInsertUpdateForm(null);
            let formJsonResim = await resimInsertUpdateForm(null);
            $("#frmEditBlog").dxForm(formJson);
            $("#frmResimBlog").dxForm(formJsonResim);

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'blog' + '/' + formId + '/edit',
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
            // console.log(languages);
            $(".language").empty();
            $.each(languages, function (index, value) {
                $(".language").append("<div class='col-md-6 mt-3'  id='frmLanguageBlog" + value.symbol + "'> </div>");
                getLanguageFormById(result.title_content_id ,result.short_description_content_id ,result.description_content_id , value.symbol)
            });

            $('#modelHeading').html("Blog Düzenle");
            let formJson = await blogInsertUpdateForm(result);
            let formJsonResim = await resimInsertUpdateForm(result);
            $("#frmEditBlog").dxForm(formJson);
            $("#frmResimBlog").dxForm(formJsonResim);

        }

        $('#updateBlog').modal('show');
        $("#btnSaveBlog").unbind();
        $("#btnSaveBlog").on("click", function () {
            var frm = $("#frmEditBlog").dxForm("instance");

            var validate = frm.validate();
            if (validate.isValid) {

                const frmLang = [];

                var json = frm.option("formData");
                $.each(languages, function (index, value) {
                        var frmData = $("#frmLanguageBlog" + value.symbol).dxForm("instance").option("formData");
                        if (!frmData.text_content_id_title) {
                            frmData["text_content_id_title"] = json.title_content_id;
                        }
                        console.log('frmData',frmData)
                        frmLang.push(frmData);
                    }
                );
                json['frmLang'] = frmLang;
                // console.log(json);
                saveBlog(json);
            }
        });
    }

    const blogInsertUpdateForm = async (data = {}) => {

        // let active = [{id: 0, status: "Pasif"}, {id: 1, status: "Aktif"}];
        return {


            colCount: 1,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    itemType: "group",
                    caption: "Genel",
                    colSpan: 2,
                },
                {
                    dataField: "active",
                    label: {
                        text: 'Aktif'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items:Active,
                        displayExpr: "Name",
                        valueExpr: "id",
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
                        items: Visible,
                        displayExpr: "Name",
                        valueExpr: "id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Bu alan boş geçilemez !"
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
                data: {id: data.Id, file_type_id: 4},
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
                            var formElement = $('#frmEditBlog').dxForm("instance");

                            var dataa = formElement.option("formData");
                            var formElementResim = $('#frmResimBlog').dxForm("instance");
                            var dataaResim = formElementResim.option("formData");

                            if (!dataa.Id) {
                                msg("Önce bloğu kaydediniz,sonra dosya yükleyiniz!", "error");
                            } else {
                                var checkFiles = formElementResim.getEditor("Dosya");

                                if (checkFiles._files.length > 0) {
                                    var coverFileCheck;
                                    $.ajax({
                                        type: "POST",
                                        url: 'check-cover-file',
                                        data: {id: data.Id, file_type_id: 4},
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
        let grid = $("#frmResimBlog").dxForm("instance").getEditor("documents");
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

        var form = $("#frmResimBlog").dxForm("instance");
        var validate = form.validate();
        if (validate.isValid) {
            var uploader = form.getEditor("Dosya");
            uploader._uploadFiles();
        }
    }

    const saveUploadFile = async (file) => {

        //debugger;
        var form = $("#frmResimBlog").dxForm("instance");
        var json = form.option("formData");


        //console.log("tmpp"+json.Dosya[0].guid.tmp);
        //var jsonParse = JSON.parse();

        let postData = {
            file_type_id: 4,
            tmp_name: json.Dosya[0].guid.tmp,
            name: json.Dosya[0].guid.name,
            general_id: json.Id,
            cover_image: json.cover_image,
        };

        form.getEditor("Dosya").reset();
        console.log(postData);

        $.ajax({
            data: JSON.stringify(postData),
            url: "blog-file-upload",
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


    const getLanguageFormById = async (titleTextContentId, shortDescriptionTextContent ,descriptionTextContentId, symbol) => {

        if (titleTextContentId == null) {
            var resultTitle;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {id: titleTextContentId, symbol: symbol, name: 'title'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultTitle = data;
                }
            });

        } else {

            var resultTitle;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: titleTextContentId, symbol: symbol, name: 'title'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultTitle = data;
                }
            });
        }

        if (shortDescriptionTextContent == null) {
            var resultShortDesc;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {id: shortDescriptionTextContent, symbol: symbol, name:'short_description' },
                datatype: "json",
                async: false,
                success: function (data) {
                    resultShortDesc = data;
                }
            });

        } else {

            var resultShortDesc;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: shortDescriptionTextContent, symbol: symbol, name: 'short_description'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultShortDesc = data;
                }
            });
        }

        if (descriptionTextContentId == null) {
            var resultDesc;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {id: descriptionTextContentId, symbol: symbol, name: 'description'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultDesc = data;
                }
            });

        } else {
            var resultDesc;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: descriptionTextContentId, symbol: symbol, name: 'description'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultDesc = data;
                }
            });

        }

        var combined = $.extend({}, resultTitle, resultShortDesc,resultDesc);

        let formJson = await languageInsertUpdateForm(combined);
        $("#frmLanguageBlog" + symbol).dxForm(formJson);

    }

    const languageInsertUpdateForm = async (data = {}) => {

        // console.log("data", data);

        return {
            colCount: 1,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    itemType: "group",
                    caption: 'Çeviri (' + data.symbol.toUpperCase() + ')',
                    colSpan: 2,
                },
                {
                    dataField: "translation_title",
                    label: {
                        text: 'Metin Başlığı (' + data.symbol + ')'
                    },
                    editorType: "dxTextArea",
                    validationRules: [{
                        type: "required",
                        message: "Başlık boş geçilemez !"
                    }]
                },
                {
                    dataField: "translation_short_description",
                    label: {
                        text: 'Kısa Metin (' + data.symbol + ')'
                    },
                    editorType: "dxTextArea",
                    validationRules: [{
                        type: "required",
                        message: "Başlık boş geçilemez !"
                    }]
                },
                {
                    dataField: "translation_description",
                    label: {
                        text: 'Asıl Metin (' + data.symbol + ')'
                    },
                    editorType: "dxHtmlEditor",

                    editorOptions: {

                        height: 500,
                        toolbar: {

                            items: [

                                'undo', 'redo',
                                {
                                    name: 'size',
                                    acceptedValues: ['8pt', '10pt', '12pt', '14pt', '18pt', '24pt', '36pt'],
                                },'separator',
                                {
                                    widget: "dxButton",
                                    options: {
                                        icon: "image",
                                        onClick: function() {
                                            uploadPopup.show();
                                        }
                                    }
                                },'separator',
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
                                },


                            ],
                        },
                        mediaResizing: {
                            enabled: true,
                        },
                        onMediaUploaded: {

                        }
                    },
                    validationRules: [{
                        type: "required",
                        message: "Asıl metin boş geçilemez !"
                    }]
                },

            ]
        }
    };

    const saveBlog = async (json) => {

        $.ajax({
            data: json,
            url: "blog",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message, data.type);
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateBlog').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });
    }

    var uploadPopup = $("#popupContainer")
        .dxPopup({
            width: '20%',
            height: '30%',
            contentTemplate: function(contentElement) {
                console.log('content element',contentElement)
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


                $("<div>")
                    .appendTo(contentElement)
                    .dxFileUploader({
                            uploadMode: "useButtons",
                            uploadUrl: "/rudder/image-upload",
                            name:"File",
                            uploadHeaders: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            allowedFileExtensions: [".jpg", ".jpeg", ".gif", ".png"],
                            onUploaded: function(e) {

                $.each(languages, function (index, value) {
                        let editor = $("#frmLanguageBlog"+value.symbol).dxForm("instance").getEditor("translation_description");

                                var range = editor.getSelection();
                                var index = range && range.index || 0;
                                editor.insertEmbed(index, "extendedImage", {
                                    src: ('/img/admin-file-upload/' + JSON.parse(e.request.response).fileName)
                                });
                                uploadPopup.hide();
                                editor.focus();

                        });
                    }}
                );
            }
        }).dxPopup("instance");


});
