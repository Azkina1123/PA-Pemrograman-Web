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

function updateJumlahBarang(input,  stok) {
  if (input.value == "" || input.value == 0) {
    input.value = 1;
  }
  input.value = (input.value > stok) ? stok : input.value;
}

function pilihProdukDibayar(checkInput, id, harga) {  
  // jika checkbox di-checked
  if (checkInput.checked) {
    checkInput.classList.add("selected");
    checkInput.value = document.querySelector("input#jumlah"+id).value * harga
    
  // jika checkbox tidak di-checked
  } else {
    checkInput.classList.remove("selected");
    checkInput.value = 0;
  }
}

function updateTotalHargaBarang(elemen, id, harga) {
  var selector = "input#produk" + id;
  document.querySelector(selector).value = elemen.value * harga;
}

function updatePembayaran() {
  var totalHargaBarangAll = document.getElementsByClassName("selected");
  var pembayaran = 0;

  for (var i = 0; i < totalHargaBarangAll.length; i++) {
    pembayaran += parseInt(totalHargaBarangAll[i].value);
  }

  document.getElementsByClassName("total-pembayaran")[0].innerHTML = pembayaran;
}
