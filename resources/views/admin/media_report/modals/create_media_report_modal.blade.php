<div id="media-report-create-modal" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add Media Report</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="col-md-12" action="{{ route('users.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <label for="">Image</label>
                                            <br>
                                            <img style="width: 200px" src="{{ asset('img/avatar.png') }}" alt="">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
