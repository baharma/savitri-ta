document.addEventListener('DOMContentLoaded', function () {
    const buttonPengeluaran = document.querySelectorAll('a.btn.btn-info.edit-this-modal')
    buttonPengeluaran.forEach(function (event) {
        const url = event.getAttribute('data-url');
        const edit = event.getAttribute('data-edit');
        const data = {};
        const form = document.getElementById('modal-pengeluaran-edit');
        const fieald = {
            'jenis-bayar-id-edit': 'jenis_bayar',
            'tanggal-pengeluran-id-edit': 'tanggal_pengeluran',
            'jenis-pengeluaran-id-edit': 'jenis_pengeluaran',
            'total-pengeluaran-id-edit': 'total_pengeluaran',
            'description-pengeluaran-id-edit': 'descriptions'
        };
        event.addEventListener('click', function (i) {
            form.action = url;
            for (const key in fieald) {
                data[key] = document.getElementById(key).value = '';
            }
            getShow(edit).then(function (response) {
                    const responseData = response.data;

                    for (const key in fieald) {
                        document.getElementById(key).value = responseData[fieald[key]];
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    })

    const buttonHutang = document.querySelectorAll('a.btn.btn-info.hutang')
    buttonHutang.forEach(function(event){
        const form = document.getElementById('modal-hutang-edit');
        const fieald = {
            'tgl_transaksi_hutang-edit':'tgl_transaksi_hutang',
            'tgl_jatuh_tempo-edit':'tgl_jatuh_tempo',
            'total_transaksi_hutang-edit':'total_transaksi_hutang',
            'description-hutang-id-edit':'description',
        }
        event.addEventListener('click',function(i){
            const url = event.getAttribute('data-url');
            const edit = event.getAttribute('data-edit');
            const data = {};
            form.action = url;
            for (const key in fieald) {
                data[key] = document.getElementById(key).value = '';
            }

            getShow(edit).then(function(response){
                const responseData = response.data;

                    for (const key in fieald) {
                        document.getElementById(key).value = responseData[fieald[key]];
                    }
            })
        })
    })



    function getShow(get) {
        return axios.get(get);
    }
})
