<script>
$(document).ready(() => {
    // $('#application_details_modal_view').modal('show')

    $(document).on('click', '.viewData', (e) => {
        $
            .post("<?= BASE_URL . '/modules/get_application' ?>", {
                application_id: $(e.currentTarget).attr('data-application-id')
            })
            .done(function(response) {
                if (response) {
                    var parsedResponse = JSON.parse(response);
                    if (parsedResponse?.status != "success") {
                        Swal.fire({
                            text: parsedResponse?.message ?
                                parsedResponse
                                .message :
                                "Sorry, unable to fetch the record, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    $('#application_details_modal_view input[name="applicant_name"]')
                        .val(parsedResponse?.data?.application?.name)
                    $('#application_details_modal_view input[name="franchise_name"]')
                        .val(parsedResponse?.data?.application?.franchiseName != null ? parsedResponse?.data?.application?.franchiseName : "NA")
                    $('#application_details_modal_view input[name="dob"]')
                        .val(parsedResponse?.data?.application?.dob)
                    $('#application_details_modal_view input[name="contact"]')
                        .val(parsedResponse?.data?.application?.contact)
                    $('#application_details_modal_view input[name="whatsapp"]')
                        .val(parsedResponse?.data?.application?.whatsapp)
                    $('#application_details_modal_view input[name="cast"]')
                        .val(parsedResponse?.data?.application?.cast)
                    $('#application_details_modal_view input[name="maritial"]')
                        .val(parsedResponse?.data?.application?.maritial)
                    $('#application_details_modal_view input[name="district"]')
                        .val(parsedResponse?.data?.application?.district)
                    $('#application_details_modal_view input[name="job"]')
                        .val(parsedResponse?.data?.application?.job)
                    $('#application_details_modal_view input[name="comp_name"]')
                        .val(parsedResponse?.data?.application?.comp_name)
                    $('#application_details_modal_view input[name="job_desc"]')
                        .val(parsedResponse?.data?.application?.job_desc)
                    $('#application_details_modal_view input[name="intrest"]')
                        .val(parsedResponse?.data?.application?.intrest)
                    $('#application_details_modal_view input[name="acknowledgement"]')
                        .val(parsedResponse?.data?.application?.acknowledgement)
                    $('#application_details_modal_view textarea[name="address"]')
                        .val(parsedResponse?.data?.application?.address)
                    $('#application_details_modal_view').modal('show')

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