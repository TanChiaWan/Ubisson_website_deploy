function updateGlucoseTargets() {
    // Get the updated values from the input fields
    var beforeLower = document.getElementById("before_comsumption_lower_boundary").value;
    var beforeHigher = document.getElementById("before_comsumption_higher_boundary").value;
    var afterLower = document.getElementById("after_comsumption_lower_boundary").value;
    var afterHigher = document.getElementById("after_comsumption_higher_boundary").value;
    var bedtimeLower = document.getElementById("bedtime_lower_boundary").value;
    var bedtimeHigher = document.getElementById("bedtime_higher_boundary").value;
    var hba1c = document.getElementById("hba1c_percentage").value;

    // Store the updated values in localStorage
    localStorage.setItem("beforeLower", beforeLower);
    localStorage.setItem("beforeHigher", beforeHigher);
    localStorage.setItem("afterLower", afterLower);
    localStorage.setItem("afterHigher", afterHigher);
    localStorage.setItem("bedtimeLower", bedtimeLower);
    localStorage.setItem("bedtimeHigher", bedtimeHigher);
    localStorage.setItem("hba1c", hba1c);

    // Redirect back to MyAboutPatient.html to display the updated values
    location.href = "/aboutpatient/{patient.patient_id}";
}