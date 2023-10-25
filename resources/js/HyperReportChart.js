document.addEventListener('DOMContentLoaded', function() {
  var ctx = document.getElementById('myChart').getContext('2d');

  var bgLevels = @json($bgLevels);
  var period = @json($period);
  var bgLogbookDate = @json($bg_logbook_date);
  var criteria1 = @json($criteria1);
  var criteria2 = @json($criteria2);

  var chartData = {
      labels: bgLogbookDate, // Use the logbook dates as labels
      datasets: [{
          label: 'Blood Glucose Value',
          data: bgLevels,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
      }, {
          label: 'Criteria 1',
          data: Array(bgLevels.length).fill(criteria1),
          borderColor: 'rgba(0, 0, 0, 0.5)',
          borderWidth: 1,
          borderDash: [5, 5],
          fill: false,
          pointRadius: 0,
          showLine: true
      }, {
          label: 'Criteria 2',
          data: Array(bgLevels.length).fill(criteria2),
          borderColor: 'rgba(0, 0, 0, 0.5)',
          borderWidth: 1,
          borderDash: [5, 5],
          fill: false,
          pointRadius: 0,
          showLine: true
      }]
  };

  var chartOptions = {
      scales: {
          xAxes: [{
              scaleLabel: {
                  display: true,
                  labelString: 'Logbook Date'
              }
          }],
          yAxes: [{
              scaleLabel: {
                  display: true,
                  labelString: 'Value'
              },
              ticks: {
                  min: 0,
                  max: 20,
              }
          }]
      }
  };

  var myChart = new Chart(ctx, {
      type: 'line',
      data: chartData,
      options: chartOptions
  });
});