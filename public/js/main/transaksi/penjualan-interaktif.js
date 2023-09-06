document.addEventListener('DOMContentLoaded', function () {
    const qtyPenjualan = document.getElementById('jumlah_barang');
    const hargaBarang = document.getElementById('harga_barang');
    const totalPembayaran = document.getElementById('total_penjualan');

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






});

function recordPenjualan(
    faktur_penjualan,
    tanggal_penjualan,
    nama_barang,
    jenis_barang,
    harga_barang,
    jumlah_barang,
    total_penjualan,
    jenis_pembayaran,
    description
) {
    // Di sini Anda dapat melakukan operasi atau tindakan yang sesuai
    // dengan data yang Anda terima sebagai parameter
    console.log(`Faktur Penjualan: ${faktur_penjualan}`);
    console.log(`Tanggal Penjualan: ${tanggal_penjualan}`);
    console.log(`Nama Barang: ${nama_barang}`);
    console.log(`Jenis Barang: ${jenis_barang}`);
    console.log(`Harga Barang: ${harga_barang}`);
    console.log(`Jumlah Barang: ${jumlah_barang}`);
    console.log(`Total Penjualan: ${total_penjualan}`);
    console.log(`Jenis Pembayaran: ${jenis_pembayaran}`);
    console.log(`Deskripsi: ${description}`);

    document.getElementById('nama_barang').value = nama_barang;

}
