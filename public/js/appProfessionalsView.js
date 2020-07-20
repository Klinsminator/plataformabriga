// Global variables
var editId = 0;
var editName = null;
var editNames = null;
var editLastNames = null;
var editEmail = null;
var editDescription = null;
var editPhonePrimary = null;
var editPhoneSecondary = null;
var editAddress = null;
var editTitle = null;
var editRecommendationArea = null;
var editProfession = null;
var editOffice = null;

/*------------------------------------- AREA -------------------------------------*/
$('.professionalsTableRecommendationArea').find('.professionalsTableRecommendationAreaTd')
    .find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editName = event.target.parentNode.parentNode.parentNode.childNodes[3];
    editDescription = event.target.parentNode.parentNode.parentNode.childNodes[5];
    var name = editName.textContent;
    var description = editDescription.textContent;

    $('#professionalsModalRecommendationAreaFormName').val(name);
    $('#professionalsModalRecommendationAreaFormDescription').val(description);
    $('#professionalsModalEditRecommendationArea').modal();
});

$('#professionalsModalRecommendationAreaFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlRecommendationArea,
        data: {
            id: editId,
            name: $('#professionalsModalRecommendationAreaFormName').val(),
            description: $('#professionalsModalRecommendationAreaFormDescription').val(),
            _token: token
        },
        success: function(msg){
            $(editName).text(msg['newName']);
            $(editDescription).text(msg['newDescription']);
            alert(msg['message']);
            $('#professionalsModalEditRecommendationArea').modal('hide');
        },
        error: function(msg)
        {
            alert(msg.responseText);
        }
    });
});
/*------------------------------------- AREA -------------------------------------*/

/*------------------------------------- PROFESSIONAL -------------------------------------*/
$('.professionalsTableProfessionals').find('.professionalsTableProfessionalTd')
    .find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editTitle = event.target.parentNode.parentNode.parentNode.childNodes[3];
    editNames = event.target.parentNode.parentNode.parentNode.childNodes[5];
    editLastNames = event.target.parentNode.parentNode.parentNode.childNodes[7];
    editRecommendationArea = event.target.parentNode.parentNode.parentNode.childNodes[9];
    editProfession = event.target.parentNode.parentNode.parentNode.childNodes[11];
    editEmail = event.target.parentNode.parentNode.parentNode.childNodes[13];
    editPhonePrimary = event.target.parentNode.parentNode.parentNode.childNodes[15];
    editOffice = event.target.parentNode.parentNode.parentNode.childNodes[17];
    var names = editNames.textContent;
    var lastNames = editLastNames.textContent;
    var title = editTitle.textContent;
    var profession = editProfession.textContent;
    var Email = editEmail.textContent;
    var PhonePrimary = editPhonePrimary.textContent;
    var recommendationArea = editRecommendationArea.id;
    var office = editOffice.id;

    $('#professionalsModalProfessionalFormNames').val(names);
    $('#professionalsModalProfessionalFormLastNames').val(lastNames);
    $('#professionalsModalProfessionalFormTitle').val(title);
    $('#professionalsModalProfessionalFormProfession').val(profession);
    $('#professionalsModalProfessionalFormEmail').val(Email);
    $('#professionalsModalProfessionalFormPhone').val(PhonePrimary);
    $('#professionalsModalProfessionalFormRecommendationArea').val(recommendationArea);
    $('#professionalsModalProfessionalFormOffice').val(office);
    $('#professionalsModalEditProfessional').modal();
});

$('#professionalsModalProfessionalFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlProfessional,
        data: {
            id: editId,
            names: $('#professionalsModalProfessionalFormNames').val(),
            lastNames: $('#professionalsModalProfessionalFormLastNames').val(),
            title: $('#professionalsModalProfessionalFormTitle').val(),
            profession: $('#professionalsModalProfessionalFormProfession').val(),
            email: $('#professionalsModalProfessionalFormEmail').val(),
            phone: $('#professionalsModalProfessionalFormPhone').val(),
            recommendationArea: $('#professionalsModalProfessionalFormRecommendationArea').val(),
            office: $('#professionalsModalProfessionalFormOffice').val(),
            _token: token
        },
        success: function(msg){
            $(editTitle).text(msg['newTitle']);
            $(editNames).text(msg['newNames']);
            $(editLastNames).text(msg['newLastNames']);
            $(editRecommendationArea).attr('id', msg['newRecommendationAreaId']);
            $(editRecommendationArea).text(msg['newRecommendationArea']);
            $(editProfession).text(msg['newProfession']);
            $(editEmail).text(msg['newEmail']);
            $(editPhonePrimary).text(msg['newPhonePrimary']);
            $(editOffice).attr('id', msg['newOfficeId']);
            $(editOffice).text(msg['newOffice']);
            alert(msg['message']);
            $('#professionalsModalEditProfessional').modal('hide');
        },
        error: function(msg)
        {
            alert(msg.responseText);
        }
    });
});
/*------------------------------------- PROFESSIONAL -------------------------------------*/

/*------------------------------------- OFFICE -------------------------------------*/
$('.professionalsTableOffice').find('.professionalsTableOfficeTd')
    .find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editName = event.target.parentNode.parentNode.parentNode.childNodes[3];
    editPhonePrimary = event.target.parentNode.parentNode.parentNode.childNodes[7];
    editPhoneSecondary = event.target.parentNode.parentNode.parentNode.childNodes[9];
    editEmail = event.target.parentNode.parentNode.parentNode.childNodes[11];
    editAddress = event.target.parentNode.parentNode.parentNode.childNodes[5];
    var name = editName.textContent;
    var PhonePrimary = editPhonePrimary.textContent;
    var PhoneSecondary = editPhoneSecondary.textContent;
    var Email = editEmail.textContent;
    var Address = editAddress.textContent;

    $('#professionalsModalOfficeFormName').val(name);
    $('#professionalsModalOfficeFormPhonePrimary').val(PhonePrimary);
    $('#professionalsModalOfficeFormPhoneSecondary').val(PhoneSecondary);
    $('#professionalsModalOfficeFormEmail').val(Email);
    $('#professionalsModalOfficeFormAddress').val(Address);
    $('#professionalsModalEditOffice').modal();
});

$('#professionalsModalOfficeFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlOffice,
        data: {
            id: editId,
            name: $('#professionalsModalOfficeFormName').val(),
            phonePrimary: $('#professionalsModalOfficeFormPhonePrimary').val(),
            phoneSecondary: $('#professionalsModalOfficeFormPhoneSecondary').val(),
            Email: $('#professionalsModalOfficeFormEmail').val(),
            address: $('#professionalsModalOfficeFormAddress').val(),
            _token: token
        },
        success: function(msg){
            $(editName).text(msg['newName']);
            $(editPhonePrimary).text(msg['newPhonePrimary']);
            $(editPhoneSecondary).text(msg['newPhoneSecondary']);
            $(editEmail).text(msg['newEmail']);
            $(editAddress).text(msg['newAddress']);
            alert(msg['message']);
            $('#professionalsModalEditOffice').modal('hide');
        },
        error: function(msg)
        {
            alert(msg.responseText);
        }
    });
});
/*------------------------------------- OFFICE -------------------------------------*/
