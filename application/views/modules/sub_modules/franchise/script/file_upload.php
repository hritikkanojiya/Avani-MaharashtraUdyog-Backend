<script>
    $(document).ready(() => {

        var fileUploadFormDomElement = document.getElementById('franchise_image_upload_form');
        var fileUploadForm = $("#franchise_image_upload_form");
        var fileUploadFormSubmitBtn = $("#submit_file");
        var currentNodeSelector = null;

        fileUploadFormValidation = FormValidation.formValidation(fileUploadForm[0], {
            fields: {
                uploaded_file: {
                    validators: {
                        notEmpty: {
                            message: "File is required"
                        }
                    }
                },
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

        $(document).on('click', '.uploadGalleryImage', (e) => {
            const currentTarget = $(e.currentTarget)
            fileUploadForm[0].reset();
            fileUploadFormSubmitBtn.removeAttr('data-kt-indicator')
                .prop('disabled', false);
            $('#franchise_image_upload_modal').modal('show');
            currentNodeSelector = currentTarget;
        })

        fileUploadFormSubmitBtn.on("click", function(event) {
            event.preventDefault();
            fileUploadFormValidation
                .validate()
                .then(function(status) {
                    if (status === 'Valid') {
                        fileUploadFormSubmitBtn
                            .attr('data-kt-indicator', 'on')
                            .prop('disabled', true);
                        $.ajax({
                                url: fileUploadForm.closest('form').attr(
                                    'action'),
                                type: 'POST',
                                data: new FormData(fileUploadFormDomElement),
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
                                    if (currentNodeSelector) {
                                        currentNodeSelector.parents('.fileUploadMaster').children("div:first").children('div.symbol').children('img.filePreview').attr('src', parsedResponse.file_url)
                                        currentNodeSelector.siblings('input:first').val(parsedResponse.file_name)
                                    }
                                    fileUploadForm[0].reset();
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
                                $('#franchise_image_upload_modal').modal('hide')
                                fileUploadFormSubmitBtn.removeAttr('data-kt-indicator')
                                    .prop('disabled', false);
                            });
                    }
                });
        });
    })
</script>