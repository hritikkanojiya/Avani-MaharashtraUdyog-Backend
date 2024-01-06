<script>
    $(document).ready(() => {

        var addFranchiseFormDomElement = document.getElementById('franchise_add_details_form');
        var addFranchiseForm = $("#franchise_add_details_form");
        var addFranchiseFormSubmitBtn = $("#submit_franchise_details");

        addFranchiseFormValidation = FormValidation.formValidation(addFranchiseForm[0], {
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
                franchise_logo: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Logo is required"
                        }
                    }
                },
                franchise_gallery_video: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Logo is required"
                        }
                    }
                },
                franchise_gallery_image: {
                    validators: {
                        notEmpty: {
                            message: "Franchise Logo is required"
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
        
        addFranchiseFormSubmitBtn.on("click", function(event) {
            event.preventDefault();
            addFranchiseFormValidation
                .validate()
                .then(function(status) {
                    if (status === 'Valid') {
                        addFranchiseFormSubmitBtn
                            .attr('data-kt-indicator', 'on')
                            .prop('disabled', true);
                        $.ajax({
                                url: addFranchiseForm.closest('form').attr(
                                    'action'),
                                type: 'POST',
                                data: new FormData(addFranchiseFormDomElement),
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
                                                .message : "Sorry, unable to get response, please try again.",
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
                                        title: "Added!",
                                        text: "Your record has been added.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-success"
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            addFranchiseForm[0].reset();
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
                                    text: "Sorry, xhr request failed, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            })
                            .always(function() {
                                addFranchiseFormSubmitBtn.removeAttr('data-kt-indicator')
                                    .prop('disabled', false);
                            });
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some incorrect values in the form, please try again.",
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

        $('#franchise_add_details_form input[name="franchise_field_assistant"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })

        $('#franchise_add_details_form input[name="franchise_agreement"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })

        $('#franchise_add_details_form input[name="franchise_term_renew"]').on('click', (e) => {
            $(e.currentTarget).val($(e.currentTarget).prop('checked'))
        })
    })
</script>