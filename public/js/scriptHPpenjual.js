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
const id_order = document.getElementsByClassName('order_id');
const cancel = document.getElementsByClassName('cancel-order');
const confirms = document.getElementsByClassName('complete-order');
const yes = document.getElementById('yes');
const no = document.getElementById('no');
const popup = document.getElementById('pop-up');

var arrOrderID = Array.from(id_order);
var arrCancel = Array.from(cancel);
var arrConfirms = Array.from(confirms);
for(var i=0; i<cancel.length; i++){
    cancel[i].addEventListener('click', function(event) {
        popup.style.display = 'block';
        var orderID = arrOrderID[arrCancel.indexOf(event.target)].innerHTML;
    });
}
for(var i=0; i<confirms.length; i++){
    confirms[i].addEventListener('click', function(event) {
        popup.style.display = 'block';
        var orderID = arrOrderID[arrConfirms.indexOf(event.target)].innerHTML;

        yes.href = "{{ route() }}";
        no.href = "yahoo.com"+orderID;

        yes.addEventListener('click', function() {
            alert('yes');
        });

        no.addEventListener('click', function() {
            alert('no');
        });
    });
}