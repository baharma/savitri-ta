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
            const form = document.getElementById('edit-update-penjualan');
            const inputFields = {
                'nama-barang-edit': 'nama_barang',
                'tanggal-penjualan-edit': 'tanggal_penjualan',

                'jumlah-barang-edit': 'jumlah_barang',
                'jenis-pembayarang-edit': 'jenis_pembayarang',
                'harga-barang-edit': 'harga_barang',
                'description-penjualan-edit': 'description',
                'total-penjualan-edit': 'total_penjualan'
            };
            recordPenjualan(url)
                .then(function (response) {
                    form.action = urlUpdate;

                    for (const key in inputFields) {
                        document.getElementById(key).value = "";
                    }


                    for (const key in inputFields) {
                        document.getElementById(key).value = response.data[inputFields[key]];
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    });


// piutang get

const buttonPiutang = document.querySelectorAll('a.btn.btn-info.edit-this-modal-piutang');
const formElements = {
    'nama-Pelanggan-id-edit': 'nama_Pelanggan',
    'alamat-piutang-id-edit': 'alamat',
    'tgl-transaksi-piutang-id-edit': 'tgl_transaksi_piutang',
    'tgl-jatuh-tempo-piutang-id-edit': 'tgl_jatuh_tempo_piutang',
    'total-pembayaran-id-edit': 'total_pembayaran',
    'total-tagihan-id-edit': 'total_tagihan',
    'status-pembayaran-id-edit': 'status_pembayaran',
    'sisa-tagihan-id-edit': 'sisa_tagihan',
    'description-piutang-id-edit': 'description'
};

buttonPiutang.forEach(function(element){
    element.addEventListener('click', function(event){
        const url = element.getAttribute('data-url');
        const editForm = element.getAttribute('data-edit');
        const form = document.getElementById('piutang-get');
        const data = {};

        // Populate data object
        for (const key in formElements) {
            data[key] = document.getElementById(key).value = '';
        }

        recordPenjualan(editForm)
            .then(function(response){
                form.action = url;
                const responseData = response.data;

                for (const key in formElements) {
                    document.getElementById(key).value = responseData[formElements[key]];
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    });
});


    function recordPenjualan(url) {
        return axios.get(url);
    }


    const tagihan = document.getElementById('total-tagihan-id');
    const bayar = document.getElementById('total-pembayaran-id');
    const sisa = document.getElementById('sisa-tagihan-id');
    tagihan.addEventListener('input',function(){
        const value = this.value;
        sisa.value = value - bayar.value
    })
    bayar.addEventListener('input',function(){
        const value = this.value;
        sisa.value = tagihan.value - value
    })
});
