import Chart from 'chart.js/auto'

(async function() {
  const data = [
    { date: "29-5-2023", before_meal_reading: 5.6, after_meal_reading: 4.6},
    { date: "30-5-2023", before_meal_reading: 5.3, after_meal_reading: 4.5},
    { date: "31-5-2023", before_meal_reading: 5.7, after_meal_reading: 4.8},
    { date: "1-6-2023", before_meal_reading: 6, after_meal_reading: 4.9},
    { date: "2-6-2023", before_meal_reading: 6.8, after_meal_reading: 5},
    { date: "3-6-2023", before_meal_reading: 5.9, after_meal_reading: 5.5},
    { date: "4-6-2023", before_meal_reading: 5.0, after_meal_reading: 5.2},
  ]

  var bg_week_range = "Mon 29-5-2023 -- Sun 4-6-2023"
    

  new Chart(
    document.getElementById('bg_comparison'),
    {
        type: 'line',
        data: {
            labels: data.map(row => row.date),
            backgroundColor: [
                "#D0D9E8",
                "#F6D8D8",
            ],
            datasets: [
                {
                    label: 'Average Before Meal Readings',
                    data: data.map(row => row.before_meal_reading),
                    borderColor: '#3F6AB1',
                    borderWidth: 3
                },
                {
                    label: 'Average After Meal Readings',
                    data: data.map(row => row.after_meal_reading),
                    borderColor: '#36AD4A',
                    borderWidth: 3
                }
            ],
        },
        options: {
          scales: {
              y: { grid: {display: false}, suggestedMin: 3.5, suggestedMax: 7.5},
              x: { grid: {display: false} },
              
          },
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: 'top',
            },
            title: {
                display: true,
                text: "Average Blood Glucose Level",
                font: {
                  size: 24,
                  color: 'black'
                }
            },
            subtitle: {
                display: true,
                text: "Week: " + bg_week_range,
                font: {
                    size: 12
                },
                padding: {
                    bottom: 20
                }
            }
          }
        },
      
    }
  );
})();

