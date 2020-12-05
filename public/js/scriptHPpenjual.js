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
const cancel = document.getElementById('cancel-order');
const confirm = document.getElementById('complete-order');
const yes = document.getElementById('yes');
const no = document.getElementById('no');
const popup = document.getElementById('pop-up');

cancel.addEventListener('click', function() {
    popup.style.display = 'block';
});
confirm.addEventListener('click', function() {
    popup.style.display = 'block';
});
yes.addEventListener('click', function() {
    popup.style.display = 'none';
    return true;
});
no.addEventListener('click', function() {
    popup.style.display = 'none';
    return false;
});