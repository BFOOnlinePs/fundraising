@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('style')
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 10px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection
@section('content')
    @include('alert_message.success')
    @include('alert_message.fail')
    <form action="{{ route('media_report.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Edit Media Report</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 border rounded p-4  text-center" id="main_photo_div">
                                <div class="form-group">
                                    <label for="">Choose a featured image</label>
                                    <br>
                                    @if(empty($data->main_photo))
                                        <img style="width: 250px;font-size: 150px" class="fa fa-image" id="main_photo_img" alt="" src="">
                                    @else
                                        <img style="width: 250px" id="main_photo_img" src="{{ asset('storage/media_report/'.$data->main_photo) }}" alt="">
                                    @endif
                                    <input @if(empty($data->main_photo)) required @endif type="file" id="main_photo" name="main_photo" class="form-control" style="display: none;">
                                </div>
                            </div>
                            <div class="col-md-7 text-center">
                                <h3>Edit Media Report</h3>
                                <hr>
                                <p>
                                    can edit article through the following form, where you must enter all the required information for the article. It will be reviewed and published across electronic platforms.
                                    <br>
                                    <br>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <label for="">Notes</label>
                                        <textarea name="notes" id="" cols="30" rows="4" placeholder="Notes" class="form-control">{{ $data->notes }}</textarea>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6>English Content</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Media Title</label>
                                    <textarea required type="text" class="form-control" name="title_en" rows="3" placeholder="Media Title">{{ $data->title_en }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-2">
                                    <label for="">Media Report</label>
                                    <textarea required class="form-control" name="media_report_content_en" id="" cols="30" placeholder="Media Report" rows="6">{{ $data->media_report_content_en }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" dir="rtl">
                        <h6>المحتوى بالعربية</h6>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">عنوان الخبر الاعلامي</label>
                                <textarea  dir="rtl" type="text" class="form-control" name="title_ar" rows="3" placeholder="عنوان الخبر الاعلامي">{{ $data->title_ar }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-2">
                                <label for="">المحتوى</label>
                                <textarea required class="form-control" dir="rtl" name="media_report_content_ar" id="" cols="30" placeholder="المحتوى" rows="6">{{ $data->media_report_content_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Project Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Project</label>
                                            ( <a href="{{ route('projects.add') }}">Add Project</a> )
                                            <select required class="form-control" onchange="get_activites_if_selected_project_ajax(this.value)" name="project_id" id="project_select">
                                                <option value="">Select project ...</option>
                                                @foreach($projects as $key)
                                                    <option @if($data->project_id == $key->id) selected @endif value="{{ $key->id }}">{{ $key->project_name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Activity</label>
                                            <select required disabled class="form-control" name="activity_id" id="activity_select">
                                                <option value="">Select activity ...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="card">
                <div class="card-header">
                    <h4>Add Photos and Pictures</h4>
                    <br>
                    <p>You can add images, which will be resized and uploaded to be suitable for publishing.</p>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group mt-2">
                            <label for="">Attachment</label>
                            <input type="file" class="form-control" id="image-input" name="images[]" multiple accept="image/*">
                        </div>
                        <div class="preview-container row" id="image-preview"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="card">
                <div class="card-header">
                    <h4>Attach Other Files</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group mt-2">
                            <label for="">Attachment</label>
                            <input type="file" class="form-control" id="other_file_input" name="other_images[]" multiple>
                        </div>
                        <div class="preview-container row" id="other_file_preview"></div>
                    </div>
                </div>
            </div>
        </div>
        <button style="" type="submit" class="mt-2 btn btn-success">Save</button>
    </form>

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="" class="img-fluid" alt="Image Preview" id="preview-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            media_report_table_ajax();
            attachment_ajax({{ $data->id }});
            list_other_image_ajax({{ $data->id }});
            get_activites_if_selected_project_ajax({{ $data->project_id }});
        });
        function media_report_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.media_report_table_ajax') }}",
                datatype:'json',
                data:{
                    'search' : $('#search_input').val()
                },
                success:function(data){
                    $('#media_report_table_ajax').html(data.view);
                },
                error:function(){

                }
            })
        }

        function get_activites_if_selected_project_ajax(project_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.get_activites_if_selected_project_ajax') }}",
                datatype:'json',
                data:{
                    'project_id' : project_id
                },
                success:function(response){
                    if(response.success == 'true'){
                        if(response.data.length > 0){
                            var activities = response.data;
                            $.each(activities, function (key,value) {
                                $('#activity_select').append(`<option value="${value.activity.id}">${value.activity.activity_name_en}</option>`);
                            })

                            $('#activity_select').prop('disabled', false);
                            $('#activity_select').val({{ $data->activity_id }});
                        }
                        else{
                            $('#activity_select').empty();
                            $('#activity_select').prop('disabled', true);
                        }
                    }
                },
                error:function(){

                }
            })
        }

        $(document).ready(function() {
            $('#image-input').on('change', function() {
                const files = $(this)[0].files;
                const previewContainer = $('#image-preview');

                if (files.length === 0) {
                    console.log('No files selected.');
                    return; // No files selected, exit the function
                }

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    const loader = $('<div>').addClass('loader col-md-3').text('Loading...'); // Add loader

                    reader.onloadstart = function() {
                        previewContainer.append(loader); // Show loader when loading starts
                    };

                    reader.onload = function(e) {
                        loader.remove(); // Remove loader when loading is complete
                        const removeBtn = $('<p>').addClass('remove-btn text-danger').html('&times;');
                        const img = $('<img>').attr('src', e.target.result).attr('width', '250px').addClass('img-preview img-fluid avatar-md rounded');
                        const previewItem = $('<div>').addClass('preview-item').addClass('col-md-3').append(removeBtn, img);

                        // Assign data attribute to remove button
                        $(removeBtn).attr('data-index', i);

                        removeBtn.on('click', function() {
                            const index = $(this).attr('data-index');
                            $(this).closest('.preview-item').remove();
                            // Remove corresponding file from cloned input
                            const fileName = files[index].name;
                            const clonedInput = $('#image-input-clone')[0];
                            $(clonedInput).val(''); // Clear cloned input value
                            const files = clonedInput.files;
                            for (let j = 0; j < files.length; j++) {
                                if (files[j].name !== fileName) {
                                    $(clonedInput).prop('files').push(files[j]); // Add back other files
                                }
                            }
                        });

                        previewContainer.append(previewItem);
                    };

                    reader.readAsDataURL(file);
                }

                // Clone the input field and hide the original
                const clonedInput = $(this).clone().attr('id', 'image-input-clone').hide();
                $(this).after(clonedInput);
                // Clear the file input to allow selecting additional images
                $(this).val('');
            });

            // Add click event listener to dynamically generated images
            $(document).on('click', '.img-preview', function() {
                console.log($(this).attr('src'));
                const src = $(this).attr('src');
                $('#preview-image').attr('src', src);
                $('#standard-modal').modal('show');
            });
        });

        function get_image_path_for_modal(src) {
            $('#preview-image').attr('src', src);
            $('#standard-modal').modal('show');
        }


        {{--$(document).ready(function() {--}}
        {{--    // Storing existing attachments--}}
        {{--    const existingAttachments = {!! json_encode($attachments) !!};--}}
        {{--    const previewContainer = $('#image-preview');--}}

        {{--    existingAttachments.forEach(function(attachment, index) {--}}
        {{--        displayAttachment(attachment, index);--}}
        {{--    });--}}

        {{--    function displayAttachment(attachment, index) {--}}
        {{--        const removeBtn = $('<span>').addClass('remove-btn text-danger').html('&times;');--}}
        {{--        const imgSrc = '<?= asset("storage/attachments/") ?>' + '/' + attachment.file;--}}
        {{--        const img = $('<img>').attr('src', imgSrc).attr('width','250px');--}}
        {{--        const previewItem = $('<div>').addClass('preview-item').addClass('col-md-3').append(removeBtn, img);--}}

        {{--        $(removeBtn).attr('data-index', index);--}}

        {{--        removeBtn.on('click', function() {--}}
        {{--            const imageId = attachment.id; // Assuming attachment has an 'id' property--}}
        {{--            const deletedImagesInput = $('<input>').attr('type', 'hidden').attr('name', 'deleted_images[]').val(imageId);--}}
        {{--            $(this).closest('.preview-item').append(deletedImagesInput);--}}
        {{--            $(this).closest('.preview-item').remove();--}}
        {{--        });--}}

        {{--        previewContainer.append(previewItem);--}}
        {{--    }--}}

        {{--    // Handling new image uploads--}}
        {{--    $('#image-input').on('change', function() {--}}
        {{--        const files = $(this)[0].files;--}}

        {{--        if (files.length === 0) {--}}
        {{--            console.log('No files selected.');--}}
        {{--            return; // No files selected, exit the function--}}
        {{--        }--}}

        {{--        const newImages = [];--}}

        {{--        for (let i = 0; i < files.length; i++) {--}}
        {{--            const file = files[i];--}}
        {{--            const reader = new FileReader();--}}

        {{--            reader.onload = function(e) {--}}
        {{--                const imgData = e.target.result;--}}
        {{--                newImages.push(imgData);--}}
        {{--                displayNewImage(imgData);--}}
        {{--            };--}}

        {{--            reader.readAsDataURL(file);--}}
        {{--        }--}}

        {{--        // Store new images array somewhere or send it to the controller--}}
        {{--        console.log(newImages);--}}
        {{--    });--}}

        {{--    function displayNewImage(imageData) {--}}
        //         const removeBtn = $('<span>').addClass('remove-btn text-danger').html('&times;');
        //         const img = $('<img>').attr('src', imageData).attr('width','250px');
        //         const previewItem = $('<div>').addClass('preview-item').addClass('col-md-3').append(removeBtn, img);

        {{--        removeBtn.on('click', function() {--}}
        {{--            $(this).closest('.preview-item').remove();--}}
        {{--        });--}}

        {{--        previewContainer.append(previewItem);--}}
        {{--    }--}}
        {{--});--}}


        function delete_image_ajax(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.delete_image_ajax') }}",
                datatype:'json',
                data:{
                    'id' : id
                },
                success:function(data){
                    attachment_ajax({{ $data->id }});
                },
                error:function(){

                }
            })
        }

        function attachment_ajax(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.attachment_ajax') }}",
                datatype:'json',
                data:{
                    'id' : id
                },
                success:function(data){
                    $('#image-preview').html(data.view);
                },
                error:function(){

                }
            })
        }

        function list_other_image_ajax(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.list_other_image_ajax') }}",
                datatype:'json',
                data:{
                    'id' : id
                },
                success:function(data){
                    $('#other_file_preview').html(data.view);
                },
                error:function(){

                }
            })
        }

        function delete_other_attachment_ajax(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.delete_other_attachment_ajax') }}",
                datatype:'json',
                data:{
                    'id' : id
                },
                success:function(data){
                    if(data.success === 'true'){
                        $('#media_report_attachment_'+id).remove();
                    }
                },
                error:function(){

                }
            })
        }

        $(document).ready(function () {
            $('#main_photo').change(function (e) {
                var file = e.target.files[0];
                if(file){
                    $('#main_photo_img').attr({src:URL.createObjectURL(file),width:'250px'});
                }
            })
        });
        $(document).ready(function() {
            var clickFlag = false;

            // Attach click event handler to the div
            $('#main_photo_div').click(function() {
                if (!clickFlag) {
                    clickFlag = true;
                    // Trigger click on the file input
                    $('#main_photo').click();
                }
            });

            // Listen for changes in the file input
            $('#main_photo').change(function() {
                // Handle file selection here, if needed
                var file = $(this).prop('files')[0];
                // Reset the click flag
                clickFlag = false;
            });
        });

    </script>

@endsection
