// function removeRow(button) {
//     $(button).parent().parent().remove();
// }

// function addRow() {
//     $('#newRow').clone().prependTo('#tbody').removeAttr("hidden");
// }


function removeRow(button) {
    $(button).parent().parent().remove();
}

function addRow() {
    newTr = $('#newOption').children().children().clone();
    $('#existingOption').prepend(newTr);
}