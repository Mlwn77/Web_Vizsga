function mindenAdat() {
  var termekek = document.querySelector("#termekek");
  fetch('termekek_lekerdez.php?kategoria=' + kategoria)
    .then(response => response.json())
    .then(data => {
      feldolgozas(data, termekek);
    });
}

function feldolgozas(data, termekek) {
  var tartalom = "";
  for (var i = 0; i < data.lista.length; i++) {
    tartalom += '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">';
    tartalom += '<div class="thumbnail text-center">';
    tartalom += '<img src="kepek/' + (data.lista[i].kep.length != 0 ? data.lista[i].kep : 'nincs.png') +
      '" width="200px">';
    tartalom += '<p>' + data.lista[i].nev + '<br>' + data.lista[i].marka + '<br>' + data.lista[i].ar + 'FT<br>' + data.lista[i].leiras + '</p>';
    tartalom += '</div></div>'
  }
  termekek.innerHTML = tartalom;
}

mindenAdat();