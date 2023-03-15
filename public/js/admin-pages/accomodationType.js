const dataGrids = {};
let ulkeData = [];
let sehirData = [];
let sehirler = [];
let ulkeId = 0;
let sehirId = 0;

$( document ).ready(function() {
    getAccomodationTypeListe();

    $('#addAccomodationType').on('click', function () {
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

const getAccomodationTypeListe = () => {

    dataGrids["accomodationTypes"] = $('#gridContainer').dxDataGrid({
        keyExpr: "Id",
        dataSource: '/rudder/accomodationType-list' ,
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
                caption: "Konaklama Oda Tipi",
                // minwidth: 100
            },
            {
                dataField: "room_type_detail",
                caption: "Oda Tipi",
                // minwidth: 100
            },
            {
                dataField: "room_board",
                caption: "Pansiyon",
                // minwidth: 100
            },
            {
                dataField: "sales_price",
                caption: "Satış Tutar",
                // minwidth: 100
            },
            {
                dataField: "sales_currency_symbol",
                caption: "Para Birimi",
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
        $("#modalHeading").html("Konaklama Tipi Ekle");
        let formJson = await accomodationTypeInsertUpdateForm();
        $("#frmEdit").dxForm(formJson);
    }
    else {
        var result;
        $.ajax({
            type: "GET",
            url: 'accomodationType' +'/'+formId+'/edit',
            datatype: "json",
            async: false,
            success: function(data){
                result = data;
            }
        });

        $('#modalHeading').html("Konaklama Tipi Düzenle");
        let formJson = await accomodationTypeInsertUpdateForm(result);
        $("#frmEdit").dxForm(formJson);

    }


    $('#updateAccomodationType').modal('show');
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


const accomodationTypeInsertUpdateForm = async (data = {}) => {

    // console.log(data);

    return {
        colCount: 2,
        formData: data,
        items: [
            {
                dataField: "accomodationId",
                label: {
                    text: 'Konaklama'
                },
                editorType: "dxSelectBox",
                editorOptions: {
                    dataSource: '/rudder/accomodation-list',
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "room_type",
                    valueExpr: "Id",
                    value:  data.accomodation_id
                }
            },
            {
                dataField: "roomTypeDetail",
                label: {
                    text: 'Oda Tipi'
                },
                editorOptions: {
                    value:  data.room_type_detail
                }
            },
            {
                dataField: "roomBoard",
                label: {
                    text: 'Pansiyon'
                },
                editorOptions: {
                    value:  data.room_board
                }
            },
            {
                dataField: "salesPrice",
                label: {
                    text: 'Tutar'
                },
                editorOptions: {
                    value:  data.sales_price
                }
            },
            {
                dataField: "salesCurrencyId",
                label: {
                    text: 'Para Birimi'
                },
                editorType: "dxSelectBox",
                editorOptions: {
                    dataSource: '/rudder/currency-list',
                    showClearButton: true,
                    searchEnabled: true,
                    displayExpr: "name",
                    valueExpr: "Id",
                    value:  data.sales_currency_id
                }
            },
        ]
    }
};

const save = async (json) => {

    $.ajax({
        data: json ,
        url: "accomodationType",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            //console.log("result"+JSON.stringify(data));
            dataGrids["accomodationTypes"].refresh();
            $('#updateAccomodationType').modal('toggle').fadeOut('slow');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

const changeStatus = async (Id) => {

    $.ajax({
        data: {Id:Id},
        url: 'accomodationType/'+Id,
        type: "PUT",
        dataType: 'json',
        success: function (data) {
            dataGrids["accomodationTypes"].refresh();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
