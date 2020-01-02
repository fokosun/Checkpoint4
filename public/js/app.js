var remaining = 237;
$('#charNum').text(remaining);

function countChar(val) {
    var len = val.value.length;
    let left = remaining - len;
    $('#charNum').text(left);

};
