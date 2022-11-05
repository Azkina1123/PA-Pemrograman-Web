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
  var totalHargaBarang = document.querySelector("input#total-harga-barang" + id);
  var jumlahBarang = document.querySelector("input#jumlah" + id);
  
  // jika checkbox di-checked
  if (checkInput.checked) {
    totalHargaBarang.classList.add("selected");
    totalHargaBarang.value = jumlahBarang.value * harga;
    
    // jika checkbox tidak di-checked
  } else {
    totalHargaBarang.classList.remove("selected");
    totalHargaBarang.value = 0;
  }
}

function updateTotalHargaBarang(elemen, id, harga) {
  var totalHargaBarang = document.querySelector("input#total-harga-barang" + id);
  totalHargaBarang.value = elemen.value * harga;
}

function updatePembayaran() {
  var totalHargaBarangAll = document.getElementsByClassName("selected");
  var pembayaran = 0;

  for (var i = 0; i < totalHargaBarangAll.length; i++) {
    pembayaran += parseInt(totalHargaBarangAll[i].value);
  }

  document.getElementsByClassName("total-pembayaran")[0].innerHTML = pembayaran;
}

function goToPembayaran() {
  var selected = document.querySelectorAll("input[type='checkbox']:checked");
  
  if (selected.length == 0) {
    return false;
  }
  
  var link = "pembayaran.php?";

  for (var i=1; i<=selected.length; i++) {
    link += "id" + i + "=" + selected[i-1].value + "&"
  }

  document.location.href = link;

}
