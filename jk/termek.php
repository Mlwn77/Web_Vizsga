<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Telefonos áruház</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="display-4">Új Termék felvitele</h1>
        <form onsubmit="felvitel()" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nev">Termék neve:</label>
            <input type="text" name="nev" id="nev" placeholder="Ide írja az Termék nevét." required="required" class="form-control">
          </div>
          <div class="form-group">
            <label for="marka">Márka neve:</label>
            <input type="text" name="marka" id="marka" placeholder="Ide írja az Márka nevét." required="required" class="form-control">
          </div>
          <div class="form-group">
            <label class="radio-inline">
              <input type="radio" name="kategoria" value="0">&nbsp;Telefon&nbsp;&nbsp;
            </label>
            <label class="radio-inline">
              <input type="radio" name="kategoria" value="1">&nbsp;Kiegészítő&nbsp;&nbsp;
            </label>
          </div>
          <div class="form-group">
            <label for="ar">Termék ára:</label>
            <input type="text" name="ar" id="ar" placeholder="Ide írja az Termék árát." required="required" class="form-control">
          </div>
          <div class="form-group">
            <label for="kep">Kép beillesztése:</label>
            <input type="file" name="kep" id="kep" class="btn btn-outline-info">
          </div>
          <div class="form-group">
            <label for="leiras">Leírás:</label>
            <input type="text" name="leiras" id="leiras" placeholder="Ide írja az Termék leírását." required="required" class="form-control">
          </div>
          <button type="submit" name="submit" class="btn btn-outline-success">Küldés</button>
          <button type="reset" name="reset" class="btn btn-outline-warning">Torles</button>
          <a href="index.php">Vissza a Főoldalra</a>
        </form>
      </div>
    </div>
  </div>
</body>
  <script src="kod.js"></script>
</html>
