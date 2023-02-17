$( document ).ready(function() {

$('#gridContainer').dxDataGrid({
    keyExpr: "Id",
    dataSource: '/rudder/menu-post' ,
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

                    }
                },
                {
                    hint: "Sil",
                    icon: "fa fa-trash",
                    onClick: function (e) {
                        var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
                        result.done(function (dialogResult) {
                            if (dialogResult) {

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

});
