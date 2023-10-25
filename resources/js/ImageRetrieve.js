var profilePictureUrl = localStorage.getItem("profilePicture");

if (profilePictureUrl) {
  var profilePictureElement = document.getElementById("profile-picture");
  profilePictureElement.style.backgroundImage = "url('" + profilePictureUrl + "')";
}