<script>
$(document).ready(() => {

    $('.deleteData').on('click', (e) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $
                    .post("<?= BASE_URL . '/modules/delete_franchise' ?>", {
                        franchise_id: $(e.currentTarget).attr('data-franchise-id')
                    })
                    .done(function(response) {
                        if (response) {
                            var parsedResponse = JSON.parse(response);
                            if (parsedResponse?.status != "success") {
                                Swal.fire({
                                    text: parsedResponse?.message ?
                                        parsedResponse
                                        .message :
                                        "Sorry, unable to delete the record, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                return;
                            }
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-success"
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            });
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    })
                    .fail(function() {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    })
            }
        });
    })
})
</script>