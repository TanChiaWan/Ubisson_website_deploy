// Get a reference to the canvas element
// Get a reference to the dropdown element
const dropdown = document.getElementById('event_type');

// Add event listener to the dropdown element
dropdown.addEventListener('change', function() {
  // Get the selected value
  const selectedValue = dropdown.value;

  // Update the chart data and labels based on the selected value
  if (selectedValue === 'blood_glucose') {
    myChart.data.datasets[0].data = [12, 19, 3, 5, 2, 3, 15];
    myChart.data.datasets[1].data = [8, 5, 9, 15, 10, 6, 12];
    myChart.options.scales.x.title.text = 'Days';
    myChart.options.scales.y.title.text = 'Number of people';
  } else if (selectedValue === 'blood_pressure') {
    myChart.data.datasets[0].data = [10, 15, 8, 12, 16, 9, 18];
    myChart.data.datasets[1].data = [7, 12, 6, 10, 4, 8, 14];
    myChart.options.scales.x.title.text = 'Days';
    myChart.options.scales.y.title.text = 'Number of people';
  }

  // Update the chart
  myChart.update();
});

const canvas = document.getElementById('myChart');
const ctx = canvas.getContext('2d');

// Define the chart data and options
const chartData = {
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  datasets: [
    {
      label: 'Morning',
      data: [12, 19, 3, 5, 2, 3, 15],
      borderColor: 'rgba(75, 192, 192, 1)',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderWidth: 3,
      fill: false,
      //lineTension: 0.4,
      cubicInterpolationMode: 'monotone'
    },
    {
      label: 'Evening',
      data: [8, 5, 9, 15, 10, 6, 12],
      borderColor: 'rgba(153, 102, 255, 1)',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderWidth: 3,
      fill: false,
      //lineTension: 0.4,
      cubicInterpolationMode: 'monotone'
    },
  ]
};

const chartOptions = {
  scales: {
    x: {
      display: true,
      title: {
        display: true,
        text: 'Days',
        color: '#000000',
        font: {
          size: 16,
          weight: 'bold'
        }
      },
      grid: {
        display: false
      }
    },
    y: {
      display: true,
      title: {
        display: true,
        text: 'Number of people',
        color: '#000000',
        font: {
          size: 16,
          weight: 'bold'
        }
      },
      grid: {
        display: false
      }
    }
  }
};

// Create the chart
const myChart = new Chart(ctx, {
  type: 'line',
  data: chartData,
  options: chartOptions
});