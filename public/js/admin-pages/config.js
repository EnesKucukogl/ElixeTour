$(document).ready(function () {

    getFormById();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



//
});

const getFormById = async () => {


    var result;
    $.ajax({
        type: "GET",
        url: 'config/1/edit',
        datatype: "json",
        async: false,
        success: function(data){
            result = data;
        },

    });


    let formJson = await ConfigInsertUpdateForm(result);
    $("#frmEditConfig").dxForm(formJson);


    // $('#updateProfile').modal('show');
    $("#btnSaveConfig").unbind();
    $("#btnSaveConfig").on("click", function () {
        var frm = $("#frmEditConfig").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");

            console.log(json);
            saveConfig(json);
        }
    });
}

const ConfigInsertUpdateForm = async (data = {}) => {

    console.log("data", data);



    return {
        colCount: 2,
        labelLocation: 'top',
        formData: data,
        items: [

            {
                dataField: "telephone",
                label: {
                    text: 'Telefon'
                },
                validationRules: [{
                    type: "required",
                    message: "Telefon boş geçilemez!"
                }]
            },
            {
                dataField: "mail",
                label: {
                    text: 'E-posta'
                },
                validationRules: [{
                    type: "required",
                    message: "E-posta boş geçilemez!"
                }]
            },

            {
                dataField: "instagram_link",
                label: {
                    text: 'Instagram'
                },
                validationRules: [{
                    type: "required",
                    message: "Instagram boş geçilemez!"
                }]
            },

            {
                dataField: "facebook_link",
                label: {
                    text: 'Facebook'
                },
                validationRules: [{
                    type: "required",
                    message: "Facebook boş geçilemez!"
                }]
            },
            {
                dataField: "whatsapp",
                label: {
                    text: 'Whatsapp'
                },
                validationRules: [{
                    type: "required",
                    message: "Whatsapp boş geçilemez!"
                }]
            },


        ]
    }
};

const saveConfig = async (json) => {

    $.ajax({
        data: json ,
        url: "config",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            msg(data.message,data.type);
            getFormById()
        },
        error: function (data) {

            console.log('Error:', data);
        }
    });

}
