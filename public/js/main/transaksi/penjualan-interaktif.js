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

    editPenjualan.forEach(function (element) {
        element.addEventListener("click", function (event) {
            const url = element.getAttribute('data-url');
            const urlUpdate = element.getAttribute('data-edit');
            recordPenjualan(url)
                .then(function (response) {

                    const form = document.getElementById('edit-update-penjualan');
                    form.action = urlUpdate;

                    // Clear previous data
                    document.getElementById('nama-barang-edit').value = "";
                    document.getElementById('tanggal-penjualan-edit').value = "";
                    document.getElementById('jenis-barang-edit').value = "";
                    document.getElementById('jumlah-barang-edit').value = "";
                    document.getElementById('jenis-pembayarang-edit').value = "";
                    document.getElementById('harga-barang-edit').value = "";
                    document.getElementById('description-penjualan-edit').value = "";
                    document.getElementById('total-penjualan-edit').value = "";

                    // Set values from response.data
                    document.getElementById('nama-barang-edit').value = response.data.nama_barang;
                    document.getElementById('tanggal-penjualan-edit').value = response.data.tanggal_penjualan;
                    document.getElementById('jenis-barang-edit').value = response.data.jenis_barang;
                    document.getElementById('   -barang-edit').value = response.data.jumlah_barang;
                    document.getElementById('jenis-pembayarang-edit').value = response.data.jenis_pembayarang;
                    document.getElementById('harga-barang-edit').value = response.data.harga_barang;
                    document.getElementById('description-penjualan-edit').value = response.data.description;
                    document.getElementById('total-penjualan-edit').value = response.data.total_penjualan;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    });

// piutang get

    const buttonPiutang = document.querySelectorAll('a.btn.btn-info.edit-this-modal-piutang');

    buttonPiutang.forEach(function(element){
        element.addEventListener('click',function(event){
            const url = element.getAttribute('data-url');
            const editForm = element.getAttribute('data-edit');
            const form = document.getElementById('piutang-get');
            document.getElementById('nama-Pelanggan-id-edit').value = '';
            document.getElementById('alamat-piutang-id-edit').value = '';
            document.getElementById('tgl-transaksi-piutang-id-edit').value = '';
            document.getElementById('tgl-jatuh-tempo-piutang-id-edit').value = '';
            document.getElementById('total-pembayaran-id-edit').value = '';
            document.getElementById('total-tagihan-id-edit').value = '';
            document.getElementById('status-pembayaran-id-edit').value = '';
            document.getElementById('sisa-tagihan-id-edit').value = '';
            document.getElementById('description-piutang-id-edit').value = '';
            recordPenjualan(editForm).then(function(response){
                form.action = url;
                const data = response.data;
                document.getElementById('nama-Pelanggan-id-edit').value = data.nama_Pelanggan;
                document.getElementById('alamat-piutang-id-edit').value = data.alamat;
                document.getElementById('tgl-transaksi-piutang-id-edit').value = data.tgl_transaksi_piutang;
                document.getElementById('tgl-jatuh-tempo-piutang-id-edit').value = data.tgl_jatuh_tempo_piutang;
                document.getElementById('total-pembayaran-id-edit').value = data.total_pembayaran;
                document.getElementById('total-tagihan-id-edit').value = data.total_tagihan;
                document.getElementById('status-pembayaran-id-edit').value = data.total_pembayaran;
                document.getElementById('sisa-tagihan-id-edit').value = data.sisa_tagihan;
                document.getElementById('description-piutang-id-edit').value = data.description;
            })
        });
    });

    function recordPenjualan(url) {
        return axios.get(url);
    }

});
