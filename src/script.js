const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toogle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toogle-switch"),
      modeText = body.querySelector(".mode-text");

      toggle.addEventListener("click", () => {
       sidebar.classList.toggle("close");
    });

      searchBtn.addEventListener("click", () => {
       sidebar.classList.remove("close");
    });

    
    modeSwitch.addEventListener("click", () => {
       body.classList.toggle("dark");

      if(body.classList.contains("dark")){
         modeText.innerText = "Ligth Mode"
     }else{
         modeText.innerText = "Dark Mode"
     }
    });

    
document.addEventListener('DOMContentLoaded', function() {
    const tabela = document.getElementById('recent-orders'); 
    const linhas = tabela.getElementsByTagName('tr');
    const indiceColunaStatus = 3; 
    const contagemStatus = {
        'concluído': 0, 
        'cancelado': 0,
        'em andamento': 0,
    };
    let totalLinhas = 0;

    // Loop para contar as ocorrências de cada status
    for (let i = 1; i < linhas.length; i++) { 
        const celulas = linhas[i].getElementsByTagName('td');
        if (celulas.length > indiceColunaStatus) {
            const statusTexto = celulas[indiceColunaStatus].textContent.trim().toLowerCase();

            if (statusTexto === 'concluido' || statusTexto === 'concluído') {
                contagemStatus['concluído']++;
            } else if (statusTexto === 'cancelado') {
                contagemStatus['cancelado']++;
            } else if (statusTexto === 'em andamento') { 
                contagemStatus['em andamento']++; 
            }        
            totalLinhas++;
        }
    }    
    const porcentagensParaGrafico = [];

   
    const labelsDoGrafico = ["Concluído", "Cancelado", "Em Andamento"];

    labelsDoGrafico.forEach(label => {
        const statusChave = label.toLowerCase(); 
        const contagem = contagemStatus[statusChave] || 0; 
        const porcentagem = totalLinhas > 0 ? (contagem / totalLinhas) * 100 : 0;
        porcentagensParaGrafico.push(parseFloat(porcentagem.toFixed(2))); 
    });    

     const chartdata = {
        labels: labelsDoGrafico, 
        data: porcentagensParaGrafico, 
    };

    console.log(porcentagensParaGrafico);

 const myChart = document.querySelector(".my-chart");
 const ul = document.querySelector(".programin-stats .detalhes ul");

 new Chart(myChart, {
      type: "doughnut",
      data:{
         labels: chartdata.labels,
         datasets:[
            {
               label:"status da ordem de serviço",
               data:chartdata.data,
            },
         ],
      },
      options:{         
         borderRadius: 5,
         plugins:{
            legend:{
               display: false,
            },
         },
      },
 });


    
});




// Muda a cor dos status na tabela do index
$(document).ready(function() {
    const indiceColunaStatus = 3;

    $('#recent-orders tbody tr').each(function() { 
        const statusCelula = $(this).find('td').eq(indiceColunaStatus);
        const statusTexto = statusCelula.text().trim().toLowerCase();

        if (statusTexto === 'concluido' || statusTexto === 'concluído') {
            statusCelula.addClass('status-concluido');
        }else if (statusTexto === 'em andamento') {
            statusCelula.addClass('status-em_andamento');
        }else if (statusTexto === 'cancelado') {
            statusCelula.addClass('status-cancelado');
        }
    });
});

// calcula as porcentagens dos status 
$(document).ready(function() {
    const indiceColunaStatus = 3; 
    const contagemStatus = {};
    let totalLinhas = 0;

    $('#recent-orders  tbody tr').each(function() { 
        const statusCelula = $(this).find('td').eq(indiceColunaStatus);
        const statusTexto = statusCelula.text().trim().toLowerCase();
        
        let statusNormalizado = statusTexto;
        if (statusTexto === 'concluido' || statusTexto === 'concluído') {
            statusNormalizado = 'concluído';
        } else if (statusTexto === 'em andamento') {
            statusNormalizado = 'em andamento';
        } else if (statusTexto === 'cancelado') {
            statusNormalizado = 'cancelado';
        }      

        contagemStatus[statusNormalizado] = (contagemStatus[statusNormalizado] || 0) + 1;
        totalLinhas++;
    });

    // Calcula as porcentagens e exibe
    let htmlResultados = '<ul>';
    for (const status in contagemStatus) {
        if (contagemStatus.hasOwnProperty(status)) {
            const contagem = contagemStatus[status];
            const porcentagem = (contagem / totalLinhas) * 100;
            htmlResultados += `<li><strong>${status.charAt(0).toUpperCase() + status.slice(1)}:</strong><span class="porcentagem"> ${porcentagem.toFixed(2)}%</span></li>`;
        }
    }
    htmlResultados += '</ul>';

    $('#resultadosPorcentagem').html(htmlResultados); // Div para exibir os resultados
});



    