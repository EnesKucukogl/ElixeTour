$(document).ready(function () {

    $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: 'questions-list',
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
                caption: "ID",
                minWidth:30,
                sortIndex: 0,
                sortOrder: "asc"
            },

            {
                dataField: "question_text_content",
                caption: "Soru",
                minWidth:200,
                calculateCellValue: function (data) {
                    var text = "";
                    data.question_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            {
                dataField: "answer_text_content",
                caption: "Cevap",
                minWidth:250,
                calculateCellValue: function (data) {
                    var text = "";
                    data.answer_text_content.forEach(function (item) {
                        text += item.translation + " (" + item.symbol.toUpperCase() + ") ";
                    });
                    return text.trim();
                }
            },
            // {
            //     dataField: "slug",
            //     caption: "Url",
            //     minWidth:70,
            // },
            {
                dataField: "sort_order",
                caption: "Sıra",
                minWidth:70,
            },

            {
                dataField: "active",
                caption: "Aktif",
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

    $('#addMenu').on('click', function () {

        getFormById(-1);
    });


    const changeStatus = async (formId, active) => {

        $.ajax({
            data: {Id: formId, active: active},
            url: 'questions/' + formId,
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
            $("#modelHeading").html("Soru Ekle");
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
                getLanguageFormById(null, null, value.symbol)
            });

            let formJson = await menuInsertUpdateForm(null);
            $("#frmEditMenu").dxForm(formJson);


        } else {
            var result;
            $.ajax({
                type: "GET",
                url: 'questions' + '/' + formId + '/edit',
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
                getLanguageFormById(result.question_content_id, result.answer_content_id, value.symbol)
            });

            $('#modelHeading').html("Soru Düzenle");
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

                    if (value.symbol == 'en') {
                        let enFrmData = $("#frmLanguageMenu" + value.symbol).dxForm("instance").option("formData");
                        let flag = 0, message;

                        if (enFrmData.translation_question == undefined)
                        {
                            flag = 1;
                            message = "Lütfen İngilizce Soru Giriniz!";
                        }
                        else if (enFrmData.translation_question == '' || enFrmData.translation_question.trim() == '') {
                            flag = 1;
                            message = "Lütfen İngilizce Soru Giriniz!";
                        }
                        else if (enFrmData.translation_question.length <= 5) {
                            flag = 1;
                            message = "Soru için en az 5 karakter giriniz!";

                        }

                        if (flag == 1)
                        {
                            msg(message, "error");
                            // return;
                        }

                        if (enFrmData.translation_answer == undefined)
                        {
                            flag = 1;
                            message = "Lütfen İngilizce Cevap Giriniz!";
                        }
                        else if ( enFrmData.translation_answer == '' || enFrmData.translation_answer.trim() == '') {
                            flag = 1;
                            message = "Lütfen İngilizce Cevap Giriniz!";
                        } else if (enFrmData.translation_answer.length <= 5) {
                            flag = 1;
                            message = "Cevap için en az 5 karakter giriniz!";
                        }

                        if (flag == 1)
                        {
                            msg(message, "error");
                            // return;
                        }

                    }
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
        var package;
        $.ajax({
            type: "GET",
            url: 'package-list', //packages
            datatype: "json",
            async: false,
            success: function (data) {
                package = data;

            }
        });

        let packageList = package.map(x => ({Id: x.Id, translation: x.package_text_content.filter(y => y.symbol == 'en')[0].translation}));


        let active = [{Id: 0, status: "Pasif"}, {Id: 1, status: "Aktif"}];

        return {
            colCount: 2,
            labelLocation: 'top',
            formData: data,
            items: [
                  {
                    dataField: "package_id",
                    label: {
                        text: 'Paket'
                    },
                    editorType: "dxSelectBox",
                    editorOptions: {
                        items: packageList,
                        displayExpr: "translation",
                        valueExpr: "Id",
                        //value: data.BirimId ? 0 : data.BirimId,
                        showClearButton: true,
                        searchEnabled: true,
                    },
                    validationRules: [{
                        type: "required",
                        message: "Paket boş geçilemez"
                    }]

                },

                {
                    dataField: "sort_order",
                    label: {
                        text: 'Sıra'
                    },
                    validationRules: [{
                        type: "required",
                        message: "Sıra boş geçilemez"
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
                    }],


                },

            ]
        }
    };

    const getLanguageFormById = async (questionTextContentId, answerTextContentId, symbol) => {

        if (answerTextContentId == null) {
            var resultAnswer;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {id: answerTextContentId ,symbol: symbol, name:'answer'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultAnswer = data;
                }
            });

        } else {

            var resultAnswer;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: answerTextContentId, symbol: symbol, name: 'answer'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultAnswer = data;
                }
            });
        }
        if (questionTextContentId == null) {
            var resultQue;
            $.ajax({
                type: "GET",
                url: 'get-language-create',
                data: {id: questionTextContentId, symbol: symbol, name: 'question'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultQue = data;
                }
            });

        } else {
            var resultQue;
            $.ajax({
                type: "GET",
                url: 'get-language',
                data: {id: questionTextContentId, symbol: symbol, name: 'question'},
                datatype: "json",
                async: false,
                success: function (data) {
                    resultQue = data;
                }
            });

        }

        var combined = $.extend({}, resultQue, resultAnswer);

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
                    dataField: "translation_question",
                    label: {
                        text: 'Soru (' + data.symbol + ')',

                    },

                },
                {
                    dataField: "translation_answer",
                    label: {
                        text: 'Cevap (' + data.symbol + ')'
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
            data: JSON.stringify(json),
            url: "questions",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {

                //console.log("result"+JSON.stringify(data));
                msg(data.message, data.type);
                $("#gridContainer").dxDataGrid("instance").refresh();
                $('#updateMenu').modal('hide').fadeOut('slow');

            },
            error: function (data) {

                console.log('Error:', data);
            }
        });

    }


});

