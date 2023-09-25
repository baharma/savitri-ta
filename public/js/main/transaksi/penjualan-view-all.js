

document.addEventListener('DOMContentLoaded',function(){

    const tableBody = document.getElementById('table-body');
    const noDataMessage = document.getElementById('no-data-message');
    const pagination = document.getElementById('pagination');

    getPenjualan()
    function getPenjualan(){
        const urlApi = `${window.location.origin}/get/allpenjualan`;
        axiosGet(urlApi).then(function(response){

            penjualanPaginations(response.data)
        }).catch(function(error) {
            console.log(error);
        });
    }


    //data paginations
    function penjualanPaginations(pagination){
        axiosGet(pagination.first_page_url).then(function(response){
            console.log(response.data)


        })
    }






    function axiosGet(url){
        return axios.get(url);
    }


});
