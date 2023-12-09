<?php
$adminDetails = $this->session->userdata('admin_details');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= APP_NAME ?>Modules | Franchise</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" />
    <?php $this->load->view('partials/styles.php'); ?>
    <style>
        :root {
            --ck-z-default: 100;
            --ck-z-modal: calc(var(--ck-z-default) + 999);
        }


        .ck-content .table {
            width: auto;
        }

        .image-input-placeholder {
            background-image: url('<?= PUBLIC_ASSETS_URL ?>/assets/svg/avatars/blank.svg');
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('<?= PUBLIC_ASSETS_URL ?>/assets/svg/avatars/blank-dark.svg');
        }
    </style>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
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
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="<?= BASE_URL ?>" class="d-lg-none">
                            <img alt="Logo" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" class="h-30px" />
                        </a>
                    </div>
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                                <div class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <a class="menu-link" href="<?= BASE_URL ?>/modules/franchise">
                                        <span class="menu-title">Franchise</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>
                                <div class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link">
                                        <a class="menu-title" href="<?= BASE_URL ?>/modules/clients">Clients</a>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </span>
                                </div>
                                <div class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <a class="menu-link" href="<?= BASE_URL ?>/modules/queries">
                                        <span class="menu-title">Queries</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>
                                <div class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <a class="menu-link" href="<?= LIVE_URL ?>">
                                        <span class="menu-title">Maharsahtra Udyog</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="app-navbar flex-shrink-0">
                            <div class="app-navbar-item ms-1 ms-md-4">
                                <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-night-day fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                    <span class="path7"></span>
                                                    <span class="path8"></span>
                                                    <span class="path9"></span>
                                                    <span class="path10"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-moon fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-screen fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="https://ui-avatars.com/api/?background=random&name=<?= $adminDetails['name'] ?>" class="rounded-3" alt="user" />
                                </div>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="https://ui-avatars.com/api/?background=random&name=<?= $adminDetails['name'] ?>" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    <?= $adminDetails['name'] ?>
                                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary text-truncate mw-175px fs-7"><?= $adminDetails['email'] ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5">
                                        <a href="<?= BASE_URL ?>/auth/logout" class="menu-link px-5">Sign Out</a>
                                    </div>
                                </div>
                            </div>
                            <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                                <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                                    <i class="ki-duotone ki-element-4 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                        <a href="<?= BASE_URL ?>" class="m-auto">
                            <img alt="Logo" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" class="h-50px app-sidebar-logo-default" />
                            <img alt="Logo" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/logos/logo.png" class="h-35px app-sidebar-logo-minimize" />
                        </a>
                        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-element-11 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Modules</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <div class="menu-sub menu-sub-accordion">
                                            <div class="menu-item">
                                                <a class="menu-link active" href="<?= BASE_URL ?>/modules/franchise">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Franchise</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="<?= BASE_URL ?>/modules/clients">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Clients</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="<?= BASE_URL ?>/modules/queries">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Queries</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        Modules</h1>
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="#" class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-muted">Franchise</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <div class="row gx-5 gx-xl-10 card pt-5 table-responsive">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center justify-content-start position-relative">
                                            <span class="svg-icon fs-1 position-absolute ms-4">
                                                <i class="ki-duotone ki-abstract-33 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i></span>
                                            <input type="text" data-kt-filter="search" class="form-control form-control-solid bg-gray-200i w-md-350px ps-14" placeholder="Search Table" />
                                        </div>
                                        <a href="#" class="btn fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#franchise_details_modal_add">Add Franchise</a>
                                    </div>
                                    <table id="kt_datatable_fixed_header" class="table border table-rounded table-row-dashed table-hover gy-5 gs-7">
                                        <thead class="bg-gray-200 fw-bold">
                                            <tr class="fw-semibold fs-6 text-gray-800">
                                                <th class="mw-100px mw-lg-150px">Name</th>
                                                <th class="mw-50px">Logo</th>
                                                <th class="mw-100px mw-lg-250px">Business Details</th>
                                                <th class="mw-100px mw-lg-250px">Investment Details</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($franchise) && is_array($franchise) && count($franchise) > 0) {
                                                $tableDom = "";
                                                foreach ($franchise as $key => $value) {
                                                    $tableDom .=  "<tr>";
                                                    $tableDom .=  "<td class='text-truncate mw-100px mw-lg-150px'>" . $value['name'] . "</td>";
                                                    $tableDom .=  "<td class='text-center'>
                                                                    <div class='symbol symbol-25px'>                                                   
                                                                        <img src='" . CDN_URL . '/public/uploads/franchise/logos/' .  $value['logo'] . "' class='img-fluid'>                                                  
                                                                    </div>
                                                                  </td>";
                                                    $tableDom .=  "<td class='text-truncate mw-100px mw-lg-250px'>" . $value['business_details'] . "</td>";
                                                    $tableDom .=  "<td class='text-truncate mw-100px mw-lg-250px'>" . $value['investment_details'] . "</td>";
                                                    $tableDom .=  "<td>" . (new DateTime($value['created_at']))->format('Y-m-d h:i:s A') . "</td>";
                                                    $tableDom .=  "<td class='d-flex justify-content-evenly'>";
                                                    $tableDom .=  " <a href='#' class='btn btn-icon btn-primary btn-sm viewData' data-franchise-id=" . $value['franchise_id'] . ">
                                                                        <i class='ki-duotone ki-eye'>
                                                                            <span class='path1'></span>
                                                                            <span class='path2'></span>
                                                                            <span class='path3'></span>
                                                                        </i>
                                                                    </a>
                                                                    <a href='#' class='btn btn-icon btn-warning btn-sm editData'  data-franchise-id=" . $value['franchise_id'] . ">
                                                                        <i class='ki-duotone ki-pencil'>
                                                                            <span class='path1'></span>
                                                                            <span class='path2'></span>
                                                                        </i>
                                                                    </a>
                                                                    <a href='#' class='btn btn-icon btn-danger btn-sm deleteData'  data-franchise-id=" . $value['franchise_id'] . ">
                                                                        <i class='ki-duotone ki-trash'>
                                                                            <span class='path1'></span>
                                                                            <span class='path2'></span>
                                                                            <span class='path3'></span>
                                                                            <span class='path4'></span>
                                                                            <span class='path5'></span>
                                                                        </i>
                                                                    </a>";
                                                    $tableDom .=  "</td>";
                                                    $tableDom .=  "</tr>";
                                                }
                                                echo $tableDom;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="kt_app_footer" class="app-footer">
                        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2023&copy;</span>
                                <a href="<?= LIVE_URL ?>" target="_blank" class="text-gray-800 text-hover-primary fw-bold">Maharsahtra Udyog</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->view('modules/sub_modules/franchise/dom/add_franchise_modal.php') ?>
    <?php $this->view('modules/sub_modules/franchise/dom/view_franchise_modal.php') ?>
    <?php $this->view('modules/sub_modules/franchise/dom/update_franchise_modal.php') ?>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    <?php $this->load->view('partials/scripts.php'); ?>

    <script>
        $(document).ready(() => {
            var textAreas = $('textarea[data-kt-autosize]');
            var franchiseAddForm = $("#franchise_add_details_form");

            textAreas.maxlength({
                alwaysShow: true,
                threshold: 2048,
                warningClass: "badge badge-warning",
                limitReachedClass: "badge badge-success",
                validate: true
            });

            autosize(textAreas);

            $('#franchise_image_gallery_repeat').repeater({
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

            $('#franchise_video_gallery_repeat').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                isFirstItemUndeletable: true
            });

            $('#franchise_details_modal_add').on('hidden.bs.modal', function(e) {
                $('.remove-media').click();
                franchiseAddForm[0].reset();
                KTImageInput.createInstances();
                $('.fv-plugins-message-container').html('')
            })

            $('#franchise_details_modal_view').on('hidden.bs.modal', function(e) {
                $('.remove-media').click();
                franchiseAddForm[0].reset();
                KTImageInput.createInstances();
                $('.fv-plugins-message-container').html('')
            })

            var franchiseTableDT = $("#kt_datatable_fixed_header").DataTable({
                "fixedHeader": {
                    "header": true,
                    "headerOffset": 5
                },
                "scrollY": 300,
                "scrollX": true,
                pageLength: 10,
                filter: true,
                deferRender: true,
                scrollCollapse: true,
                "searching": true,
            });

            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                franchiseTableDT.search(e.target.value).draw();
            });
        })
    </script>

    <?php $this->load->view('modules/sub_modules/franchise/script/add_franchise.php'); ?>

    <?php $this->load->view('modules/sub_modules/franchise/script/view_franchise.php'); ?>

    <?php $this->load->view('modules/sub_modules/franchise/script/delete_franchise.php'); ?>

    <?php $this->load->view('modules/sub_modules/franchise/script/update_franchise.php'); ?>

</body>

</html>