document.addEventListener('DOMContentLoaded', function () {
    const outerPercentage = document.querySelector('.percentage-outer').innerText;
    const innerPercentage = document.querySelector('.percentage-inner').innerText;

    const outerCircle = document.querySelector('.progress-bar-outer');
    const innerCircle = document.querySelector('.progress-bar-inner');

    const outerCircumference = 2 * Math.PI * 110;
    const innerCircumference = 2 * Math.PI * 80;
    console.log(outerCircumference);
    console.log(innerCircumference);

    const setProgress = (circle, percentage, circumference) => {
        const offset = circumference - (percentage / 100) * circumference;
        circle.style.strokeDashoffset = `${offset}px`;
    };

    setProgress(outerCircle, outerPercentage, outerCircumference);
    setProgress(innerCircle, innerPercentage, innerCircumference);
});
