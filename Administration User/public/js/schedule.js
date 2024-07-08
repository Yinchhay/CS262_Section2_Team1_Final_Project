document.addEventListener('DOMContentLoaded', function () {
    var rows = document.querySelectorAll('.table tbody tr');
    rows.forEach(function (row) {
        row.addEventListener('click', function () {
            var href = this.getAttribute('data-href');
            if (href) {
                window.location.href = href;
            }
        });
    });
});
