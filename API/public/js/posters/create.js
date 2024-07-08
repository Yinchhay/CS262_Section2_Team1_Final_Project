function updateAllElementsByClassName(className, value) {
    const elements = document.querySelectorAll(`.${className}`);
    elements.forEach(element => {
        element.textContent = value;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const level = document.getElementById('level');
    const year = document.getElementById('year');
    const month = document.getElementById('month');

    function updateResult() {
        updateAllElementsByClassName('l', level.options[level.selectedIndex].text);
        updateAllElementsByClassName('y', year.value);
        updateAllElementsByClassName('m', month.options[month.selectedIndex].text);
    }

    level.addEventListener('change', updateResult);
    year.addEventListener('input', updateResult);
    month.addEventListener('change', updateResult);
});
