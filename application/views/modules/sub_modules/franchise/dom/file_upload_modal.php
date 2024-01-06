<div class="modal fade bg-black bg-opacity-50" id="franchise_image_upload_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style="z-index: 10000;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end"></div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="franchise_image_upload_form" class="form" method="post" enctype="multipart/form-data" novalidate="novalidate" action="<?= BASE_URL ?>/modules/upload_file">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">File Upload</h1>
                        <div class="text-muted fw-semibold fs-5">
                            Choose File to Upload</a>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12 fv-row">
                            <label class="fs-6 fw-semibold mb-2 required">File Input</label>
                            <div class="py-2 mt-0">
                                <input type="file" class="form-control" name="uploaded_file" required>
                            </div>
                        </div>
                    </div>
                    <div class="pt-5 d-flex justify-content-evenly">
                        <button type="reset" data-bs-dismiss="modal" class="btn btn-outline btn-outline-dashed btn-outline-danger me-5">Cancel</button>
                        <button type="submit" id="submit_file" class="btn btn-outline btn-outline-dashed btn-outline-success">
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