// Global variables
var editId = 0;
var editName = null;
var editUserType = null;
var editNames = null;
var editLastNames = null;
var editEmail = null;

/*------------------------------------- USER -------------------------------------*/
$('.usersTableUser').find('.usersTableUserTd').find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editUserType = event.target.parentNode.parentNode.parentNode.childNodes[5];
    editNames = event.target.parentNode.parentNode.parentNode.childNodes[7];
    editLastNames = event.target.parentNode.parentNode.parentNode.childNodes[9];
    editEmail = event.target.parentNode.parentNode.parentNode.childNodes[11];
    var names = editNames.textContent;
    var lastNames = editLastNames.textContent;
    var userType = editUserType.id;
    var email = editEmail.textContent;

    $('#usersModalUserFormNames').val(names);
    $('#usersModalUserFormLastNames').val(lastNames);
    $('#usersModalUserFormType').val(userType);
    $('#usersModalUserFormEmail').val(email);
    $('#usersModalUserFormPassword').val('');
    $('#usersModalEditUser').modal();
});

$('#usersModalUserFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlUser,
        data: {
            id: editId,
            names: $('#usersModalUserFormNames').val(),
            lastNames: $('#usersModalUserFormLastNames').val(),
            type: $('#usersModalUserFormType').val(),
            email: $('#usersModalUserFormEmail').val(),
            password: $('#usersModalUserFormPassword').val(),
            _token: token
        }
    }).done(function (msg, status) {
        if(status !== "success") {
            alert(msg['message']);
        }
        else
        {
            $(editNames).text(msg['newNames']);
            $(editLastNames).text(msg['newLastNames']);
            $(editUserType).attr('id', msg['newUserTypeId']);
            $(editUserType).text(msg['newUserType']);
            $(editEmail).text(msg['newEmail']);
            alert(msg['message']);
            $(".modal-body1").html("");
            $('#usersModalEditUser').modal('hide');
        }
    });
});
/*------------------------------------- USER -------------------------------------*/

/*------------------------------------- USERTYPE -------------------------------------*/
$('.usersTableUserType').find('.usersTableUserTypeTd').find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editName = event.target.parentNode.parentNode.parentNode.childNodes[3];
    var name = editName.textContent;

    $('#usersModalTypeFormIdInput').val(name);
    $('#usersModalEditUserType').modal();
});

$('#usersModalTypeFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlUserType,
        data: {
            id: editId,
            name: $('#usersModalTypeFormIdInput').val(),
            _token: token
        }
    }).done(function (msg, status) {
        if(status !== "success") {
            alert(msg['message']);
        }
        else
        {
            $(editName).text(msg['newName']);
            alert(msg['message']);
            $('#usersModalEditUserType').modal('hide');
        }
    });
});
/*------------------------------------- USERTYPE -------------------------------------*/
