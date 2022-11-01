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

function totalHarga() {
  var harga = document.getElementsByClassName("harga");
  
}



