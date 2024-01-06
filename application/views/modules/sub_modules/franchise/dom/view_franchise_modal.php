<div class="modal fade" id="franchise_details_modal_view" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="franchise_view_details_form" class="form" method="post" enctype="multipart/form-data"
                    novalidate="novalidate" data-kt-redirect-url="<?= BASE_URL ?>/modules/franchise" action="#">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Franchise Details</h1>
                        <div class="text-muted fw-semibold fs-5">
                            Enter franchise details for listing on Maharsahtra Udyog</a>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Franchise Name</span>
                        </label>
                        <input type="text" class="form-control required" placeholder="Enter Franchise Name"
                            name="franchise_name" disabled />
                    </div>
                    <div class="row mb-5 fv-row">
                        <div class="col-12 col-md-3">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Franchise Logo</span>
                            </label>
                            <div class="pb-2 mt-0 text-center">
                                <div class="symbol symbol-160px">
                                    <img class="rounded-4" src="<?= PUBLIC_ASSETS_URL ?>/assets/media/avatars/300-6.jpg"
                                        name="franchise_logo" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Franchise Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_details" maxlength="2048"
                                    data-kt-autosize="true" rows="6" id="franchise_details"
                                    placeholder="Franchise Details" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Business Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_business_details" maxlength="2048"
                                    data-kt-autosize="true" rows="6" id="franchise_business_details"
                                    placeholder="Business Details" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Investment Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_investment_details" maxlength="2048"
                                    data-kt-autosize="true" rows="6" id="franchise_investment_details"
                                    placeholder="Investment Details" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row franchiseImageGalleryMaster d-none">
                        <div id="franchise_image_gallery_repeat">
                            <div class="row mb-5">
                                <div class="col-12">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Franchise Image Gallery</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row franchise_image_repeat"></div>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row franchiseVideoGalleryMaster d-none">
                        <div id="franchise_video_gallery_repeat">
                            <div class="row mb-3">
                                <div class="col-12 col-md-10">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Franchise Video Gallery</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row franchise_video_repeat"></div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Royalty commission</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_royalty_comm"
                                    maxlength="2048" data-kt-autosize="true" rows="6"
                                    placeholder="Franchise Royalty Commision" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Anticipated Return on Investment</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_roi" maxlength="2048"
                                    data-kt-autosize="true" rows="6"
                                    placeholder="Anticipated Return on Investment in Percentage (%)"
                                    disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Payback period of the Capital for
                                Franchise</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_payback" maxlength="2048"
                                    data-kt-autosize="true" rows="6"
                                    placeholder="Payback period of the Capital for Franchise" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Property type required for this
                                Franchise</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_property" maxlength="2048"
                                    data-kt-autosize="true" rows="6" placeholder="Franchise property type"
                                    disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Floor Area</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_floor_area" maxlength="2048"
                                    data-kt-autosize="true" rows="6" placeholder="Floor Area in Square Feet (Sq/Feet)"
                                    disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Preferred Location Area</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_pref_location"
                                    maxlength="2048" data-kt-autosize="true" rows="6"
                                    placeholder="Preferred Location area for Franchisee Outlet" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="fs-6 fw-semibold mb-2 required">Operating Manual</label>
                        <div class="py-2 mt-0">
                            <textarea class="form-control" placeholder="Operating Manual" maxlength="2048" rows="8"
                                data-kt-autosize="true" name="franchise_operating_manual"
                                id="franchise_operating_manual" disabled></textarea>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Franchise Training Location</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" data-kt-autosize="true" maxlength="2048"
                                    name="franchise_training_loc" rows="6" placeholder="Franchise Training Location"
                                    disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Duration of Franchise Term</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" maxlength="2048" data-kt-autosize="true"
                                    name="franchise_term_duration" rows="6" placeholder="Duration of Franchise Term"
                                    disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row">
                        <div class="col-12 col-md-9">
                            <label class="fs-6 fw-semibold required">Is the field assistant available</label>
                            <div class="fs-7 fw-semibold text-muted">Lorem ipsum dolor sit amet
                                consectetur
                                adipisicing elit
                            </div>
                        </div>
                        <div class="col-12 col-md-3 text-center">
                            <label
                                class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value=""
                                    name="franchise_field_assistant" disabled />
                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row">
                        <div class="col-12 col-md-9">
                            <label class="fs-6 fw-semibold required">Does the franchise have an Agreement</label>
                            <div class="fs-7 fw-semibold text-muted">Lorem ipsum dolor sit amet
                                consectetur
                                adipisicing elit</div>
                        </div>
                        <div class="col-12 col-md-3 text-center">
                            <label
                                class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value="" name="franchise_agreement"
                                    disabled />
                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row">
                        <div class="col-12 col-md-9">
                            <label class="fs-6 fw-semibold required">Can the term be renewed later</label>
                            <div class="fs-7 fw-semibold text-muted">Lorem ipsum dolor sit amet
                                consectetur
                                adipisicing elit</div>
                        </div>
                        <div class="col-12 col-md-3 text-center">
                            <label
                                class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value="" name="franchise_term_renew"
                                    disabled />
                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                            </label>
                        </div>
                    </div>
                    <div class="pt-5 d-flex justify-content-evenly">
                        <button type="reset" data-bs-dismiss="modal"
                            class="btn btn-outline btn-outline-dashed btn-outline-primary me-5">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>