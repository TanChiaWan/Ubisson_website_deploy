document.addEventListener("DOMContentLoaded", function() {
    // Retrieve the stored values from localStorage
    var minCarbs = localStorage.getItem("minCarbs");
    var maxCarbs = localStorage.getItem("maxCarbs");
    var minWeight = localStorage.getItem("minWeight");
    var maxWeight = localStorage.getItem("maxWeight");
    var minBMI = localStorage.getItem("minBMI");
    var maxBMI = localStorage.getItem("maxBMI");
    var totalActivity = localStorage.getItem("totalActivity");

    // Update the displayed values in MyAboutPatient.html
    document.getElementById("carbs_range").textContent = minCarbs + " - " + maxCarbs + " g";
    document.getElementById("weight_range").textContent = minWeight + " - " + maxWeight + " kg";
    document.getElementById("bmi_range").textContent = minBMI + " - " + maxBMI + " kg/m2";
    document.getElementById("activity_range").textContent = totalActivity + " min";
});