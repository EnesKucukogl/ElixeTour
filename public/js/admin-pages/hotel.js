const dataGrids = {};
let ulkeData = [];
let sehirData = [];
let sehirler = [];
let ulkeId = 0;
let sehirId = 0;

$(document).ready(function () {
    getHotelListe();

    $('#addHotel').on('click', function () {
        getFormById(-1);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

const getUlke = async (ulkeId) => {

    if (!ulkeId) return null;

    let result;

    $.ajax({
        type: "GET",
        url: '/rudder/getCountry?id=' + ulkeId,
        datatype: "json",
        async: false,
        success: function (data) {
            result = data == null ? [] : data;
        }
    });

    if (result) {
        return result;
    } else {
        console.log("Ülke Bilgisi Bulunamadı.");
    }
}

const getSehir = async (id) => {

    if (!id) return null;

    let result;

    $.ajax({
        type: "GET",
        url: '/rudder/getCity?id=' + id,
        datatype: "json",
        async: false,
        success: function (data) {
            result = data == null ? [] : data;
        }
    });

    if (result) {
        return result;
    } else {
        console.log("Şehir Bilgisi Bulunamadı.");
    }
}

const getSehirler = async (ulkeId) => {

    if (!ulkeId) return null;
    // console.log(ulkeId);
    let result;
    $.ajax({
        type: "GET",
        url: 'getCityList?ulkeId=' + ulkeId,
        datatype: "json",
        async: false,
        success: function (data) {
            result = data;
        }
    });

    if (result) {
        return result;
    } else {
        console.log("Şehir Bilgisi Bulunamadı.");
    }
}

const getHotelListe = () => {

    dataGrids["hotels"] = $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/hotel-list',
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
                        }
                    },
                    {
                        hint: "Aktiflik",
                        icon: "fa fa-arrow-rotate-left",
                        onClick: function (e) {
                            var pasif = "Kaydı silmek istediğinizden emin misiniz?";
                            var aktif = "Kaydı aktif etmek istediğinizden emin misiniz?";
                            var result = e.row.key.active == 1 ? DevExpress.ui.dialog.confirm("<i>" + pasif + "</i>", "Kayıt silme işlemi")
                                : DevExpress.ui.dialog.confirm("<i>" + aktif + "</i>", "Kayıt aktif işlemi");
                            result.done(function (dialogResult) {
                                if (dialogResult) {
                                    changeStatus(e.row.key.Id);
                                }
                            });
                        }
                    },
                    {
                        name: " SelectPackage ",
                        hint: "Paket Seç",
                        icon: "fa-solid fa-plus",
                        onClick: function (e) {
                            GetPackage(e.row.key.Id);
                        }
                    },
                ]
            },
            {
                dataField: "Id",
                caption: "Id",
                minwidth: 20
            },
            {
                dataField: "name",
                caption: "Name",
                minwidth: 100
            },
            {
                dataField: "city_name",
                caption: "City Name",
                minwidth: 80
            },
            {
                dataField: "country_name",
                caption: "Country Name",
                minwidth: 80
            },
            {
                dataField: "address",
                caption: "Address",
                minwidth: 120
            },
            {
                dataField: "slug",
                caption: "Slug",
                minwidth: 100
            },
            {
                dataField: "location",
                caption: "Lokasyon",
                minwidth: 100
            },
            {
                dataField: "active",
                caption: "Aktif",
                minwidth: 30,
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
                minWidth: 30,
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
        wordWrapEnabled: true,
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
    }).dxDataGrid('instance');
}

const getFormById = async (formId) => {

    if (formId == "-1") {
        $("#modalHeading").html("Otel Ekle");
        let formJson = await hotelInsertUpdateForm();
        let formJsonResim = await resimInsertUpdateForm(null);
        $("#frmEdit").dxForm(formJson);
        $("#frmResimMenu").dxForm(formJsonResim);
    } else {
        var result;
        $.ajax({
            type: "GET",
            url: 'hotel' + '/' + formId + '/edit',
            datatype: "json",
            async: false,
            success: function (data) {
                result = data;
            }
        });

        $('#modalHeading').html("Otel Düzenle");
        let formJson = await hotelInsertUpdateForm(result);
        let formJsonResim = await resimInsertUpdateForm(result);
        $("#frmEdit").dxForm(formJson);
        $("#frmResimMenu").dxForm(formJsonResim);

    }


    $('#updateOtel').modal('show');
    $("#btnSave").unbind();
    $("#btnSave").on("click", function () {
        var frm = $("#frmEdit").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");

            console.log(json);
            delete json["countryId"];
            save(json);
        }
    });
}


const hotelInsertUpdateForm = async (data = {}) => {

    // console.log("data", data);

    sehirId = data !== {} ? data.city_id : null;
    sehirData = await getSehir(sehirId);
    // console.log(sehirData);

    ulkeData = sehirId != null ? await getUlke(sehirData.country_id) : null;
    // console.log(ulkeData);

    sehirler = sehirId != null ? await getSehirler(sehirData.country_id) : null;
    // console.log(sehirler);

    let highlighted = [{Id: 0, status: "Hayır"}, {Id: 1, status: "Evet"}];
    return {
        colCount: 2,
        labelLocation: 'top',
        formData: data,
        items: [

            {
                dataField: "name",
                label: {
                    text: 'Name'
                },

            },
            {
                dataField: "countryId",
                label: {
                    text: 'Country'
                },
                editorType: "dxSelectBox",
                editorOptions: {
                    dataSource: '/rudder/getCountryList',
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "name",
                    valueExpr: "Id",
                    value: ulkeData ? ulkeData.Id : "",//{ "Id": ulkeData.Id, "name": ulkeData.name } : '',
                    onValueChanged: async function (e) {
                        ulkeId = e.value;
                        // console.log(ulkeId);
                        var formElement = $('#frmEdit').dxForm("instance");
                        if (data.countryId == 0 || data.countryId == null) {
                            formElement.getEditor('cityId').option('disabled', true);
                        } else {
                            formElement.getEditor('cityId').option('disabled', false);
                            let newSehirListe = await getSehirler(ulkeId);
                            // console.log(newSehirListe);
                            formElement.getEditor('cityId').option('items', newSehirListe);
                        }
                        formElement.getEditor('cityId').option('value', null);

                    },
                }
            },
            {
                dataField: "address",
                label: {
                    text: 'Address'
                },
                editorOptions: {
                    height: 100
                },
                editorType: "dxTextArea",

            },

            {
                dataField: "cityId",
                label: {
                    text: 'City'
                },
                editorType: "dxSelectBox",
                editorOptions: {
                    // dataSource: '/rudder/getCityList?ulkeId=243',
                    items: sehirler,
                    disabled: (data.city_id == 0 || data.city_id == null) ? true : false,
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "name",
                    valueExpr: "Id",
                    value: sehirData ? sehirData.Id : ""//sehirData ? { "Id": sehirData.Id, "name": sehirData.name } : '',
                }
            },
            {
                dataField: "location",
                label: {
                    text: 'Lokasyon'
                },
                editorType: "dxTextArea",
                editorOptions: {
                    height: 100
                }
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
                    message: "Boş geçilemez !"
                }]

            },
        ]
    }
};

const save = async (json) => {

    $.ajax({
        data: json,
        url: "hotel",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            //console.log("result"+JSON.stringify(data));
            $("#gridContainer").dxDataGrid("instance").refresh();
            $('#updateOtel').modal('toggle').fadeOut('slow');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}
const resimInsertUpdateForm = async (data = {}) => {
    console.log("ddsdsds" + data);
    if (data !== null) {
        var file;
        $.ajax({
            type: "POST",
            url: 'get-file-list',
            data: {id: data.Id, file_type_id: 3},
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
                    allowedFileExtensions: [".jpg", ".png", ".jpeg", ".webp"],
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
                        var formElement = $('#frmEdit').dxForm("instance");

                        var dataa = formElement.option("formData");
                        var formElementResim = $('#frmResimMenu').dxForm("instance");
                        var dataaResim = formElementResim.option("formData");

                        if (!dataa.Id) {
                            msg("Önce hoteli kaydediniz,sonra dosya yükleyiniz!", "error");
                        } else {
                            var checkFiles = formElementResim.getEditor("Dosya");

                            if (checkFiles._files.length > 0) {
                                var coverFileCheck;
                                $.ajax({
                                    type: "POST",
                                    url: 'check-cover-file',
                                    data: {id: data.Id, file_type_id: 3},
                                    datatype: "json",
                                    async: false,
                                    success: function (data) {
                                        coverFileCheck = data;

                                    }
                                });

                                console.log("dsdsds" + coverFileCheck);
                                console.log("dsdsds" + dataaResim.cover_image);
                                if (coverFileCheck !== '' && dataaResim.cover_image == 1) {
                                    msg("Ana resim zaten mevcuttur", "error");
                                } else {
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
                                    "href": "/" + options.data.file_path,
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
        file_type_id: 3,
        tmp_name: json.Dosya[0].guid.tmp,
        name: json.Dosya[0].guid.name,
        general_id: json.Id,
        cover_image: json.cover_image,
    };

    form.getEditor("Dosya").reset();
    console.log(postData);

    $.ajax({
        data: JSON.stringify(postData),
        url: "hotel-file-upload",
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

const GetPackage = async (hotelId) => {

    $('#myModalLabel').html("Paket Seç");
    let formJson = await PackageSelectForm(hotelId);
    $("#frmEditHotel").dxForm(formJson);


    $('#myModal').modal('show');
    $("#btnSaveHotel").unbind();
    $("#btnSaveHotel").on("click", function () {
        var formSelectedRows = $('#frmEditHotel').dxForm("instance").getEditor('package').getSelectedRowKeys();


        var combined = $.extend({}, {SelectedRows: formSelectedRows}, {hotelId: hotelId});


        console.log("keys" + JSON.stringify(combined));
        console.log("facId" + hotelId);
        savePackage(combined);


    });
}

const PackageSelectForm = async (hotelId) => {
    var packageListActive;
    $.ajax({
        type: "GET",
        url: 'get-package-list-active',
        datatype: "json",
        async: false,
        success: function (data) {
            packageListActive = data;
        }
    });

    return {

        items: [{
            itemType: "group",
            items: [{
                editorType: "dxDataGrid",
                name: "package",
                editorOptions: {
                    dataSource: packageListActive,
                    filterRow: {visible: true},
                    showBorders: true,
                    columnAutoWidth: true,
                    allowColumnReordering: true,
                    rowAlternationEnabled: true,
                    wordWrapEnabled: true,
                    selection: {
                        mode: 'multiple',
                    },
                    keyExpr: "Id",
                    onContentReady: function (e) {

                        var hotelPackage;
                        $.ajax({
                            type: "GET",
                            url: 'hotel-package?hotelId=' + hotelId,
                            datatype: "json",
                            async: false,
                            // data: {hotelId: hotelId},
                            success: function (data) {
                                hotelPackage = data;
                            }
                        });
                        const hotelIds = hotelPackage.map(obj => obj.package_id);

                        $('#frmEditHotel').dxForm("instance").getEditor("package").selectRows(hotelIds);
                    },
                    columns: [
                        {
                            dataField: "Id",
                            caption: "No",
                            visible: 'false',
                            minWidth: 50,
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
                    ],

                }
            }]
        }]
    }

}
const changeStatus = async (Id) => {

    $.ajax({
        data: {Id: Id},
        url: 'hotel/' + Id,
        type: "PUT",
        dataType: 'json',
        success: function (data) {
            dataGrids["hotels"].refresh();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

const savePackage = async (json) => {
    //console.log(JSON.stringify(json));
    $.ajax({
        data: JSON.stringify(json),
        url: "get-package-hotel",
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
