const bukuButton = document.querySelectorAll('a.btn.btn-info.edit-buku');

bukuButton.forEach(function(event){
    const field = {
        'date':'date',
        'description':'description',
        'saldo':'saldo'
    }
    event.addEventListener('click',function(i){
        const url = event.getAttribute('data-url');
        const edit = event.getAttribute('data-edit');
        const data = {};
        const form = document.getElementById('modal-edit-buku');
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
