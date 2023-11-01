const jurnalButton = document.querySelectorAll('a.btn.btn-info.edit-jurnal');


jurnalButton.forEach(function(event){
    const field = {
        'date':'date',
        'kode_jurnal':'kode_jurnal',
        'debit':'debit',
        'kredit':'kredit',
        'description':'description',
    }
    event.addEventListener('click',function(i){
        const url = event.getAttribute('data-edit');
        const edit = event.getAttribute('data-url');
        const data = {};
        const form = document.getElementById('jurnal-edit-form');
        for (const key in field) {
            data[key] = document.getElementById(key).value = '';
        }
        getShow(edit).then(function(response){
            form.action = url;
            const responseData = response.data;
            for (const key in field) {
                document.getElementById(key).value = responseData[field[key]];
            }
        })
    })
})

function getShow(get) {
    return axios.get(get);
}
