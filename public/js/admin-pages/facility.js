$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'facility-list',
        columns: [
            {
                type: "buttons",
                width: 110,
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
                    },
                    {
                        name: " SelectHotel ",
                        hint: "Otel Seç",
                        icon: "fa-solid fa-hotel",
                        onClick: function (e) {
                            GetHotel(e.row.key.Id);
                        }
                    },

                ]
            },
            {
                dataField: "Id",
                caption: "Id",
            },
            {
                dataField: "text_content",
                caption: "Hizmet Adı",
                calculateCellValue: function (data) {
                    var text = "";
                    // console.log(data);
                    data.text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                },
            },
            {
                dataField: "description_text_content",
                caption: "Hizmet Açıklaması",
                calculateCellValue: function (data) {
                    var text = "";
                    data.description_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();

                },
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

    $('#addFacility').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'facility/' + formId,
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
            $("#modelHeading").html("Otel Hizmeti Ekle");
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
                $(".language").append("<div class='col-md-6 mt-3' id='frmLanguageFacility" + value.symbol + "'></div>");
                getLanguageFormById(null, null, value.symbol)
            });

            let formJson = await facilityInsertUpdateForm(null);
            $("#frmEditFacility").dxForm(formJson);

        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'facility' + '/' + formId + '/edit',
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
                $(".language").append("<div class='col-md-6 mt-3'  id='frmLanguageFacility" + value.symbol + "'> </div>");
                getLanguageFormById(result.facility_name_content_id, result.description_content_id, value.symbol)
            });

            $('#modelHeading').html("Otel Hizmeti Düzenle");
            let formJson = await facilityInsertUpdateForm(result);
            $("#frmEditFacility").dxForm(formJson);

        }

        $('#updateFacility').modal('show');
        $("#btnSaveFacility").unbind();
        $("#btnSaveFacility").on("click", function () {
            var frm = $("#frmEditFacility").dxForm("instance");

            var validate = frm.validate();
            if (validate.isValid) {

                const frmLang = [];

                var json = frm.option("formData");
                $.each(languages, function (index, value) {
                        var frmData = $("#frmLanguageFacility" + value.symbol).dxForm("instance").option("formData");
                        if (!frmData.text_content_id_facility) {
                            frmData["text_content_id_facility"] = json.facility_name_content_id;
                        }
                        frmLang.push(frmData);
                    }
                );
                json['frmLang'] = frmLang;

                console.log(json);
                saveFacility(json);
            }
        });
    }

    const GetHotel = async (facilityId) => {

        $('#myModalLabel').html("Otel Seç");
        $('#myModal').modal('show');
        let formJson = await HotelSelectForm(facilityId);
        $("#frmEditHotel").dxForm(formJson);



        $("#btnSaveHotel").unbind();
        $("#btnSaveHotel").on("click", function () {
            var formSelectedRows = $('#frmEditHotel').dxForm("instance").getEditor('hotel').getSelectedRowKeys();


            var combined = $.extend({}, {SelectedRows: formSelectedRows}, {facilityId: facilityId});


            console.log("keys" + JSON.stringify(combined));
            console.log("facId" + facilityId);
            saveHotel(combined);


        });
    }

    const HotelSelectForm = async (facilityId) => {
        var hotelListActive;
        $.ajax({
            type: "GET",
            url: 'hotel-list-active',
            datatype: "json",
            async: false,
            success: function (data) {
                hotelListActive = data;
            }
        });
    return {

        items: [{
            itemType: "group",

            items: [{
                editorType: "dxDataGrid",
                name: "hotel",

                editorOptions: {

                    dataSource: hotelListActive,
                    filterRow: {visible: true},
                    showBorders: true,
                    columnAutoWidth: true,
                    allowColumnReordering: true,
                    wordWrapEnabled: true,
                    selection: {
                        mode: 'multiple',
                    },
                    keyExpr: "Id",
                    onContentReady: function (e) {

                        var hotelFacility;
                        $.ajax({
                            type: "GET",
                            url: 'hotel-facility',
                            datatype: "json",
                            async: false,
                            data: {facilityId: facilityId},
                            success: function (data) {
                                hotelFacility = data;
                            }
                        });
                        const hotelIds = hotelFacility.map(obj => obj.hotel_id);

                        $('#frmEditHotel').dxForm("instance").getEditor("hotel").selectRows(hotelIds);
                    },
                        columns: [
                            {
                                dataField: "Id",
                                caption: "No",
                                visible: 'false'
                            },
                            {
                                dataField: "name",
                                caption: "Otel Adı",
                                minwidth: 100
                            },
                            {
                                dataField: "address",
                                caption: "Adresi",
                                minwidth: 100
                            },
                        ],

                }
            }]
        }]
    }

}


    const facilityInsertUpdateForm = async (data = {}) => {

        let active = [{Id: 0, status: "Pasif"}, {Id: 1, status: "Aktif"}];
        return {
            colCount: 2,
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


    const getLanguageFormById = async (facilityNameTextContentId, descriptionTextContentId, symbol) => {

        if (descriptionTextContentId == null) {
            var resultDesc;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol,},
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
        if (facilityNameTextContentId == null) {
            var resultPack;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {symbol: symbol, name: 'facility'},
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
                data: {id: facilityNameTextContentId, symbol: symbol, name: 'facility'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultPack = data;
                }
            });

        }

        var combined = $.extend({}, resultPack, resultDesc);

        let formJson = await languageInsertUpdateForm(combined);
        $("#frmLanguageFacility" + symbol).dxForm(formJson);

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
                    dataField: "translation_facility",
                    label: {
                        text: 'Hizmet Adı (' + data.symbol + ')'
                    },

                },
                {
                    dataField: "translation_description",
                    label: {
                        text: 'Hizmet Açıklaması (' + data.symbol + ')'
                    },
                    editorType: "dxTextArea",
                    editorOptions: {
                        height: 100
                    }
                },
            ]
        }
    };

    const saveFacility = async (json) => {

        $.ajax({
            data: json,
            url: "facility",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message, data.type);
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateFacility').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }

    const saveHotel = async (json) => {
          //console.log(JSON.stringify(json));
        $.ajax({
            data: JSON.stringify(json),
            url: "get-hotel-facility",
            type: "POST",
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message, data.type);
                $('#myModal').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }


});
