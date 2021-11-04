<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/app.css">
  <link rel="stylesheet" href="./styles/teste.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <title>Monitor de Pressões</title>
</head>
<body>
  <script>

  async function getData() {
   let dadosRetorno = ""
    await fetch('http://192.168.17.206/pressoes',
      {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
        }
      })
      .then(response => response.json())
      .then(json => {
        dadosRetorno = json
      })
      return dadosRetorno;
  }

  function monitoraPressoesDeAlarme(pressoes) {
    Object.keys(pressoes).map((key) => {
      if (key == "dp_103") {
        pressoes[key] >= 5.00 ? 
          $("#pressao_dp_103").addClass("alert"): $( "#pressao_dp_103").removeClass("alert")  
          // $(".card-footer").prepend('<img src="./public/img/alarme.png" alt="">');
      } else if(key != "data") {
        pressoes[key] >= 10.00 ? 
          $(`#pressao_${key}`).addClass("alert") : $(`#pressao_${key}`).removeClass("alert")  
      }
    });
  }

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function atualizaPressoes() {
    while(true) {
      getData().then(result => {
      monitoraPressoesDeAlarme(result);

      $("#datetime").text(`${result.data}`);
      $("#pressao_dp_101").text(`${result.dp_101} kgf/cm2`);
      $("#pressao_dp_102").text(`${result.dp_102} kgf/cm2`);
      $("#pressao_dp_103").text(`${result.dp_103} kgf/cm2`);
      $("#pressao_dp_104").text(`${result.dp_104} kgf/cm2`);
      $("#pressao_dp_105").text(`${result.dp_105} kgf/cm2`);
      $("#pressao_dp_106").text(`${result.dp_106} kgf/cm2`);
      $("#pressao_dp_107").text(`${result.dp_107} kgf/cm2`);
      $("#pressao_dp_108").text(`${result.dp_108} kgf/cm2`);
    })

    await sleep(5000);

    }
  }
  atualizaPressoes();

  </script>

  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card-deck">
          <?php for ($i = 101; $i < 109; $i++) {?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">DP <?=$i?></h5>
              </div>
              <img class="card-img-top" src="./public/img/bomba.png" alt="Imagem de capa do card">

              <div class="card-footer">
                <!-- <img src="./public/img/alarme.png" alt=""> -->
                <small class="text-footer" id="pressao_dp_<?=$i?>">
                  <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </small>
              </div>
            </div>
          <?php }?>
        </div>
      </div>
      <div class="col-md-2">
      <div class="card-alert" style="max-width: 18rem;">
        <div class="alert"><h2>Pressões de alarmes</h2></div>
        <div class="line"></div>
          <ul>
            <li>DP 101 - 10 BAR</li>
            <li>DP 102 - 10 BAR</li>
            <li>DP 103 - 05 BAR</li>
            <li>DP 104 - 10 BAR</li>
            <li>DP 105 - 10 BAR</li>
            <li>DP 106 - 10 BAR</li>
            <li>DP 107 - 10 BAR</li>
            <li>DP 108 - 10 BAR</li>
          </ul>
        </div>
        <button class="button"><a href="./relatorio-pressoes.php">Histórico de Pressões</a></button>
      </div>
    </div>
      <div class="refresh-time">Última atualização em <span id="datetime"></span></div>
    </div>
  </div>
  <div class="footer"><img src="./public/img/logo.png" alt=""></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
