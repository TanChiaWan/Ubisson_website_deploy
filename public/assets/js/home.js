
function handleEditPeriod(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "none";
    document.getElementById(`${tableId}-period_edit`).style.display = "block";

}

function saveEditPeriod(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "block";
    document.getElementById(`${tableId}-period_edit`).style.display = "none";
    const periodSelected = document.getElementById(`${tableId}-period_select`).value;
   
    document.getElementById(`${tableId}-period_text`).textContent = periodSelected;
}

function filterEntriesByDates(tableId) {
    const selectedDate = document.getElementById(`${tableId}-period_select`).value;
    const dateElements = document.querySelectorAll(`.${tableId}-bp-logbook-date`);
    let count = 0; // Initialize a count variable to zero

dateElements.forEach(dateElement => {
 
const formattedDate = dateElement.textContent;



if (selectedDate === "Today") {
// Compare with today's date
const today = new Date();
const todayYear = today.getFullYear();
const todayMonth = (today.getMonth() + 1).toString().padStart(2, '0');
const todayDay = today.getDate().toString().padStart(2, '0');
const todayFormat = `${todayYear}/${todayMonth}/${todayDay}`;

if (formattedDate === todayFormat) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Yesterday") {
// Compare with yesterday's date
const yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
const yesterdayYear = yesterday.getFullYear();
const yesterdayMonth = (yesterday.getMonth() + 1).toString().padStart(2, '0');
const yesterdayDay = yesterday.getDate().toString().padStart(2, '0');
const yesterdayFormat = `${yesterdayYear}/${yesterdayMonth}/${yesterdayDay}`;
if (formattedDate === yesterdayFormat) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}


} else if (selectedDate === "Since 3 days") {
// Compare with date range, e.g., 3 days ago
const threeDaysAgo = new Date();
threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);

// Get the year, month, and day components
const year = threeDaysAgo.getFullYear();
const month = (threeDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day = threeDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDates = `${year}/${month}/${day}`;

console.log(formattedDates);
if (formattedDate >= formattedDates) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 7 days") {
// Compare with date range, e.g., 7 days ago
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

// Get the year, month, and day components
const year2 = sevenDaysAgo.getFullYear();
const month2 = (sevenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day2 = sevenDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDate2 = `${year2}/${month2}/${day2}`;

if (formattedDate >= formattedDate2) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 14 days") {
// Compare with date range, e.g., 14 days ago
const fourteenDaysAgo = new Date();
fourteenDaysAgo.setDate(fourteenDaysAgo.getDate() - 14);
const yearss = fourteenDaysAgo.getFullYear();
const monthss = (fourteenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const dayss = fourteenDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate4 = `${yearss}/${monthss}/${dayss}`;
if (formattedDate >= formattedDate4) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 30 days") {
// Compare with date range, e.g., 30 days ago
const thirtyDaysAgo = new Date();
thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

// Get the year, month, and day components
const years = thirtyDaysAgo.getFullYear();
const months = (thirtyDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const days = thirtyDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate3 = `${years}/${months}/${days}`;
if (formattedDate >= formattedDate3) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
}
});
const filteredCountElement = document.getElementById('filtered-count1');
if (filteredCountElement ) {
    filteredCountElement.textContent = count;
}
}






function handleEditPeriod2(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "none";
    document.getElementById(`${tableId}-period_edit`).style.display = "block";

}

function saveEditPeriod2(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "block";
    document.getElementById(`${tableId}-period_edit`).style.display = "none";
    const periodSelected = document.getElementById(`${tableId}-period_select`).value;
   
    document.getElementById(`${tableId}-period_text`).textContent = periodSelected;
}

function filterEntriesByDates2(tableId) {
    const selectedDate = document.getElementById(`${tableId}-period_select`).value;
    const dateElements = document.querySelectorAll(`.${tableId}-bp-logbook-date`);
    let count = 0; // Initialize a count variable to zero

dateElements.forEach(dateElement => {
 
const formattedDate = dateElement.textContent;



if (selectedDate === "Today") {
// Compare with today's date
const today = new Date();
const todayYear = today.getFullYear();
const todayMonth = (today.getMonth() + 1).toString().padStart(2, '0');
const todayDay = today.getDate().toString().padStart(2, '0');
const todayFormat = `${todayYear}/${todayMonth}/${todayDay}`;

if (formattedDate === todayFormat) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Yesterday") {
// Compare with yesterday's date
const yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
const yesterdayYear = yesterday.getFullYear();
const yesterdayMonth = (yesterday.getMonth() + 1).toString().padStart(2, '0');
const yesterdayDay = yesterday.getDate().toString().padStart(2, '0');
const yesterdayFormat = `${yesterdayYear}/${yesterdayMonth}/${yesterdayDay}`;
if (formattedDate === yesterdayFormat) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}


} else if (selectedDate === "Since 3 days") {
// Compare with date range, e.g., 3 days ago
const threeDaysAgo = new Date();
threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);

// Get the year, month, and day components
const year = threeDaysAgo.getFullYear();
const month = (threeDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day = threeDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDates = `${year}/${month}/${day}`;

if (formattedDate >= formattedDates) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 7 days") {
// Compare with date range, e.g., 7 days ago
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

// Get the year, month, and day components
const year2 = sevenDaysAgo.getFullYear();
const month2 = (sevenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day2 = sevenDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDate2 = `${year2}/${month2}/${day2}`;

if (formattedDate >= formattedDate2) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 14 days") {
// Compare with date range, e.g., 14 days ago
const fourteenDaysAgo = new Date();
fourteenDaysAgo.setDate(fourteenDaysAgo.getDate() - 14);
const yearss = fourteenDaysAgo.getFullYear();
const monthss = (fourteenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const dayss = fourteenDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate4 = `${yearss}/${monthss}/${dayss}`;
if (formattedDate >= formattedDate4) {
dateElement.closest("tr").style.display = "table-row";
count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 30 days") {
// Compare with date range, e.g., 30 days ago
const thirtyDaysAgo = new Date();
thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

// Get the year, month, and day components
const years = thirtyDaysAgo.getFullYear();
const months = (thirtyDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const days = thirtyDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate3 = `${years}/${months}/${days}`;
if (formattedDate >= formattedDate3) {
dateElement.closest("tr").style.display = "table-row";

count++; // Increment the count
} else {
dateElement.closest("tr").style.display = "none";
}
}
});
const filteredCountElement = document.getElementById('filtered-count2');
if (filteredCountElement) {
    filteredCountElement.textContent = count;
}
}






function handleEditPeriod3(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "none";
    document.getElementById(`${tableId}-period_edit`).style.display = "block";

}

function saveEditPeriod3(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "block";
    document.getElementById(`${tableId}-period_edit`).style.display = "none";
    const periodSelected = document.getElementById(`${tableId}-period_select`).value;
   
    document.getElementById(`${tableId}-period_text`).textContent = periodSelected;
}

function filterEntriesByDates3(tableId) {
    const selectedDate = document.getElementById(`${tableId}-period_select`).value;
    const dateElements = document.querySelectorAll(`.${tableId}-bp-logbook-date`);
    let count = 0; // Initialize a count variable to zero

dateElements.forEach(dateElement => {
 
const formattedDate = dateElement.textContent;



if (selectedDate === "Today") {
// Compare with today's date
const today = new Date();
const todayYear = today.getFullYear();
const todayMonth = (today.getMonth() + 1).toString().padStart(2, '0');
const todayDay = today.getDate().toString().padStart(2, '0');
const todayFormat = `${todayYear}/${todayMonth}/${todayDay}`;

if (formattedDate === todayFormat) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Yesterday") {
// Compare with yesterday's date
const yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
const yesterdayYear = yesterday.getFullYear();
const yesterdayMonth = (yesterday.getMonth() + 1).toString().padStart(2, '0');
const yesterdayDay = yesterday.getDate().toString().padStart(2, '0');
const yesterdayFormat = `${yesterdayYear}/${yesterdayMonth}/${yesterdayDay}`;
if (formattedDate === yesterdayFormat) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}


} else if (selectedDate === "Since 3 days") {
// Compare with date range, e.g., 3 days ago
const threeDaysAgo = new Date();
threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);

// Get the year, month, and day components
const year = threeDaysAgo.getFullYear();
const month = (threeDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day = threeDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDates = `${year}/${month}/${day}`;

if (formattedDate >= formattedDates) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 7 days") {
// Compare with date range, e.g., 7 days ago
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

// Get the year, month, and day components
const year2 = sevenDaysAgo.getFullYear();
const month2 = (sevenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day2 = sevenDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDate2 = `${year2}/${month2}/${day2}`;

if (formattedDate >= formattedDate2) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 14 days") {
// Compare with date range, e.g., 14 days ago
const fourteenDaysAgo = new Date();
fourteenDaysAgo.setDate(fourteenDaysAgo.getDate() - 14);
const yearss = fourteenDaysAgo.getFullYear();
const monthss = (fourteenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const dayss = fourteenDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate4 = `${yearss}/${monthss}/${dayss}`;
if (formattedDate >= formattedDate4) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 30 days") {
// Compare with date range, e.g., 30 days ago
const thirtyDaysAgo = new Date();
thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

// Get the year, month, and day components
const years = thirtyDaysAgo.getFullYear();
const months = (thirtyDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const days = thirtyDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate3 = `${years}/${months}/${days}`;
if (formattedDate >= formattedDate3) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
}
});
const filteredCountElement = document.getElementById('filtered-count3');
if (filteredCountElement ) {
    filteredCountElement.textContent = count;
}
}






function handleEditPeriod4(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "none";
    document.getElementById(`${tableId}-period_edit`).style.display = "block";

}

function saveEditPeriod4(tableId) {
    document.getElementById(`${tableId}-period_info`).style.display = "block";
    document.getElementById(`${tableId}-period_edit`).style.display = "none";
    const periodSelected = document.getElementById(`${tableId}-period_select`).value;
   
    document.getElementById(`${tableId}-period_text`).textContent = periodSelected;
}

function filterEntriesByDates4(tableId) {
    const selectedDate = document.getElementById(`${tableId}-period_select`).value;
    const dateElements = document.querySelectorAll(`.${tableId}-bp-logbook-date`);
    let count = 0; // Initialize a count variable to zero

dateElements.forEach(dateElement => {
 
const formattedDate = dateElement.textContent;



if (selectedDate === "Today") {
// Compare with today's date
const today = new Date();
const todayYear = today.getFullYear();
const todayMonth = (today.getMonth() + 1).toString().padStart(2, '0');
const todayDay = today.getDate().toString().padStart(2, '0');
const todayFormat = `${todayYear}/${todayMonth}/${todayDay}`;

if (formattedDate === todayFormat) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Yesterday") {
// Compare with yesterday's date
const yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
const yesterdayYear = yesterday.getFullYear();
const yesterdayMonth = (yesterday.getMonth() + 1).toString().padStart(2, '0');
const yesterdayDay = yesterday.getDate().toString().padStart(2, '0');
const yesterdayFormat = `${yesterdayYear}/${yesterdayMonth}/${yesterdayDay}`;
if (formattedDate === yesterdayFormat) {
dateElement.closest("tr").style.display = "table-row";
} else {
dateElement.closest("tr").style.display = "none";
}


} else if (selectedDate === "Since 3 days") {
// Compare with date range, e.g., 3 days ago
const threeDaysAgo = new Date();
threeDaysAgo.setDate(threeDaysAgo.getDate() - 3);

// Get the year, month, and day components
const year = threeDaysAgo.getFullYear();
const month = (threeDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day = threeDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDates = `${year}/${month}/${day}`;

console.log(formattedDates);
if (formattedDate >= formattedDates) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 7 days") {
// Compare with date range, e.g., 7 days ago
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

// Get the year, month, and day components
const year2 = sevenDaysAgo.getFullYear();
const month2 = (sevenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const day2 = sevenDaysAgo.getDate().toString().padStart(2, '0');

// Format the date in Y-m-d format
const formattedDate2 = `${year2}/${month2}/${day2}`;

if (formattedDate >= formattedDate2) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 14 days") {
// Compare with date range, e.g., 14 days ago
const fourteenDaysAgo = new Date();
fourteenDaysAgo.setDate(fourteenDaysAgo.getDate() - 14);
const yearss = fourteenDaysAgo.getFullYear();
const monthss = (fourteenDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const dayss = fourteenDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate4 = `${yearss}/${monthss}/${dayss}`;
if (formattedDate >= formattedDate4) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
} else if (selectedDate === "Since 30 days") {
// Compare with date range, e.g., 30 days ago
const thirtyDaysAgo = new Date();
thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

// Get the year, month, and day components
const years = thirtyDaysAgo.getFullYear();
const months = (thirtyDaysAgo.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 to month because months are zero-based
const days = thirtyDaysAgo.getDate().toString().padStart(2, '0');
const formattedDate3 = `${years}/${months}/${days}`;
if (formattedDate >= formattedDate3) {
dateElement.closest("tr").style.display = "table-row";
count ++;
} else {
dateElement.closest("tr").style.display = "none";
}
}
});
const filteredCountElement = document.getElementById('filtered-count4');
if (filteredCountElement ) {
    filteredCountElement.textContent = count;
}
}

document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.clickable-row');

    rows.forEach(row => {
        row.addEventListener('click', function () {
            row.style.backgroundColor = 'lightgray'; // Change the background color
            // You can add more changes here, e.g., change text color or any other style you want.
        });
    });
});



