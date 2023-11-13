const saldoLast = document.querySelectorAll('.saldo-get');
const lastSaldo = document.getElementById('saldo-akhir');
const saldoModal = document.getElementById('saldo-modal');
saldoLast.forEach((input) => {
    input.addEventListener("input", (event) => {
        lastSaldo.value = event.target.value;
        saldoModal.value = event.target.value;
    });
});

const saldoSave = document.getElementById('save-buku');
const saldoDelete = document.querySelectorAll('.delete-all-syns-saldo');

saldoDelete.forEach(function(event){
    event.addEventListener('click',function(e){
        const url = event.dataset.delete;
        formUpdate(url)
    })
})

saldoSave.addEventListener('click',function(event){
    const urlConnetState = this.dataset.push;
    formUpdate(urlConnetState)
})

function formUpdate(url){
    const form = document.querySelectorAll('form.save-all-jurnal');
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
    axios.put(url,formData).then(function(response){
        console.log(response.data);
    })
}


document.addEventListener('DOMContentLoaded',function(){
    Array.f
})