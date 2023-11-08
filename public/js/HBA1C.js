import Chart from 'chart.js/auto'

(async function() {
  const data = [
    { date: "Previous (1-3-2023)", count: 5.6 },
    { date: "Current (1-6-2023)", count: 5 },
  ];

  new Chart(
    document.getElementById('hba1c'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.date),
        datasets: [
          {
            label: '',
            data: data.map(row => row.count),
            backgroundColor: "#7ECBCC",
            hoverBorderWidth: 2,
          }
        ],
      },
      options: {
        scales: {
          y: { grid: {display: false}, max: 14.0},
          x: {grid: {display: false}},
        },
        plugins: {
          title: {display: true, text: "HBA1C", font: {size: 24, color: 'black'}},
          legend: {
            display: false
          },  
        },
        responsive: true,
      },
      
    }
  );
})();

