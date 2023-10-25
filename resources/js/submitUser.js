function submitData() {
    const user_name = document.getElementById('user_name').value;
    const gender = document.getElementById('gender').value;

    const user_phone = document.getElementById('user_phone').value;
    const organization = document.getElementById('organization').value;
    const uName = document.getElementById('uName').value;
    const user_email = document.getElementById('user_email').value;
    const profession = document.getElementById('profession').value;

    const queryString = `user_name=${user_name}&gender=${gender}&user_phone=${user_phone}&organization=${organization}&uName=${uName}&user_email=${user_email}&profession=${profession}`;

    // Redirect to myuser.html with query string
    window.location.href = `myuser.html?${queryString}`;
}