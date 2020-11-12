var ctxDesktop = document.getElementById('myChartDesktop');
var ctxMobile = document.getElementById('myChartMobile');
var myChart = new Chart(ctxDesktop, {
    type: 'line',
    data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'Task Minggu Ini',
            data: [12, 19, 3, 5, 2, 3,10],
            borderColor:'#2F94C3',
            borderWidth:3,
            backgroundColor:'#2F94C333',
            pointBackgroundColor:'#2F94C3',
            pointHoverBackgroundColor:'rgba(0, 0, 0, 0.1)',
            pointHoverRadius:6,
            pointHoverBorderWidth:3
        }],
    },
    options: {
        legend:{
          display:false
        },
        tooltips: {
            mode: 'point'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontColor:'#666',
                    fontSize:16,
                    fontStyle:'bold',
                    padding:20
                },
                gridLines:{
                    zeroLineWidth:2,
                    drawBorder: false,
                    color: '#F2F2F2'
                },
            }],
            xAxes:[{
              gridLines:{
                  display: false
              },
              ticks: {
                  beginAtZero: true,
                  fontColor:'#666',
                  fontSize:16,
                  fontStyle:'bold'
              },
            }]
        }
    }
});
var myChart = new Chart(ctxMobile, {
    type: 'line',
    data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'Task Minggu Ini',
            data: [12, 19, 3, 5, 2, 3,10],
            borderColor:'#2F94C3',
            borderWidth:3,
            backgroundColor:'#2F94C333',
            pointBackgroundColor:'#2F94C3',
            pointHoverBackgroundColor:'rgba(0, 0, 0, 0.1)',
            pointHoverRadius:6,
            pointHoverBorderWidth:3
        }],
    },
    options: {
        legend:{
          display:false
        },
        tooltips: {
            mode: 'point'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontColor:'#666',
                    fontSize:16,
                    fontStyle:'bold',
                    padding:20
                },
                gridLines:{
                    zeroLineWidth:2,
                    drawBorder: false,
                    color: '#F2F2F2'
                },
            }],
            xAxes:[{
              gridLines:{
                  display: false
              },
              ticks: {
                  beginAtZero: true,
                  fontColor:'#666',
                  fontSize:16,
                  fontStyle:'bold'
              },
            }]
        }
    }
});
