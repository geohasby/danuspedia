//FUNGSI SEARCH//

const search = document.querySelector('button#search');
const reset = document.getElementById('reset');
const inputBox = document.getElementById('cari-nama');

search.addEventListener('click', function() {
    let namaDicari = document.querySelector('input#cari-nama').value;
    if(namaDicari != '') {
        reset.style.display = 'block';
        console.log(namaDicari);
        inputBox.style.width = '78%';
    }
});

reset.addEventListener('click', function() {
    inputBox.value = '';
    reset.style.display = 'none';
    inputBox.style.width = '88%';
});

//FUNGSI KONFIRMASI DAN POPUP//
const cancel = document.getElementsByClassName('cancel-order');
const confirms = document.getElementsByClassName('complete-order');
const yes = document.getElementById('yes');
const no = document.getElementById('no');
const popup = document.getElementById('pop-up');

var arrCancel = Array.from(cancel);
var arrConfirms = Array.from(confirms);
for(var i=0;i<cancel.length;i++){
    cancel[i].addEventListener('click', function(event) {
        popup.style.display = 'block';
        var iniYangDiKlik = arrCancel.indexOf(event.target);
        alert(iniYangDiKlik);
    });
}
for(var i=0;i<cancel.length;i++){
    confirms[i].addEventListener('click', function(event) {
        popup.style.display = 'block';
        var iniYangDiKlik = arrConfirms.indexOf(event.target);
        alert(iniYangDiKlik);
    });
}

yes.addEventListener('click', function() {
    popup.style.display = 'none';
    return true;
});
no.addEventListener('click', function() {
    popup.style.display = 'none';
    return false;
});