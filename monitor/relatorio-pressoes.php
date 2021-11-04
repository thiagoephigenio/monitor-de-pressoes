<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles/app.css">
    <link rel="stylesheet" href="./styles/relatorio-pressoes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <title>Relatório de Pressões</title>
</head>
<body>
<script>
  async function getData() {
   let dadosRetorno = ""
    await fetch('http://192.168.17.206/pressoes/pressoes.php',
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


   async function atualizaPressoes() {
    let table = `<thead>` +
                  `<tr>` +
                      `<th>Data/Hora</th>`+
                      `<th>DP 101</th>`+
                      `<th>DP 102</th>`+
                      `<th>DP 103</th>`+
                      `<th>DP 104</th>`+
                      `<th>DP 105</th>`+
                      `<th>DP 106</th>`+
                      `<th>DP 107</th>`+
                      `<th>DP 108</th>`+
                  `</tr>` +
                `</thead>` +    
                `<tbody id="content">`;
      getData().then(result => {
        console.log("carrguei")
        result.map(element => {
            
         table +=`<tr>`+
                `<td>${element.data}</td>`+
                `<td>${element.dp_101} kgf/cm2</td>`+
                `<td>${element.dp_102} kgf/cm2</td>`+
                `<td>${element.dp_103} kgf/cm2</td>`+
                `<td>${element.dp_104} kgf/cm2</td>`+
                `<td>${element.dp_105} kgf/cm2</td>`+
                `<td>${element.dp_106} kgf/cm2</td>`+
                `<td>${element.dp_107} kgf/cm2</td>`+
                `<td>${element.dp_108} kgf/cm2</td>`+
            `</tr>`; 
          })
          console.log("finalizei")
        table += `</tbody>`;
        $( ".loading" ).remove();
        $('#table_id').append(table);
        $('#table_id').DataTable({
            "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Nenhum resultado encontrado",
            "info": "Estou na página _PAGE_ de _PAGES_",
            "infoEmpty": "Registros encontrados",
            "infoFiltered": "(0 Registros)",
            "search": "Buscar",        
            "paginate": {
                "previous": 'Anterior',
                "next": 'Próximo'
            } 
        }
        })

      })
    }

    $(document).ready( function () {
        atualizaPressoes();
        
    });
    </script>
    <div class="container">
      <table id="table_id" class="display">
        <div>
          <span class="loading">Carregando Relatório</span>
          <div class="loading">        
            <div class="spinner-border" role="status">        
            <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </div>
      </table>
      <button class="button"><a href="./teste.php">Voltar</a></button>
    </div>

</body>
</html>