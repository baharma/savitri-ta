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
                    console.log(responseData)
                    for (const key in fieald) {
                        document.getElementById(key).value = responseData[fieald[key]];
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    })




    function getShow(get) {
        return axios.get(get);
    }
})
