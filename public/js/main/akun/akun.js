

const akunButton = document.querySelectorAll('a.btn.btn-info.edit-this-akun-modal');


akunButton.forEach(function(event){
    const fieald = {
        'name_akun-edit':'name_akun',
        'kode_buku-edit':'kode_buku',
        'klasifikasi_akun-edit':'klasifikasi_akun'
    };
    event.addEventListener('click',function(i){
        const url = event.getAttribute('data-url');
        const edit = event.getAttribute('data-edit');
        const data = {};
        const form = document.getElementById('modal-akun-edit');
        for (const key in fieald) {
            data[key] = document.getElementById(key).value = '';
        }
        getShow(edit).then(function(response){
            form.action = url;
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
