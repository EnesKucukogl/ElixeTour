<script>
$(document).ready(function () {
$('#gridContainer').dxDataGrid({
keyExpr: "id",
dataSource: '../controller/flight-form/load.php',
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
getFormById(e.row.key);
}
},
{
hint: "Sil",
icon: "fa fa-trash",
onClick: function (e) {
var result = DevExpress.ui.dialog.confirm("<i>Kaydı silmek istediğinizden emin misiniz?</i>", "Kayıt silme işlemi");
result.done(function (dialogResult) {
if (dialogResult) {
removeForm(e.row.key);
}
});
}
}

]
},

{
dataField: "form_no",
caption: "Form No"
},
{
dataField: "date",
caption: "Tarih",
dataType: "date",
format: "dd.MM.yyyy",
dateSerializationFormat: "yyyy-MM-dd",
},
{
dataField: "pilot",
caption: "Pilot"
},
{
dataField: "kalkis_mey",
caption: "KALKIŞ MEY"
},
{
caption: "KALKIŞ",
columns: ["OFF Block","Kalkış"]
},
{
dataField: "inis_mey",
caption: "İNİŞ MEY"
},
{
caption: "İNİŞ",
columns: ["İnis","OnBlock"]
},
{
dataField: "ucus",
caption: "UÇUŞ"
},
{
dataField: "blok",
caption: "BLOK"
},
{
dataField: "inis",
caption: "İNİŞ"
},
{
dataField: "pax",
caption: "PAX"
},
{
caption: "Added",
columns: ["Yakıt Lt."]
},
{
dataField: "vip",
caption: "VIP"
},
{
caption: "Airframe",
columns: ["TTAF", "Total Lnd"]
},
{
caption: "Engine No 1",
columns: ["TSN", "CSN"]
},
{
caption: "Engine No 2",
columns: ["TSN", "CSN"]
}

],
selection: {
mode: 'multiple',

},
editing: {
mode: "row",
allowUpdating: true
},
remoteOperations: false,
showBorders: true,
paging: {
pageSize: 10,
},
columnChooser: {
enabled: true,
mode: 'select',
},
columnAutoWidth: true,
export: {
enabled: true,
allowExportSelectedData: true,
},
onExporting(e) {
const workbook = new ExcelJS.Workbook();
const worksheet = workbook.addWorksheet('FlightForm');

DevExpress.excelExporter.exportDataGrid({
component: e.component,
worksheet,
autoFilterEnabled: true,
}).then(() => {
workbook.xlsx.writeBuffer().then((buffer) => {
saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'FlightForm.xlsx');
});
});
e.cancel = true;
},
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




function removeForm(id)
{
var options = {
url: "controller/flight-form/remove.php",
dataType: "text",
type: "POST",
data: { json: JSON.stringify( id ) }, // Our valid JSON string
success: function( data, status, xhr ) {

if(data == 1)
$("#gridContainer").dxDataGrid("instance").refresh();
},
error: function( xhr, status, error ) {
alert("Bir hata oluştu!");
}
};
$.ajax( options );
}

$('#addUser').on('click', function () {
getFormById(-1);
});

const getFormById = async (formId) => {

if (formId == "-1") {
$("#modalTitle").html("Form Ekle");
let formJson = await userInsertUpdateForm(null);
$("#frmEditUser").dxForm(formJson);
} else {

$("#modalTitle").html("Form Güncelle");



let formJson = await userInsertUpdateForm(formId);
$("#frmEditUser").dxForm(formJson);

}

$('#updateModal').modal('show');


$("#btnSaveUser").unbind();
$("#btnSaveUser").on("click", function () {
var frm = $("#frmEditUser").dxForm("instance");
var validate = frm.validate();
if (validate.isValid) {

var json = frm.option("formData");

console.log(json);
saveUser(json);
}
});
}

const saveUser = async (json) => {

addForm(json);

$("#gridContainer").dxDataGrid("instance").refresh();
$('#updateModal').modal('toggle').fadeOut('slow');

}

function addForm(json){

var options = {
url: "controller/flight-form/add.php",
dataType: "text",
type: "POST",
data: { json: JSON.stringify( json ) }, // Our valid JSON string
success: function( data, status, xhr ) {


},
error: function( xhr, status, error ) {
alert("Bir hata oluştu!");
}
};
$.ajax( options );
}


const userInsertUpdateForm = async (data = {}) => {

console.log("data", data);

return {
colCount: 2,
formData: data,
items: [
{
dataField: "form_no",
label: {
text: 'Form No'
},
editorType: 'dxNumberBox',
validationRules: [{
type: "required",
message: "Form No boş geçilemez !"
}]
},
{
dataField: "date",
label: {
text: "Tarih"
},
editorType: "dxDateBox",
editorOptions: {
dataType: "date",
displayFormat: "dd.MM.yyyy",
dateSerializationFormat: "yyyy-MM-dd",
},
validationRules: [{
type: "required",
message: "Tarih boş geçilemez"
}]
},
{
dataField: "pilot",
label: {
text: 'Pilot'
},

validationRules: [{
type: "required",
message: "Pilot boş geçilemez !"
}]
},
]
}
};
</script>
