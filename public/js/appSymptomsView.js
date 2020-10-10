// Global variables
var editId = 0;
var editName = null;
var editDescription = null;

/*------------------------------------- SYMPTOM -------------------------------------*/
$('.symptomsTableSymptoms').find('.symptomsTableSymptomsTd')
    .find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editName = event.target.parentNode.parentNode.parentNode.childNodes[3];
    editDescription = event.target.parentNode.parentNode.parentNode.childNodes[5];
    var name = editName.textContent;
    var description = editDescription.textContent;

    $('#symptomsModalSymptomFormName').val(name);
    $('#symptomsModalSymptomFormDescription').val(description);
    $('#symptomsModalEditSymptom').modal();
});

$('#symptomsModalSymptomFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlSymptom,
        data: {
            id: editId,
            name: $('#symptomsModalSymptomFormName').val(),
            description: $('#symptomsModalSymptomFormDescription').val(),
            _token: token
        },
        success: function(msg){
            $(editName).text(msg['newName']);
            $(editDescription).text(msg['newDescription']);
            alert(msg['message']);
            $('#symptomsModalEditSymptom').modal('hide');
        },
        error: function(msg)
        {
            alert(msg.responseText);
        }
    });
});
/*------------------------------------- SYMPTOM -------------------------------------*/

/*------------------------------------- RECOMMENDATIONS -------------------------------------*/
$('.symptomsTableRecommendations').find('.symptomsTableRecommendationsTd')
    .find('.edit').on('click', function(event) {
    // This prevents any other behavior
    event.preventDefault();

    editId = event.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
    editName = event.target.parentNode.parentNode.parentNode.childNodes[3];
    editDescription = event.target.parentNode.parentNode.parentNode.childNodes[5];
    var name = editName.textContent;
    var description = editDescription.textContent;

    $('#symptomsModalRecommendationFormName').val(name);
    $('#symptomsModalRecommendationFormDescription').val(description);
    $('#symptomsModalEditRecommendation').modal();
});

$('#symptomsModalRecommendationFormIdSubmit').on('click', function() {
    $.ajax({
        method: 'POST',
        url: urlRecommendation,
        data: {
            id: editId,
            name: $('#symptomsModalRecommendationFormName').val(),
            description: $('#symptomsModalRecommendationFormDescription').val(),
            _token: token
        },
        success: function(msg){
            $(editName).text(msg['newName']);
            $(editDescription).text(msg['newDescription']);
            alert(msg['message']);
            $('#symptomsModalEditRecommendation').modal('hide');
        },
        error: function(msg)
        {
            alert(msg.responseText);
        }
    });
});
/*------------------------------------- RECOMMENDATIONS -------------------------------------*/
