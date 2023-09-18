
document.addEventListener('DOMContentLoaded', function () {
    const qtyPenjualan = document.getElementById('jumlah-barang-id');
    const hargaBarang = document.getElementById('harga-barang-id');
    const totalPembayaran = document.getElementById('total-penjualan-id');

    qtyPenjualan.addEventListener('input', updateTotal);
    hargaBarang.addEventListener('input', updateTotal);

    function updateTotal() {
        const qtyValue = parseFloat(qtyPenjualan.value);
        const hargaValue = parseFloat(hargaBarang.value);

        if (!isNaN(qtyValue) && !isNaN(hargaValue)) {
            totalPembayaran.value = qtyValue * hargaValue;
        } else {
            totalPembayaran.value = '';
        }
    }

    const editPenjualan = document.querySelectorAll('a.edit-this-modal');

    editPenjualan.forEach(function(element) {
        element.addEventListener("click", function(event) {
            const url = element.getAttribute('data-url');
            const urlUpdate = element.getAttribute('data-edit');
            recordPenjualan(url)
            .then(function(response) {
                console.log(response.data);
                const form = document.getElementById('edit-update-penjualan');
                form.action = urlUpdate;
                document.getElementById('nama-barang-edit').value = response.data.nama_barang;
                document.getElementById('tanggal-penjualan-edit').value = response.data.tanggal_penjualan;
                document.getElementById('jenis-barang-edit').value = response.data.jenis_barang;
                document.getElementById('jumlah-barang-edit').value = response.data.jumlah_barang;
                document.getElementById('jenis-pembayarang-edit').value = response.data.jenis_pembayarang;
                document.getElementById('harga-barang-edit').value = response.data.harga_barang;
                document.getElementById('description-penjualan-edit').value = response.data.description;
                document.getElementById('total-penjualan-edit').value = response.data.total_penjualan;
            })
            .catch(function(error) {
                console.error(error);
            });
        });
    })



    function recordPenjualan(url) {
        return axios.get(url);
    }

});
