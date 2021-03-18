function removeRow(button) {
    $(button).parent().parent().remove();
}

function addRow() {
    $('#newRow').clone().prependTo('#tbody').removeAttr("hidden");
}



