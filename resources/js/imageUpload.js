function handleImageUpload() {
    var input = document.getElementById('profile-input');
    input.click();
}
  
function previewImage(event) {
    var preview = document.getElementById('profile-picture');
    var file = event.target.files[0];
    var reader = new FileReader();
  
    reader.addEventListener("load", function () {
      preview.style.backgroundImage = "url('" + reader.result + "')";
      // Store the image URL in localStorage
      localStorage.setItem("profilePicture", reader.result);
    }, false);
  
    if (file) {
      reader.readAsDataURL(file);
    }
}