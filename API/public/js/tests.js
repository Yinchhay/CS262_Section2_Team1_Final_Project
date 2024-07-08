// document.addEventListener('DOMContentLoaded', function () {
//     const buttons = document.querySelectorAll('.btn');
//     const yearFilter = document.getElementById('yearFilter');

//     buttons.forEach(button => {
//         button.addEventListener('click', function () {
//             // Reset active state for all buttons
//             buttons.forEach(btn => {
//                 btn.classList.remove('active');
//             });

//             // Set active state for the clicked button
//             this.classList.add('active');

//             // If the clicked button is the year filter dropdown, don't toggle active class
//             if (!this.classList.contains('dropdown-toggle')) {
//                 yearFilter.classList.remove('active');
//             }
//         });
//     });

//     // Close year filter dropdown when a year is selected
//     const yearItems = document.querySelectorAll('.dropdown-item');
//     yearItems.forEach(item => {
//         item.addEventListener('click', function () {
//             yearFilter.classList.remove('show');
//         });
//     });
// });

// Function to update the result
function updateResult(searchText) {
    const resultElement = document.querySelector('.result');
    resultElement.textContent = `${searchText}`;
}

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn');
    const yearFilter = document.getElementById('yearFilter');
    const searchButton = document.getElementById('search-icon');
    const searchInput = document.querySelector('.form-control');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Reset active state for all buttons
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Set active state for the clicked button
            this.classList.add('active');

            // If the clicked button is the year filter dropdown, don't toggle active class
            if (!this.classList.contains('dropdown-toggle')) {
                yearFilter.classList.remove('active');
            }

            // Update result based on the filter
            const filter = this.getAttribute('data-filter');
            if (filter) {
                updateResult(`Filter: ${filter}`);
            }
        });
    });

    // Close year filter dropdown when a year is selected
    const yearItems = document.querySelectorAll('.dropdown-item');
    yearItems.forEach(item => {
        item.addEventListener('click', function () {
            yearFilter.classList.remove('show');

            // Update result based on the selected year
            const selectedYear = this.getAttribute('data-filter');
            if (selectedYear) {
                updateResult(`Year: ${selectedYear}`);
            }
        });
    });

    // searchButton.addEventListener('click', function () {
    //     const searchText = searchInput.value;
    //     updateResult(`${searchText}`);
    // });

    searchInput.addEventListener('input', function () {
        const searchText = this.value;
        updateResult(`${searchText}`);
    });
});
