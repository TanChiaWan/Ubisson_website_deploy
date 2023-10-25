function updateTargetRange() {
    // Get the updated values from the input fields
    var minCarbs = document.getElementById("min_carbs").value;
    var maxCarbs = document.getElementById("max_carbs").value;
    var minWeight = document.getElementById("min_weight").value;
    var maxWeight = document.getElementById("max_weight").value;
    var minBMI = document.getElementById("min_bmi").value;
    var maxBMI = document.getElementById("max_bmi").value;
    var totalActivity = document.getElementById("total_activity_minutes").value;

    // Store the updated values in localStorage
    localStorage.setItem("minCarbs", minCarbs);
    localStorage.setItem("maxCarbs", maxCarbs);
    localStorage.setItem("minWeight", minWeight);
    localStorage.setItem("maxWeight", maxWeight);
    localStorage.setItem("minBMI", minBMI);
    localStorage.setItem("maxBMI", maxBMI);
    localStorage.setItem("totalActivity", totalActivity);

    // Reload MyAboutPatient.html to display the updated values
    location.href = "/aboutpatient/{patient.patient_id}";
}