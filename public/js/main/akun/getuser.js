const users = document.querySelectorAll('a.btn.btn-info.edit-users');

users.forEach(function(event){
    const fieald = {
        'fullname-id':'fullname',
        'name-id':'name',
        'email-id':'email'
    };
    event.addEventListener('click',function(i){
        const url = event.getAttribute('data-url');
        const edit = event.getAttribute('data-edit');
        const data = {};
        const form = document.getElementById('edit-User');
        for (const key in fieald) {
            data[key] = document.getElementById(key).value = '';
        }
        getShow(edit).then(function(response){
            form.action = url;
            const responseData = response.data;
            console.log(responseData)
            for (const key in fieald) {
                document.getElementById(key).value = responseData[fieald[key]];
            }
        })
    })
})

function getShow(get) {
    return axios.get(get);
}
