let nama_barang = document.getElementById('nama_barang').value;

$(document).ready(function () {
    // Handle the click event of the edit button
    $('.edit-this-modal').click(function () {
        // Get the data-url and data-id attributes from the button
        var editUrl = $(this).data('url');
        var itemId = $(this).data('id');

        // Make an AJAX request to fetch the item data by its ID
        $.ajax({
            url: editUrl,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                nama_barang = data.nama_barang; // Assign a new value to nama_barang
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    });
})
