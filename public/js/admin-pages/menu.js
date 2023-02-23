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
                        }
                    },
                    {
                        hint: "Sil",
                        icon: "fa fa-trash",
                        onClick: function (e) {
                            var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
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
                caption: "Id",
                minwidth: 100

            },
            {
                dataField: "url",
                caption: "Url",
                minwidth: 100
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
            $.each(languages, function (index, value) {
                $(".language").append("<div id='frmLanguageMenu" + value.symbol + "'></div>");
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

            $.each(languages, function (index, value) {

                $(".language").append("<div id='frmLanguageMenu" + value.symbol + "'></div>");
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

        return {
            colCount: 2,
            formData: data,
            items: [
                {
                    dataField: "url",
                    label: {
                        text: 'Url'
                    },


                },


            ]
        }
    };


    const getLanguageFormById = async (textContentId, symbol) => {
        console.log(textContentId);
        if(textContentId == null)
        {
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

        }
        else
        {
            var result;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: textContentId, symbol: symbol},
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
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                {
                    dataField: "translation",
                    label: {
                        text: 'Menü Adı (' + data.symbol + ')'
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
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateMenu').modal('toggle').fadeOut('slow');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    }


});
