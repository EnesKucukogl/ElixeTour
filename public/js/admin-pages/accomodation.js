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

const getAccomodationListe = () => {

    dataGrids["accomodations"] = $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/accomodation-list' ,
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
                dataField: "room_type",
                caption: "Room Type",
                // minwidth: 100
            },
            {
                dataField: "hotel_id",
                caption: "Hotel",
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

const getFormById = async (formId) => {

    if (formId == "-1") {
        $("#modalHeading").html("Konaklama Ekle");
        let formJson = await accomodationInsertUpdateForm();
        $("#frmEdit").dxForm(formJson);
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
        $("#frmEdit").dxForm(formJson);

    }


    $('#updateAccomodation').modal('show');
    $("#btnSave").unbind();
    $("#btnSave").on("click", function () {
        var frm = $("#frmEdit").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");
            console.log(json);
            save(json);
        }
    });
}


const accomodationInsertUpdateForm = async (data = {}) => {

    console.log(data);

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
