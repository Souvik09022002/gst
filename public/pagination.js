$(document).ready(function() {
    var rowsPerPage = $('.select_row');  // Default number of rows per page
    var rows = $('#tickets-table tbody');
    var totalRows = rows.length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);

    function displayRows(startIndex, endIndex) {
        rows.hide().slice(startIndex, endIndex).show();
    }

    function createPagination() {
        $('#pagination-container').empty(); // Clear existing pagination
        for (var i = 1; i <= totalPages; i++) {
            $('#pagination-container').append('<button class="pagination-btn btn btn-sm btn-outline-secondary" data-page="' + i + '">' + i + '</button>');
        }
    }

    function setupPagination() {
        displayRows(0, rowsPerPage); // Display the first set of rows
        createPagination();

        $('.pagination-btn').on('click', function() {
            var page = $(this).data('page');
            var startIndex = (page - 1) * rowsPerPage;
            var endIndex = startIndex + rowsPerPage;
            displayRows(startIndex, endIndex);
        });
    }

    setupPagination();

    // Change rows per page
    $('select[name="alternative-page-datatable_length"]').on('change', function() {
        rowsPerPage = parseInt($(this).val());
        totalPages = Math.ceil(totalRows / rowsPerPage);
        setupPagination();
    });


    
    
});
