function navActive() {
  var elements = [
    document.getElementsByTagName("nav")[0],
    document.getElementsByClassName("menu")[0]
  ]

  elements.forEach(element => {
    element.classList.toggle("nav-active");
  });
}

function numOnly(event) {
  var ascii = (event.which) ? event.which : event.keyCode
  if (ascii >= 48 && ascii <= 57) {
    return true;
  }
  return false;
}

function selectProductCart(id) {
  var totalHargaBarang = document.getElementsByClassName(id)[0];
  totalHargaBarang.classList.toggle("selected");
 
  updateTotalHarga();
} 

function updateJumlahBarang(elemen, id, stok, harga) {
  if (elemen.value == "" || elemen.value == 0) {
    elemen.value = 1;
  }
  elemen.value = (elemen.value > stok) ? stok : elemen.value;

  document.getElementsByClassName(id)[0].value = elemen.value*harga;
  updateTotalHarga();
}

function updateTotalHarga() {
  var totalHargaBarang = document.getElementsByClassName("selected");
  var link = "pembayaran.php?";
  var total = 0;
  for (var i=0; i<totalHargaBarang.length; i++) {
    total += parseInt(totalHargaBarang[i].value);
    link += "id" + i + totalHargaBarang[i].id + "&";
  }
  document.getElementsByClassName("total-harga")[0].innerHTML = total;
  document.getElementsByClassName("link-pembayaran")[0].href = link;
}



