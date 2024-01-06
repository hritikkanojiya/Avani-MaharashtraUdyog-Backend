<script>
    $(document).ready(() => {
        $(document).on('click', '.viewData', (e) => {
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

                        $('#franchise_details_modal_view input[name="franchise_name"]')
                            .val(parsedResponse?.data?.franchise?.name)
                        $('#franchise_details_modal_view textarea[name="franchise_details"]')
                            .val(parsedResponse?.data?.franchise?.franchise_details)
                        $('#franchise_details_modal_view textarea[name="franchise_business_details"]')
                            .val(parsedResponse?.data?.franchise?.business_details)
                        $('#franchise_details_modal_view textarea[name="franchise_investment_details"]')
                            .val(parsedResponse?.data?.franchise?.investment_details)
                        $('#franchise_details_modal_view textarea[name="franchise_royalty_comm"]')
                            .val(parsedResponse?.data?.franchise?.royalty_comm)
                        $('#franchise_details_modal_view textarea[name="franchise_roi"]')
                            .val(parsedResponse?.data?.franchise?.roi)
                        $('#franchise_details_modal_view textarea[name="franchise_payback"]')
                            .val(parsedResponse?.data?.franchise?.payback)
                        $('#franchise_details_modal_view textarea[name="franchise_property"]')
                            .val(parsedResponse?.data?.franchise?.property)
                        $('#franchise_details_modal_view textarea[name="franchise_floor_area"]')
                            .val(parsedResponse?.data?.franchise?.floorarea)
                        $('#franchise_details_modal_view textarea[name="franchise_pref_location"]')
                            .val(parsedResponse?.data?.franchise?.pref_loc)
                        $('#franchise_details_modal_view textarea[name="franchise_operating_manual"]')
                            .val(parsedResponse?.data?.franchise?.operating_manual)
                        $('#franchise_details_modal_view textarea[name="franchise_training_loc"]')
                            .val(parsedResponse?.data?.franchise?.training_loc)
                        $('#franchise_details_modal_view textarea[name="franchise_term_duration"]')
                            .val(parsedResponse?.data?.franchise?.term_duration)
                        $('#franchise_details_modal_view input[name="franchise_field_assistant"]')
                            .prop('checked', parsedResponse?.data?.franchise?.field_assistant)
                        $('#franchise_details_modal_view input[name="franchise_agreement"]')
                            .prop('checked', parsedResponse?.data?.franchise?.agreement)
                        $('#franchise_details_modal_view input[name="franchise_term_renew"]')
                            .prop('checked', parsedResponse?.data?.franchise?.term_renew)
                        $('#franchise_details_modal_view img[name="franchise_logo"]')
                            .attr('src',
                                `<?= CDN_URL ?>/public/uploads/franchise/logos/${parsedResponse?.data?.franchise?.logo}`
                            )

                        var imageHTML = "";
                        var videoHTML = "";
 
                        if (parsedResponse?.data?.franchise?.media) {
                            parsedResponse?.data?.franchise?.media.forEach(element => {
                                if (element?.type == "image") {
                                    $('.franchiseImageGalleryMaster').addClass('d-block').removeClass('d-none')
                                    imageHTML += `<div class="col-12 col-md-3 mb-5 p-0 text-center">
                                                    <div class="card border-gray-300 mx-1">
                                                        <div class="symbol symbol-150px">
                                                            <img src="<?php echo APP_ENV == "prod" ? CDN_URL : CDN_URL ?>/public/uploads/master/${element.hash_name}" alt="" />
                                                        </div>
                                                    </div>
                                                </div>`;
                                } else {
                                    $('.franchiseVideoGalleryMaster').addClass('d-block').removeClass('d-none')
                                    videoHTML += `<div class="card col-12 col-md-2 mb-5 mx-5">
                                    <iframe src="${element.video_url}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>`;
                                }
                            });
                        }

                        $('#franchise_details_modal_view .franchise_image_repeat').html(imageHTML);
                        $('#franchise_details_modal_view .franchise_video_repeat').html(videoHTML);

                        $('#franchise_details_modal_view').modal('show')

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