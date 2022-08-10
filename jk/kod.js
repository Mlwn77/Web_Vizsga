function felvitel() {

  var nev = document.querySelector("#nev");
  var marka = document.querySelector("#marka");
  var ar = document.querySelector("#ar");
  var kep = document.querySelector("#kep");
  var termekek = document.querySelector("#termekek");
  const selectedFile = document.getElementsByName('kep')[0];
  const kategoriak = document.querySelectorAll('input[name="kategoria"]');
  var leiras = document.querySelector("#leiras");

  for (const gomb of kategoriak) {
    if (gomb.checked) {
      var valasztottGomb = gomb.value;
      break;
    }
  }

  const kuldFeltolt = new FormData();
  kuldFeltolt.append('akcio', 'beszuras');
  kuldFeltolt.append('nev', nev.value);
  kuldFeltolt.append('marka', marka.value);
  kuldFeltolt.append('ar', ar.value);
  kuldFeltolt.append('kep', kep.value);
  kuldFeltolt.append('kepfile', selectedFile.files[0]);
  kuldFeltolt.append('leiras', leiras.value);
  kuldFeltolt.append('kategoria_id', valasztottGomb);


  fetch('feldolgozas.php', {
      method: 'POST',
      body: kuldFeltolt
    })
    .then(response => response.json());

  nev.value = '';
  marka.value = '';
  ar.value = '';
  kep.value = '';
  leiras.value = '';
  kategoriak.value = '';
}