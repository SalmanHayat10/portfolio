
/**
*   Flash Message Wrapper
*/
function showErrorMessage(msg, duration = 3000) {
    const randomId = 'msg' + Math.round(Math.random() * 1000);
    $("#flash-container").append("<div id=\"" + randomId + "\" class=\"alert alert-danger alert-dismissible fade show mb-0\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button><i class=\"fa fa-times mx-2\"></i><strong>Error!</strong> " + msg + "</div>");
    setTimeout(function() {
        $('#' + randomId).fadeOut(duration);
    },0);
}
function showSuccessMessage(msg, duration = 3000) {
    const randomId = 'msg' + Math.round(Math.random() * 1000);
    $("#flash-container").append("<div id=\"" + randomId + "\" class=\"alert alert-success alert-dismissible fade show mb-0\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button><i class=\"fa fa-check mx-2\"></i><strong>Success!</strong> " + msg + "</div>");
    setTimeout(function() {
        $('#' + randomId).fadeOut(duration);
    },0);
}