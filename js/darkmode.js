var darkMode = localStorage.getItem('darkMode');
console.log(darkMode);

const enableDarkMode = () => {
    $("body").addClass("darkMode");
    localStorage.setItem('darkMode', 'enable');
}
const disableDarkMode = () => {
    $("body").removeClass("darkMode");
    localStorage.setItem('darkMode', null);
}

if(darkMode === "enable") {
    enableDarkMode();
}

$("#darkModeToggle").click(function () {

    darkMode = localStorage.getItem('darkMode');
    if (darkMode !== 'enable') {
        enableDarkMode();
        console.log(darkMode);
    }
    else {
        disableDarkMode();
        console.log(darkMode);
    }
})