<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= APP_NAME ?>Authentication</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" />
    <?php $this->load->view('partials/styles.php'); ?>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('<?= PUBLIC_ASSETS_URL ?>/assets/media/auth/bg4.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('<?= PUBLIC_ASSETS_URL ?>/assets/media/auth/bg4-dark.jpg');
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="<?= BASE_URL ?>" class="mb-7 m-auto">
                        <img alt="Logo" width="250px" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" />
                    </a>
                    <h2 class="text-white fw-normal m-0">Start your success journey with Maharashtra Udyog</h2>
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px px-20 py-15 mh-lg-550px my-auto">
                    <div class="d-flex flex-center flex-column flex-column-fluid p-15 p-lg-10">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="<?= BASE_URL ?>" action="<?= BASE_URL ?>/auth/sign_in">
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Maharashtra Udyog's Backend</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="#" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="tooltip-inverse" title="Contact Development Team to reset your password">Forgot Password ?</a>
                            </div>
                            <div class="d-grid">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary w-50 m-auto">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('partials/scripts.php'); ?>
    <script>
        function init() {
            var signInForm = $("#kt_sign_in_form");
            var signInFormSubmitBtn = $("#kt_sign_in_submit");

            signInFormValidation = FormValidation.formValidation(signInForm[0], {
                fields: {
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address"
                            },
                            notEmpty: {
                                message: "Email address is required"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
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
                }
            });

            signInFormSubmitBtn.on("click", function(event) {
                event.preventDefault();
                signInFormValidation
                    .validate()
                    .then(function(status) {
                        if (status === 'Valid') {
                            signInFormSubmitBtn.attr('data-kt-indicator', 'on').prop('disabled', true);
                            $.post(signInForm.closest('form').attr('action'), signInForm.serialize())
                                .done(function(response) {
                                    if (response) {
                                        var parsedResponse = JSON.parse(response);
                                        if (parsedResponse?.status != "success") {
                                            Swal.fire({
                                                text: parsedResponse?.message ? parsedResponse
                                                    .message : "Sorry, the email or password is incorrect, please try again.",
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            });
                                            return;
                                        }
                                        signInForm[0].reset();
                                        Swal.fire({
                                            text: "You have successfully logged in!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });

                                        var redirectUrl = signInForm.attr('data-kt-redirect-url');
                                        if (redirectUrl) {
                                            location.href = redirectUrl;
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
                                .always(function() {
                                    signInFormSubmitBtn.removeAttr('data-kt-indicator')
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
        }

        $(document).ready(function() {
            init();
        });
    </script>
</body>

</html>