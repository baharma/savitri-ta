$(function () {
    $(".success").show(function () {
        let messageSuccess = $(this).data("message");
        swal.fire({
            title: 'Success',
            text: messageSuccess,
            icon: "success",
        });
    });

    $(document).on("click", ".delete-item", function () {
        const url = $(this).data("url");
        console.log(url)
        swal.fire({
            title: "Warning",
            text: "Are you sure for delete this ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).data("id");
                let token = $("meta[name='csrf-token']").attr("content");
                axios({
                    method: "DELETE",
                    url: url,
                    data: {
                        id: id,
                        _token: token,
                    },
                })
                    .then((response) => {
                        console.log(response.data); // add this line to log the response data
                        Swal.fire("Deleted!", response.data.message, "success");
                        window.location.reload().time(3);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        });
    });


});
