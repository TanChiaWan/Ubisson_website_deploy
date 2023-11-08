// Get a reference to the canvas element
var ctx = document.getElementById('myChart').getContext('2d');

// Define the chart data and options
var chartData = {
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  datasets: [{
    label: 'Morning',
    data: [12, 19, 3, 5, 2, 3, 15],
    borderColor: 'rgba(255, 99, 132, 1)',
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderWidth: 1,
    type: 'line' // Use line chart type
  }, {
    label: 'Evening',
    data: [8, 5, 9, 15, 10, 6, 12],
    backgroundColor: 'rgba(54, 162, 235, 0.8)',
    borderColor: 'rgba(54, 162, 235, 1)',
    type: 'bar' // Use bar chart type
  }]
};

var chartOptions = {
    scales: {
      xAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Days'
        }
      }],
      yAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Blood Glucose Value'
        }
      }]
    }
};

// Create the mixed chart
var myChart = new Chart(ctx, {
  type: 'bar', // Set the default chart type as bar
  data: chartData,
  options: chartOptions
});