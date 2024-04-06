<div id="user-create-modal" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add User</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="col-md-12" action="{{ route('users.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group mt-2">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Phone 1</label>
                                            <input type="text" name="user_phone1" class="form-control" placeholder="Phone 1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Phone 2</label>
                                            <input type="text" name="user_phone2" class="form-control" placeholder="Phone 2">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Role</label>
                                            <select class="form-control" name="user_role" id="">
                                                <option value="">Select role ...</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Recruiting money</option>
                                                <option value="3">Employee</option>
                                                <option value="4">Media officer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Address</label>
                                            <textarea class="form-control" name="user_address" id="" cols="30" rows="2" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Notes</label>
                                            <textarea class="form-control" name="user_notes" id="" cols="30" rows="2" placeholder="Notes"></textarea>
                                        </div>
                                    </div>
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
