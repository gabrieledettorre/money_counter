<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Contabanconote</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .banconota {
      width: 100%;
      max-width: 400px;
    }
    .quantita-input {
      width: 80px;
      text-align: center;
      font-size: 1.25rem;
    }
    .btn-sm {
      font-size: 1.25rem;
      padding: 0.5rem 1rem;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="m-0">Contabanconote</h1>
      <button class="btn btn-outline-danger" onclick="resetQuantita()">Reset</button>
    </div>

    <div id="contenitore" class="d-flex flex-column align-items-center gap-3"></div>
    <div id="totale" class="mt-4 h4 text-center text-primary"></div>
  </div>

  <script>
    const tagli = [5, 10, 20, 50];

    function creaElemento(taglio, quantita) {
      return `
        <div class="card shadow banconota">
          <div class="card-body text-center">
            <h5 class="mb-3">€ ${taglio}</h5>
            <div class="d-flex justify-content-center align-items-center">
              <button class="btn btn-danger btn-sm me-2" onclick="aggiorna(${taglio}, -1)">–</button>
              <input type="number" class="form-control quantita-input" value="${quantita}" onchange="setQuantita(${taglio}, this.value)">
              <button class="btn btn-success btn-sm ms-2" onclick="aggiorna(${taglio}, 1)">+</button>
            </div>
          </div>
        </div>`;
    }

    function caricaQuantita() {
      fetch('load.php')
        .then(r => r.json())
        .then(data => {
          const contenitore = document.getElementById('contenitore');
          contenitore.innerHTML = '';

          let totale = 0;
          tagli.forEach(taglio => {
            const qta = data[taglio] || 0;
            totale += qta * taglio;
            contenitore.innerHTML += creaElemento(taglio, qta);
          });

          document.getElementById('totale').textContent = `Totale: € ${totale}`;
        });
    }

    function aggiorna(taglio, delta) {
      fetch('update.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `taglio=${taglio}&delta=${delta}`
      }).then(() => caricaQuantita());
    }

    function setQuantita(taglio, valore) {
      const nuovoValore = parseInt(valore) || 0;
      fetch('set.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `taglio=${taglio}&quantita=${nuovoValore}`
      }).then(() => caricaQuantita());
    }

    function resetQuantita() {
      fetch('reset.php')
        .then(() => caricaQuantita());
    }

    caricaQuantita();
  </script>
</body>
</html>
