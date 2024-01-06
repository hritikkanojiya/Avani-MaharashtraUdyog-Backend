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

        $(document).on('click', '.editData', (e) => {
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
                        $('#franchise_details_modal_update textarea[name="franchise_details"]')
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

                        var videoHTML = "";

                        var imageHTML = `<div class="col-12 col-md-4 mb-5 text-center" data-repeater-item>
                                    <div class="pt-2 mt-0 text-center">
                                        <div class="row card border-gray-300 mx-1 fileUploadMaster">
                                            <div class="col-12 my-2">
                                                <div class="symbol symbol-150px">
                                                    <img class="filePreview" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/svg/avatars/blank.svg" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text uploadGalleryImage">
                                                        <i class="ki-duotone ki-faceid fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                        </i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Image URL" name="franchise_image_gallery"  readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-5">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        Delete
                                    </a>
                                    </div>`;

                        if (parsedResponse?.data?.franchise?.media) {
                            parsedResponse?.data?.franchise?.media.forEach(element => {
                                if (element?.type == "image") {
                                    $('.franchiseImageGalleryMaster').addClass('d-block').removeClass('d-none')
                                    imageHTML += `<div class="col-12 col-md-4 mb-5 text-center" data-repeater-item>
                                    <div class="pt-2 mt-0 text-center">
                                        <div class="row card border-gray-300 mx-1 fileUploadMaster">
                                            <div class="col-12 my-2">
                                                <div class="symbol symbol-150px">
                                                    <img class="filePreview" src="<?php echo APP_ENV == "prod" ? CDN_URL : CDN_URL ?>/public/uploads/master/${element.hash_name}" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text uploadGalleryImage">
                                                        <i class="ki-duotone ki-faceid fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                        </i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Image URL" name="franchise_image_gallery" value="${element.hash_name}"  readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-5">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        Delete
                                    </a>
                                    </div>
                                    `;
                                } else {
                                    $('.franchiseImageGalleryMaster').addClass('d-block').removeClass('d-none')
                                    imageHTML += `<div class="col-12 col-md-3 mb-5 p-0 text-center">
                                                    <div class="card border-gray-300 mx-1">
                                                        <div class="symbol symbol-150px">
                                                            <img src="<?php echo APP_ENV == "prod" ? CDN_URL : BASE_URL ?>/public/uploads/master/${element.hash_name}" alt="" />
                                                        </div>
                                                    </div>
                                                </div>`;
                                }
                            });
                        }

                        $('#franchise_details_modal_update .franchise_image_repeat').html(imageHTML);
                        $('#franchise_details_modal_update .franchise_video_repeat').html(videoHTML);

                        if ($('#franchise_details_modal_update .franchise_image_repeat').children().length > 1) {
                            $($('#franchise_details_modal_update .franchise_image_repeat').children()[0]).remove()
                        }

                        $('#franchise_image_gallery_update_repeat').repeater({
                            initEmpty: false,
                            show: function() {
                                KTImageInput.createInstances();
                                $(this).slideDown();
                            },
                            hide: function(deleteElement) {
                                if (confirm('Are you sure you want to delete this element?')) {
                                    $(this).slideUp(deleteElement);
                                }
                            },
                            isFirstItemUndeletable: true
                        });

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