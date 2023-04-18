$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'menu-post',
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
                        name: "visible",
                        hint: "Görünürlük",
                        icon: "fa fa-arrow-rotate-left",
                        onClick: function (e) {
                            var result = DevExpress.ui.dialog.confirm("<i>Bu kayıdın görünürlüğünü değiştirmek istediğinize emin misiniz?</i>", "Görünürlük");
                            result.done(function (dialogResult) {
                                if (dialogResult) {

                                    if (e.row.key.visible == 0) {
                                        visible = 1;
                                    } else if (e.row.key.visible == 1) {
                                        visible = 0;
                                    }

                                    changeStatus(e.row.key.Id, visible);
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
                dataField: "url",
                caption: "URL"
            },
            {
                dataField: "text_content",
                caption: "Menü Adı",
                calculateCellValue: function (data) {
                    var text = "";
                    data.text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "upper_menu_text_content",
                caption: "Üst Menü Adı",
                calculateCellValue: function (data) {
                    var text = "";
                    data.upper_menu_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "sort_order",
                caption: "Sıra",
                dataType: "number"
            },
            {
                dataField: "visible",
                caption: "Görünür",
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
                dataField: "name_surname",
                caption: "Kayıt Kullanıcı",

            },
            {
                dataField: "created_date",
                caption: "Kayıt Tarihi",
                dataType: "date",
                displayFormat: "dd.MM.yyyy",
                dateSerializationFormat: "yyyy-MM-dd",
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

    $('#addMenu').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, visible) => {

        $.ajax({
            data: {Id: formId, visible: visible},
            url: 'menu/' + formId,
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
            $("#modelHeading").html("Menü Ekle");
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
                getLanguageFormById(null, value.symbol)
            });

            let formJson = await menuInsertUpdateForm(null);
            $("#frmEditMenu").dxForm(formJson);

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'menu' + '/' + formId + '/edit',
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
                getLanguageFormById(result.menu_name_content_id, value.symbol)
            });

            $('#modelHeading').html("Menü Düzenle");
            let formJson = await menuInsertUpdateForm(result);
            $("#frmEditMenu").dxForm(formJson);

        }

        $('#updateMenu').modal('show');
        $("#btnSaveMenu").unbind();
        $("#btnSaveMenu").on("click", function () {
            var frm = $("#frmEditMenu").dxForm("instance");

            var validate = frm.validate();
            if (validate.isValid) {

                const frmLang = [];

                var json = frm.option("formData");
                $.each(languages, function (index, value) {
                    frmLang.push($("#frmLanguageMenu" + value.symbol).dxForm("instance").option("formData"));
                });
                json['frmLang'] = frmLang;
                console.log("json" + JSON.stringify(json));
                saveMenu(json);
            }
        });
    }

    const menuInsertUpdateForm = async (data = {}) => {

        //console.log("data", data);
        var upper_menu;
        $.ajax({
            type: "GET",
            url: 'upper-menu-list',
            datatype: "json",
            async: false,
            success: function (data) {
                upper_menu = data;

            }
        });

        var contentArr = upper_menu.map(item => item.text_content[0]);

        //console.log("uppper_menu"+JSON.stringify(contentArr));

        let visible = [{ Id: 0, status: "Pasif" }, { Id: 1, status: "Aktif" }];
        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "url",
                    label: {
                        text: 'Url'
                    },
                    validationRules: [{
                        type: "required",
                        message: "Url boş geçilemez !"
                    }]
                },
                {
                    dataField: "upper_menu_content_id",
                    label: {
                        text: 'Üst Menü'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: contentArr,
                        displayExpr: "default_lang",
                        valueExpr: "text_content_id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },

                },
                {
                    dataField: "sort_order",
                    label: {
                        text: 'Sıra'
                    },
                    editorType: "dxNumberBox",
                    editorOptions: {
                        min: 1,
                        max: 50

                    },
                    validationRules: [{
                        type: "required",
                        message: "Sıra numarası boş geçilemez !"
                    }]
                },
                {
                    dataField: "visible",
                    label: {
                        text: 'Görünürlük'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: visible,
                        displayExpr: "status",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Görünürlük boş geçilemez !"
                    }]

                },
            ]
        }
    };


    const getLanguageFormById = async (textContentId, symbol) => {
        console.log(textContentId);
        if (textContentId == null) {
            var result;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol},
                datatype: "json",
                async: false,
                success: function (data) {
                    result = data;
                }
            });

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: textContentId, symbol: symbol,name:'menu'},
                datatype: "json",
                async: false,
                success: function (data) {
                    result = data;
                }
            });
        }


        let formJson = await languageInsertUpdateForm(result);
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
                    itemType: "group",
                    caption: 'Çeviri (' + data.symbol.toUpperCase() + ')',
                    colSpan: 2,
                },
                {
                    dataField: "translation_menu",
                    label: {
                        text: 'Menü Adı (' + data.symbol.toUpperCase() + ')'
                    },

                },
            ]
        }
    };

    const saveMenu = async (json) => {

        $.ajax({
            data: json,
            url: "menu",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message,data.type);
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateMenu').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }


});
