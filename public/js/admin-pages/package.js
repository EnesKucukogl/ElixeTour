$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'package-list',
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
                dataField: "package_text_content",
                caption: "Paket Adı",
                calculateCellValue: function (data) {
                    var text = "";
                    data.package_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "cost",
                caption: "Maliyet Fiyat",
                dataType: "number"
            },
            {
                dataField: "cost_currency_symbol",
                caption: "Maliyet Para Birimi",
            },
            {
                dataField: "price",
                caption: "Satış Fiyat",
                dataType: "number"
            },
            {
                dataField: "price_currency_symbol",
                caption: "Satış Para Birimi",
            },
            {
                dataField: "duration",
                caption: "Süre",
            },

            {
                dataField: "package_start_date",
                caption: "Paket Başlangıç Tarihi",
                dataType: "date",
                displayFormat: "dd.MM.yyyy",
                dateSerializationFormat: "yyyy-MM-dd",
            },
            {
                dataField: "package_expiry_date",
                caption: "Paket Bitiş Tarihi",
                dataType: "date",
                displayFormat: "dd.MM.yyyy",
                dateSerializationFormat: "yyyy-MM-dd",
            },
            {
                dataField: "description_text_content",
                caption: "Paket Açıklama",
                calculateCellValue: function (data) {
                    var text = "";
                    data.description_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "hotel_name",
                caption: "Hotel Adı",
            },
            {
                dataField: "hotel_address",
                caption: "Hotel Adress",
            },
            {
                dataField: "city_name",
                caption: "Şehir Adı",
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
         /*   {
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
                dataField: "name_surname",
                caption: "Kayıt Kullanıcı",

            },
            {
                dataField: "created_date",
                caption: "Kayıt Tarihi",
                dataType: "date",
                displayFormat: "dd.MM.yyyy",
                dateSerializationFormat: "yyyy-MM-dd",
            },*/


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

    $('#addMenu').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'package/' + formId,
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
            $("#modelHeading").html("Paket Ekle");
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

            let formJson = await menuInsertUpdateForm(null);
            $("#frmEditMenu").dxForm(formJson);

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'package' + '/' + formId + '/edit',
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
                getLanguageFormById(result.package_name_content_id,result.description_content_id, value.symbol)
            });

            $('#modelHeading').html("Paket Düzenle");
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
        var hotel;
        $.ajax({
            type: "GET",
            url: 'hotel-list-active',
            datatype: "json",
            async: false,
            success: function (data) {
                hotel = data;

            }
        });
        var currency;
        $.ajax({
            type: "GET",
            url: 'currency-list-active',
            datatype: "json",
            async: false,
            success: function (data) {
                currency = data;

            }
        });

        //console.log("hotel"+JSON.stringify(hotel));


        let active = [{ Id: 0, status: "Pasif" }, { Id: 1, status: "Aktif" }];
        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "cost",
                    label: {
                        text: 'Maliyet Fiyat'
                    },
                    validationRules: [{
                        type: "required",
                        message: "Maliyet Fiyatı boş geçilemez !"
                    }]
                },
                {
                    dataField: "cost_currency_id",
                    label: {
                        text: 'Maliyet Para Birimi'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: currency,
                        displayExpr: "symbol",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Maliyet Para Birimi boş geçilemez"
                    }]

                },
                {
                    dataField: "price",
                    label: {
                        text: 'Satış Fiyat'
                    },
                    validationRules: [{
                        type: "required",
                        message: "Satış Fiyatı boş geçilemez !"
                    }]
                },
                {
                    dataField: "price_currency_id",
                    label: {
                        text: 'Satış Para Birimi'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: currency,
                        displayExpr: "symbol",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Satış Para Birimi boş geçilemez"
                    }]

                },
                {
                    dataField: "hotel_id",
                    label: {
                        text: 'Hotel'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: hotel,
                        displayExpr: "name",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Hotel boş geçilemez"
                    }]

                },

                {
                    dataField: "duration",
                    label: {
                        text: 'Süre (Gün)'
                    },
                    editorType: "dxNumberBox",
                    editorOptions: {
                        min: 1,
                        max: 300

                    },
                    validationRules: [{
                        type: "required",
                        message: "Gün boş geçilemez !"
                    }]
                },

                {
                    dataField: "discount_rate",
                    label: {
                        text: 'İndirim oranı'
                    },
                    editorType: "dxNumberBox",
                    editorOptions: {
                        min: 0,
                        max: 100

                    },
                    validationRules: [{
                        type: "required",
                        message: "İndirim oranı boş geçilemez !"
                    }]
                },
                {
                    dataField: "package_start_date",
                    colSpan: 1,
                    label: {
                        text: "Paket Başlangıç Tarihi"
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        showClearButton: true,
                        dataType: "date",
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Başlangıç tarihi boş geçilemez"
                    }]
                },
                {
                    dataField: "package_expiry_date",
                    colSpan: 1,
                    label: {
                        text: "Paket Bitiş Tarihi"
                    },
                    editorType: "dxDateBox",
                    editorOptions: {
                        showClearButton: true,
                        dataType: "date",
                        displayFormat: "dd.MM.yyyy",
                        dateSerializationFormat: "yyyy-MM-dd",
                    },
                    validationRules: [{
                        type: "required",
                        message: "Bitiş tarihi boş geçilemez"
                    }]
                },
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


    const getLanguageFormById = async (packageTextContentId,descriptionTextContentId, symbol) => {

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
        if (packageTextContentId == null) {
            var resultPack;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol,name:'package'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultPack = data;
                }
            });

        } else {
            var resultPack;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: packageTextContentId, symbol: symbol,name:'package'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultPack = data;
                }
            });

        }

        var combined = $.extend({}, resultPack, resultDesc);

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
                    dataField: "translation_package",
                    label: {
                        text: 'Paket Adı (' + data.symbol + ')'
                    },

                },
                {
                    dataField: "translation_description",
                    label: {
                        text: 'Paket Açıklama (' + data.symbol+ ')'
                    },
                    editorType: "dxTextArea",
                    editorOptions: {
                        height: 100
                    }
                },
            ]
        }
    };

    const saveMenu = async (json) => {

        $.ajax({
            data: json,
            url: "package",
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
