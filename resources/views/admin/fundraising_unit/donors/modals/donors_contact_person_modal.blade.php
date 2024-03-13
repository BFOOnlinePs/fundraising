<div id="donors-contact-person-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="donors_create_form">
                <input type="hidden" id="contact_person_donors_id">
                <div class="modal-header">
                    <h4 class="modal-title">Donors create</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact person name</label>
                                <input type="text" id="contact_person_name" class="form-control" placeholder="Contact person name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact person phone</label>
                                <input type="text" id="contact_person_phone" class="form-control" placeholder="Contact person phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact person email</label>
                                <input type="text" id="contact_person_email" class="form-control" placeholder="Contact person email">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact person gender</label>
                                <select required class="form-control" name="" id="contact_person_gender">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact person position</label>
                                <input type="text" id="contact_person_position" class="form-control" placeholder="Contact person position">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""></label>
                                <br>
                                <button type="button" class="btn btn-success" onclick="contact_person_create()"><span class="fa fa-plus"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div id="contact_person_table">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button onclick="button_close_modal()" type="button" class="btn btn-info waves-effect waves-light">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
