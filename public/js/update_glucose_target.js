document.addEventListener("DOMContentLoaded", function() {
    // Retrieve the stored values from localStorage
    var beforeLower = localStorage.getItem("beforeLower");
    var beforeHigher = localStorage.getItem("beforeHigher");
    var afterLower = localStorage.getItem("afterLower");
    var afterHigher = localStorage.getItem("afterHigher");
    var bedtimeLower = localStorage.getItem("bedtimeLower");
    var bedtimeHigher = localStorage.getItem("bedtimeHigher");
    var hba1c = localStorage.getItem("hba1c");

    // Update the displayed values in MyAboutPatient.html
    document.getElementById("before_comsumption_range").textContent = beforeLower + " - " + beforeHigher + " mmol";
    document.getElementById("after_comsumption_range").textContent = afterLower + " - " + afterHigher + " mmol";
    document.getElementById("bedtime_range").textContent = bedtimeLower + " - " + bedtimeHigher + " mmol";
    document.getElementById("hba1c_percentage").textContent = hba1c + " %";
});