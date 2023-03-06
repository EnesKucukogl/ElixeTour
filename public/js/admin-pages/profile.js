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

    // if (formId == "-1") {
    //     $("#modelHeading").html("Profile Ekle");
    //     let formJson = await ProfileInsertUpdateForm(null);
    //     $("#frmEditProfile").dxForm(formJson);
    // }
    // else {
    //
    //
    // }

    var result;
    $.ajax({
        type: "GET",
        url: 'getProfile',
        datatype: "json",
        async: false,
        success: function(data){
            result = data;
        },

    });

    $('#modelHeading').html("Profile Düzenle");
    let formJson = await ProfileInsertUpdateForm(result);
    $("#frmEditProfile").dxForm(formJson);


    // $('#updateProfile').modal('show');
    $("#btnSaveProfile").unbind();
    $("#btnSaveProfile").on("click", function () {
        var frm = $("#frmEditProfile").dxForm("instance");
        var validate = frm.validate();
        if (validate.isValid) {

            var json = frm.option("formData");

            console.log(json);
            saveProfile(json);
        }
    });
}

const ProfileInsertUpdateForm = async (data = {}) => {

    console.log("data", data);



    return {
        colCount: 2,
        formData: data,
        items: [
            {
                dataField: "user_name",
                label: {
                    text: 'Kullanıcı Adı'
                },
                editorOptions: {
                    readOnly: true
                },
            },

            {
                dataField: "oldPassword",
                label: {
                    text: 'Eski Şifre'
                },
                editorOptions: {
                    mode: "password",
                    value: ""
                }, validationRules: [{
                    type: "required",
                    message: "Lütfen eski şifrenizi giriniz!",
                }]
            },
            {
                dataField: "name",
                label: {
                    text: 'Ad'

                },
                editorOptions: {
                    readOnly: true
                },

            },


            {
                dataField: "newPassword",
                label: {
                    text: 'Yeni Şifre'
                },
                editorOptions: {
                    mode: "password"
                }, validationRules: [{
                    type: 'stringLength',
                    min: 6,
                    message: 'Şifre en az 6 karakter içermelidir!'
                }]
            },
            {
                dataField: "surname",
                label: {
                    text: 'Soyad'
                },
                editorOptions: {
                    readOnly: true
                },
            },


            {
                dataField: "newPasswordAgain",
                label: {
                    text: 'Yeni Şifre Tekrar'

                },
                editorOptions: {
                    mode: "password"
                }, validationRules: [{
                    type: 'stringLength',
                    min: 6
                }]
            },

        ]
    }
};

const saveProfile = async (json) => {

    $.ajax({
        data: json ,
        url: "profile",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            msg(data.mesaj,data.kod == 0 ? 'success' : 'error');

        },
        error: function (data) {
            // console.log('Error:', data);
            msg(data.mesaj,"Error");
        }
    });

}
