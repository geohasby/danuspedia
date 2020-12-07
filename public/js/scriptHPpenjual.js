//FUNGSI SEARCH//

const search = document.querySelector('button#search');
const reset = document.getElementById('reset');
const inputBox = document.getElementById('cari-nama');
const kolomPesanan = document.getElementById('pesanan');

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

if(document.getElementById("confirmOrder") != null){
  var kelas = "confirmOrder";
  setTimeout(fading,3000);
}
else if(document.getElementById("cancelOrder") != null){
  var kelas = "cancelOrder"
  setTimeout(fading,3000);
}
  
function fading(){
  document.getElementById(kelas).classList.toggle("gone");
}


//FUNGSI KONFIRMASI DAN POPUP//
// const id_order = document.getElementsByClassName('order_id');
// const cancel = document.getElementsByClassName('cancel-order');
// const confirms = document.getElementsByClassName('complete-order');
// const yes = document.getElementById('yes');
// const no = document.getElementById('no');
// const popup = document.getElementById('pop-up');

// var arrOrderID = Array.from(id_order);
// var arrCancel = Array.from(cancel);
// var arrConfirms = Array.from(confirms);
// for(var i=0; i<cancel.length; i++){
//     cancel[i].addEventListener('click', function(event) {
//         popup.style.display = 'block';
//         var orderID = arrOrderID[arrCancel.indexOf(event.target)].innerHTML;
 
//         yes.action = "{{ rout('order.destroy'" + orderID + ") }}";

//         no.addEventListener('click', function() {
//             popup.style.display = 'none';
//         });
//     });
// }
// for(var i=0; i<confirms.length; i++){
//     confirms[i].addEventListener('click', function(event) {
//         popup.style.display = 'block';
//         var orderID = arrOrderID[arrConfirms.indexOf(event.target)].innerHTML;
//         alert(orderID);

//         yes.action = "{{ rout('confirm_order', " + orderID + ") }}";

//         no.addEventListener('click', function() {
//             popup.style.display = 'none';
//         });
//     });
// }
//SUSAH PAKE POP UP