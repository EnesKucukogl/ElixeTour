const dataGrids = {};
let ulkeData = [];
let sehirData = [];
let sehirler = [];
let ulkeId = 0;
let sehirId = 0;

$( document ).ready(function() {
    getHotelListe();

    $('#addOffice').on('click', function () {
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

const getSehir = async (id) => {

    if (!id) return null;

    let result;

    $.ajax({
        type: "GET",
        url: '/rudder/getCity?id='+id,
        datatype: "json",
        async: false,
        success: function(data){
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
        url: 'getCityList?ulkeId='+ulkeId,
        datatype: "json",
        async: false,
        success: function(data){
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

    dataGrids["office"] = $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/offices-list' ,
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
                    }
                ]
            },
            {
                dataField: "Id",
                caption: "Id",
                // minwidth: 100
            },
            {
                dataField: "name",
                caption: "Ofis Adı",
                // minwidth: 100
            },
            {
                dataField: "city_name",
                caption: "Şehir",
                // minwidth: 100
            },
            {
                dataField: "country_name",
                caption: "Ülke",
                // minwidth: 100
            },
            {
                dataField: "address",
                caption: "Adres",
                // minwidth: 100
            },
            {
                dataField: "telephone",
                caption: "Telefon",
                // minwidth: 100
            },
            {
                dataField: "google_maps",
                caption: "Google Maps Linki",
                // minwidth: 100
            },
            {
                dataField: "address",
                caption: "Adres",
                // minwidth: 100
            },
            {

                dataField: "active",
                caption: "Aktif",
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
    }).dxDataGrid('instance');
}

const getFormById = async (formId) => {

    if (formId == "-1") {
        $("#modalHeading").html("Ofis Ekle");
        let formJson = await officeInsertUpdateForm();
        $("#frmEditOffice").dxForm(formJson);

    }
    else {
        var result;
        $.ajax({
            type: "GET",
            url: 'offices' +'/'+formId+'/edit',
            datatype: "json",
            async: false,
            success: function(data){
                result = data;
            }
        });

        $('#modalHeading').html("Ofis Düzenle");
        let formJson = await officeInsertUpdateForm(result);
        $("#frmEditOffice").dxForm(formJson);

    }


    $('#updateOffice').modal('show');
    $("#btnSave").unbind();
    $("#btnSave").on("click", function () {
        var frm = $("#frmEditOffice").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");

            console.log(json);
            delete json["countryId"];
            save(json);
        }
    });
}


const officeInsertUpdateForm = async (data = {}) => {

    // console.log("data", data);

    sehirId = data !== {} ? data.city_id : null;
    sehirData = await getSehir(sehirId);
    // console.log(sehirData);

    ulkeData = sehirId != null ? await getUlke(sehirData.country_id) : null;
    // console.log(ulkeData);

    sehirler = sehirId != null ? await getSehirler(sehirData.country_id) : null;
    // console.log(sehirler);

    return {
        colCount: 2,
        labelLocation: 'top',
        formData: data,
        items: [

            {
                dataField: "name",
                label: {
                    text: 'Adı'
                },
                validationRules: [{
                    type: "required",
                    message: "Adı boş geçilemez !"
                }]
            },
            {
                dataField: "countryId",
                label: {
                    text: 'Ülke'
                },
                editorType: "dxSelectBox",
                validationRules: [{
                    type: "required",
                    message: "Ülke boş geçilemez !"
                }],
                editorOptions: {
                    dataSource: '/rudder/getCountryList',
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "name",
                    valueExpr: "Id",
                    value:  ulkeData ? ulkeData.Id : "",//{ "Id": ulkeData.Id, "name": ulkeData.name } : '',
                    onValueChanged: async function (e) {
                        ulkeId = e.value;
                        // console.log(ulkeId);
                        var formElement = $('#frmEditOffice').dxForm("instance");
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
                    text: 'Adres'
                },
                editorType: "dxTextArea",
                validationRules: [{
                    type: "required",
                    message: "Adres boş geçilemez !"
                }],

            },
            {
                dataField: "cityId",
                label: {
                    text: 'Şehir'
                },
                editorType: "dxSelectBox",
                validationRules: [{
                    type: "required",
                    message: "Şehir boş geçilemez !"
                }],
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
                dataField: "telephone",
                label: {
                    text: 'Telefon'
                },
                validationRules: [{
                    type: "required",
                    message: "Telefon boş geçilemez !"
                }],

            },
            {
                dataField: "google_maps",
                label: {
                    text: 'Google Maps Linki'
                },
                validationRules: [{
                    type: "required",
                    message: "Google Maps linki boş geçilemez !"
                }],

            },


        ]
    }
};

const save = async (json) => {

    $.ajax({
        data: json ,
        url: "offices",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            //console.log(data.message);
            msg(data.message, data.type);
            $("#gridContainer").dxDataGrid("instance").refresh();
            $('#updateOffice').modal('toggle').fadeOut('slow');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

const changeStatus = async (Id) => {

    $.ajax({
        data: {Id:Id},
        url: 'offices/'+Id,
        type: "PUT",
        dataType: 'json',
        success: function (data) {
            msg(data.message, data.type);
            dataGrids["office"].refresh();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
