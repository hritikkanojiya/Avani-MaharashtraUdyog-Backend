<script>
    $(document).ready(() => {
        var updateFranchiseFormDomElement = document.getElementById('franchise_update_details_form');
        var updateFranchiseForm = $("#franchise_update_details_form");
        var updateFranchiseFormUpdateBtn = $("#update_franchise_details");

        updateFranchiseFormValidation = FormValidation.formValidation(updateFranchiseForm[0], {
            fields: {
                franchise_name: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Name is required"
                        }
                    }
                },
                franchise_details: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Details is required"
                        }
                    }
                },
                franchise_business_details: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Business Details is required"
                        }
                    }
                },
                franchise_investment_details: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Investment Details is required"
                        }
                    }
                },
                franchise_royalty_comm: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Royalty Commission is required"
                        }
                    }
                },
                franchise_roi: {
                    validators: {
                        notEmpty: {
                            message: "Franchise ROI is required"
                        }
                    }
                },
                franchise_payback: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Payback is required"
                        }
                    }
                },
                franchise_property: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Property is required"
                        }
                    }
                },
                franchise_floor_area: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Floor Area is required"
                        }
                    }
                },
                franchise_pref_location: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Prefered Location is required"
                        }
                    }
                },
                franchise_operating_manual: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Operating Manual is required"
                        }
                    }
                },
                franchise_training_loc: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Training Link is required"
                        }
                    }
                },
                franchise_term_duration: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Term Duration is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: ""
                })
            },
        });

        updateFranchiseFormUpdateBtn.on("click", function(event) {
            event.preventDefault();
            updateFranchiseFormValidation
                .validate()
                .then(function(status) {
                    if (status === 'Valid') {
                        updateFranchiseFormUpdateBtn
                            .attr('data-kt-indicator', 'on')
                            .prop('disabled', true);
                        $.ajax({
                                url: updateFranchiseForm.closest('form').attr(
                                    'action'),
                                type: 'POST',
                                data: new FormData(updateFranchiseFormDomElement),
                                processData: false,
                                contentType: false,
                                cache: false,
                                enctype: 'multipart/form-data',
                            }).done(function(response) {
                                if (response) {
                                    var parsedResponse = JSON.parse(response);
                                    if (parsedResponse?.status != "success") {
                                        Swal.fire({
                                            text: parsedResponse?.message ?
                                                parsedResponse
                                                .message : "Sorry, the details are incorrect, please try again.",
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
                                        title: "Updated!",
                                        text: "Your record has been updated.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-success"
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            updateFranchiseForm[0].reset();
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
                            .always(function() {
                                updateFranchiseFormUpdateBtn.removeAttr('data-kt-indicator')
                                    .prop('disabled', false);
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
                });
        });

        $('#franchise_update_details_form input[name="franchise_field_assistant"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })

        $('#franchise_update_details_form input[name="franchise_agreement"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })

        $('#franchise_update_details_form input[name="franchise_term_renew"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })

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

                        $('#franchise_details_modal_update input[name="franchise_id_update"]')
                            .val(parsedResponse?.data?.franchise?.franchise_id)
                        $('#franchise_details_modal_update input[name="franchise_name"]')
                            .val(parsedResponse?.data?.franchise?.name)
                        $('#franchise_details_modal_update input[name="franchise_details"]')
                            .val(parsedResponse?.data?.franchise?.franchise_details)
                        $('#franchise_details_modal_update textarea[name="franchise_business_details"]')
                            .val(parsedResponse?.data?.franchise?.business_details)
                        $('#franchise_details_modal_update textarea[name="franchise_investment_details"]')
                            .val(parsedResponse?.data?.franchise?.investment_details)
                        $('#franchise_details_modal_update textarea[name="franchise_royalty_comm"]')
                            .val(parsedResponse?.data?.franchise?.royalty_comm)
                        $('#franchise_details_modal_update textarea[name="franchise_roi"]')
                            .val(parsedResponse?.data?.franchise?.roi)
                        $('#franchise_details_modal_update textarea[name="franchise_payback"]')
                            .val(parsedResponse?.data?.franchise?.payback)
                        $('#franchise_details_modal_update textarea[name="franchise_property"]')
                            .val(parsedResponse?.data?.franchise?.property)
                        $('#franchise_details_modal_update textarea[name="franchise_floor_area"]')
                            .val(parsedResponse?.data?.franchise?.floorarea)
                        $('#franchise_details_modal_update textarea[name="franchise_pref_location"]')
                            .val(parsedResponse?.data?.franchise?.pref_loc)
                        $('#franchise_details_modal_update textarea[name="franchise_operating_manual"]')
                            .val(parsedResponse?.data?.franchise?.operating_manual)
                        $('#franchise_details_modal_update textarea[name="franchise_training_loc"]')
                            .val(parsedResponse?.data?.franchise?.training_loc)
                        $('#franchise_details_modal_update textarea[name="franchise_term_duration"]')
                            .val(parsedResponse?.data?.franchise?.term_duration)
                        $('#franchise_details_modal_update input[name="franchise_field_assistant"]')
                            .prop('checked', parsedResponse?.data?.franchise?.field_assistant)
                        $('#franchise_details_modal_update input[name="franchise_agreement"]')
                            .prop('checked', parsedResponse?.data?.franchise?.agreement)
                        $('#franchise_details_modal_update input[name="franchise_term_renew"]')
                            .prop('checked', parsedResponse?.data?.franchise?.term_renew)
                        $('#franchise_details_modal_update div[name="franchise_logo"]')
                            .attr('style',
                                `background-image: url(<?= CDN_URL ?>/public/uploads/franchise/logos/${parsedResponse?.data?.franchise?.logo})`
                            )

                        var imageHTML = "";
                        var videoHTML = "";

                        if (parsedResponse?.data?.franchise?.media) {
                            parsedResponse?.data?.franchise?.media.forEach(element => {
                                if (element?.type == "image") {
                                    imageHTML += `<div class="col-12 col-md-2 mb-5 text-center">
                                    <div class="symbol symbol-75px symbol-md-125px">
                                        <img src="<?= CDN_URL ?>/public/uploads/franchise/images/${element.hash_name}" alt="" />
                                    </div>
                                </div>`;
                                } else {
                                    videoHTML += `<div class="card col-12 col-md-2 mb-5 mx-5">
                                    <a href="<?= CDN_URL ?>/public/uploads/franchise/videos/${element.hash_name}" target="_blank" class="text-center text-gray-600 fw-semibold">
                                        <i class="fs-4qx ki-duotone ki-youtube m-auto py-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <label
                                            class="d-flex align-items-center justify-content-center fs-8 fw-semibold mb-2">
                                            <span class="text-truncate">${element.original_name}</span>
                                        </label>
                                    </a>
                                </div>`;
                                }
                            });
                        }

                        $('#franchise_details_modal_update .franchise_image_repeat').html(imageHTML);
                        $('#franchise_details_modal_update .franchise_video_repeat').html(videoHTML);

                        $('#franchise_details_modal_update').modal('show')

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