const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const user_name = urlParams.get('user_name');
const gender = urlParams.get('gender');
const user_phone = urlParams.get('user_phone');
const organization = urlParams.get('organization');
const uName = urlParams.get('uName');
const user_email = urlParams.get('user_email');
const profession = urlParams.get('profession');

// Do something with the data
console.log(`Name: ${user_name}, Gender: ${gender}, Phone Number: ${user_phone}, Organization: ${organization}, Username: ${uName}, E-mail: ${user_email}, Profession: ${profession}`);