<script>
    $(document).ready(() => {
        $('.editData').on('click', (e) => {
            $
                .post("<?= BASE_URL . '/modules/get_franchise' ?>", {
                    franchise_id: $(e.currentTarget).attr('data-franchise-id')
                })
                .done(function(response) {
                    if (response) {
                        var parsedResponse = JSON.parse(response);
                        if (parsedResponse?.status != "success") {
                            Swal.fire({
                                text: parsedResponse?.message ?
                                    parsedResponse
                                    .message : "Sorry, unable to fetch the record, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            return;
                        }

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
        })
    })
</script>