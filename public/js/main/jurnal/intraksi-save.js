

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
        axios.put('/delete/cancel/jurnal',formData).then(response => {
            window.location.href = '/jurnal-umum';
        }).catch((error) => {});
    }
}


buttonForm.addEventListener('click', function(){
    checkbalance()
    .then(() => {
        const url = this.dataset.url;
        console.log(url);
        formEvent(url);
    })
    .catch((error) => {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.message, // Tampilkan pesan error dari reject
        });
    });
});

buttonDelete.addEventListener('click',function(){
    const url = null;
    formEvent(url);
})

function calculateTotal(inputs, totalElement) {
    let total = 0;

    inputs.forEach((input) => {
        const value = parseFloat(input.value) || 0;
        if (!isNaN(value)) {
            total += value;
        }
    });

    totalElement.value = total;
}
function checkbalance() {
    return new Promise((resolve, reject) => {
        const hasil_debit = document.getElementById('hasil-debit').value;
        const hasil_kredit = document.getElementById('hasil-kredit').value;

        if (hasil_debit === hasil_kredit) {
            resolve(); // Jika sama, resolve promise
        } else {
            reject(new Error('Data Kredit dan Debit tidak seimbang!')); // Jika tidak sama, reject dengan error
        }
    });
}

const debitInputs = document.querySelectorAll("input[name=debit]");
const hasilDebitInput = document.getElementById("hasil-debit");
debitInputs.forEach((input) => input.addEventListener("input", () => calculateTotal(debitInputs, hasilDebitInput)));
calculateTotal(debitInputs, hasilDebitInput);

const kreditInputs = document.querySelectorAll("input[name=kredit]");
const hasilKreditInput = document.getElementById("hasil-kredit");
kreditInputs.forEach((input) => input.addEventListener("input", () => calculateTotal(kreditInputs, hasilKreditInput)));
calculateTotal(kreditInputs, hasilKreditInput);

