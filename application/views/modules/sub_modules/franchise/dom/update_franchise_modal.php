<div class="modal fade" id="franchise_details_modal_update" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                <form id="franchise_update_details_form" class="form" method="post" enctype="multipart/form-data" novalidate="novalidate" data-kt-redirect-url="<?= BASE_URL ?>/modules/franchise" action="<?= BASE_URL ?>/modules/update_franchise">
                    <input type="hidden" name="franchise_id_update">
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
                        <input type="text" class="form-control required" placeholder="Enter Franchise Name" name="franchise_name" />
                    </div>
                    <div class="row mb-5 fv-row">
                        <div class="col-12 col-md-3">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Franchise Logo</span>
                            </label>
                            <div class="py-2 mt-0 text-center">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?= PUBLIC_ASSETS_URL ?>/assets/media/svg/avatars/blank.svg)">
                                    <div class="image-input-wrapper" style="background-image: url(<?= PUBLIC_ASSETS_URL ?>/assets/media/svg/avatars/blank.svg)" name="franchise_logo">
                                    </div>
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="file" name="franchise_updated_logo" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="franchise_logo_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow remove-media" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Franchise Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_details" maxlength="2048" data-kt-autosize="true" rows="6" id="franchise_details" placeholder="Franchise Details"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Business Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_business_details" maxlength="2048" data-kt-autosize="true" rows="6" id="franchise_business_details" placeholder="Business Details"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Investment Details</label>
                            <div class="py-2 mt-0">
                                <textarea class="form-control" name="franchise_investment_details" maxlength="2048" data-kt-autosize="true" rows="6" id="franchise_investment_details" placeholder="Investment Details"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row">
                        <div id="franchise_image_gallery_update_repeat">
                            <div class="row mb-5">
                                <div class="col-12 col-md-10">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Franchise Image Gallery</span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-2 text-end">
                                    <div class="form-group">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row franchise_image_repeat" data-repeater-list="franchise_image_gallery_update_repeat">
                                <div class="franchise_image_repeat">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 fv-row">
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
                                <textarea type="text" class="form-control" name="franchise_royalty_comm" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Franchise Royalty Commision"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Anticipated Return on Investment</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_roi" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Anticipated Return on Investment in Percentage (%)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Payback period of the Capital for
                                Franchise</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_payback" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Payback period of the Capital for Franchise"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Property type required for this
                                Franchise</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_property" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Franchise property type"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Floor Area</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_floor_area" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Floor Area in Square Feet (Sq/Feet)"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Preferred Location Area</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" name="franchise_pref_location" maxlength="2048" data-kt-autosize="true" rows="6" placeholder="Preferred Location area for Franchisee Outlet"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="fs-6 fw-semibold mb-2 required">Operating Manual</label>
                        <div class="py-2 mt-0">
                            <textarea class="form-control" placeholder="Operating Manual" maxlength="2048" rows="8" data-kt-autosize="true" name="franchise_operating_manual" id="franchise_operating_manual"></textarea>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Franchise Training Location</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" data-kt-autosize="true" maxlength="2048" name="franchise_training_loc" rows="6" placeholder="Franchise Training Location"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">Duration of Franchise Term</label>
                            <div class="py-2 mt-0">
                                <textarea type="text" class="form-control" maxlength="2048" data-kt-autosize="true" name="franchise_term_duration" rows="6" placeholder="Duration of Franchise Term"></textarea>
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
                            <label class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value="" name="franchise_field_assistant" />
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
                            <label class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value="" name="franchise_agreement" />
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
                            <label class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-evenly">
                                <span class="form-check-label fw-semibold text-muted me-3">No</span>
                                <input class="form-check-input" type="checkbox" value="" name="franchise_term_renew" />
                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                            </label>
                        </div>
                    </div>
                    <div class="pt-5 d-flex justify-content-evenly">
                        <button type="reset" data-bs-dismiss="modal" class="btn btn-outline btn-outline-dashed btn-outline-danger me-5">Cancel</button>
                        <button type="submit" id="update_franchise_details" class="btn btn-outline btn-outline-dashed btn-outline-success">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>