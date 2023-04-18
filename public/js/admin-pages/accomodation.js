const dataGrids = {};
let ulkeData = [];
let sehirData = [];
let sehirler = [];
let ulkeId = 0;
let sehirId = 0;

$( document ).ready(function() {
    getAccomodationListe();

    $('#addAccomodation').on('click', function () {
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
        url: '/rudder/getCountry?id='+ulkeId,
        datatype: "json",
        async: false,
        success: function(data){
            result = data == null ? [] : data;
        }
    });

    if (result) {
        return result;
    } else {
        console.log("Ülke Bilgisi Bulunamadı.");
    }
}



const getAccomodationListe = () => {

    dataGrids["accomodations"] = $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/accomodation-list' ,
        columns: [
            {
                type: "buttons",
                minWidth: 110,
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
                dataField: "room_type",
                caption: "Room Type",
                // minwidth: 100
            },

            {
                hidingPriority: 1,
                dataField: "active",
                caption: "Active",
                lookup: {
                    dataSource: {
                        store: {
                            type: "array",
                            data: [
                                { id: 0, name: "Hayır" },
                                { id: 1, name: "Evet" },
                            ],
                            key: "id"
                        }
                    },
                    valueExpr: "id", // contains the same values as the "statusId" field provides
                    displayExpr: "name" // provides display values
                }
            }
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
    }).dxDataGrid('instance');
}

const GetHotel = async (accomodationId) => {

    $('#myModalLabel').html("Otel Seç");
    $('#myModal').modal('show');
    let formJson = await HotelSelectForm(accomodationId);
    $("#frmEditHotel").dxForm(formJson);



    $("#btnSaveHotel").unbind();
    $("#btnSaveHotel").on("click", function () {
        var formSelectedRows = $('#frmEditHotel').dxForm("instance").getEditor('hotel').getSelectedRowKeys();


        var combined = $.extend({}, {SelectedRows: formSelectedRows}, {accomodationId: accomodationId});


        console.log("keys" + JSON.stringify(combined));
        console.log("facId" + accomodationId);
        saveHotel(combined);


    });
}



const HotelSelectForm = async (accomodationId) => {
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
                            url: 'hotel-accomodation',
                            datatype: "json",
                            async: false,
                            data: {accomodationId: accomodationId},
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


const getFormById = async (formId) => {
    console.log("formIdddd",formId)

    if (formId == "-1") {
        $("#modalHeading").html("Konaklama Ekle");
        let formJson = await accomodationInsertUpdateForm();
        let formJsonResim = await resimInsertUpdateForm(null);
        console.log("formJsonResim",formJsonResim)
        $("#frmEdit").dxForm(formJson);
        $("#frmResimMenu").dxForm(formJsonResim);
    }
    else {
        var result;
        $.ajax({
            type: "GET",
            url: 'accomodation' +'/'+formId+'/edit',
            datatype: "json",
            async: false,
            success: function(data){
                result = data;
            }
        });

        $('#modalHeading').html("Konaklama Düzenle");
        let formJson = await accomodationInsertUpdateForm(result);
        let formJsonResim = await resimInsertUpdateForm(result);
        $("#frmEdit").dxForm(formJson);
        $("#frmResimMenu").dxForm(formJsonResim);

    }


    $('#updateAccomodation').modal('show');
    $("#btnSave").unbind();
    $("#btnSave").on("click", function () {
        var frm = $("#frmEdit").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");
            // console.log(json);
            save(json);
        }
    });
}
const resimInsertUpdateForm = async (data = {}) => {
console.log('DATA',data)
    if (data !== null) {
        var file;
        $.ajax({
            type: "POST",
            url: 'get-file-list',
            data: {id: data.Id, file_type_id: 1},
            datatype: "json",
            async: false,
            success: function (data) {
                file = data;

            }
        });
    }
    let cover_image = [ {Id: 1, status: "Evet"}];

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
                            msg("Önce konaklamayı kaydediniz,sonra dosya yükleyiniz!", "error");
                        } else {
                            var checkFiles = formElementResim.getEditor("Dosya");

                            if (checkFiles._files.length > 0) {
                                var coverFileCheck;
                                $.ajax({
                                    type: "POST",
                                    url: 'check-cover-file',
                                    data: {id: data.Id, file_type_id: 6},
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
        file_type_id: 6,
        tmp_name: json.Dosya[0].guid.tmp,
        name: json.Dosya[0].guid.name,
        general_id: json.Id,
        cover_image: json.cover_image,
    };

    form.getEditor("Dosya").reset();
    console.log(postData);

    $.ajax({
        data: JSON.stringify(postData),
        url: "save-file",
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

const accomodationInsertUpdateForm = async (data = {}) => {

    // console.log(data);

    return {
        colCount: 2,
        formData: data,
        items: [
            {
                dataField: "roomType",
                label: {
                    text: 'Room Type'
                },
                editorOptions: {
                    value: data.room_type
                }
            },
            {
                dataField: "hotelId",
                label: {
                    text: 'Hotel'
                },
                editorType: "dxSelectBox",
                editorOptions: {
                    dataSource: '/rudder/hotel-list',
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "name",
                    valueExpr: "Id",
                    value:  data.hotel_id
                }
            },
        ]
    }
};

const save = async (json) => {

    $.ajax({
        data: json ,
        url: "accomodation",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            //console.log("result"+JSON.stringify(data));
            $("#gridContainer").dxDataGrid("instance").refresh();
            $('#updateAccomodation').modal('toggle').fadeOut('slow');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

const changeStatus = async (Id) => {

    $.ajax({
        data: {Id:Id},
        url: 'accomodation/'+Id,
        type: "PUT",
        dataType: 'json',
        success: function (data) {
            dataGrids["accomodations"].refresh();
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
        url: "get-hotel-accomodation",
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
