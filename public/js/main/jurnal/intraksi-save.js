

const buttonForm = document.getElementById('save-get');
const buttonDelete = document.getElementById('delete-jurnal-umum');
function formEvent(url){
    const form = document.querySelectorAll('form.form-jurnal')
    const formData = [];

    form.forEach((frm)=>{
        const data  = {}
        const inputs = frm.querySelectorAll('input, select');
        inputs.forEach((input) => {
            if (input.tagName === 'SELECT') {
              data[input.name] = input.value;
            } else {
              data[input.name] = input.value;
            }
          });
          formData.push(data);
    })
    if(url){
        axios.put(url,formData).then(response => {
            window.location.href = '/jurnal-umum';
        }).catch((error) => {});
    }else{
        axios.put('/delete/cancel/jurnal',formData)
    }
}


buttonForm.addEventListener('click', function(){
    const url = this.dataset.url;
    console.log(url);
    formEvent(url);
});

buttonDelete.addEventListener('click',function(){
    const url = null;
    formEvent(url);
})


