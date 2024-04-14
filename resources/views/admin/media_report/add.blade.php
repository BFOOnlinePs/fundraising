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
        /*.preview-item {*/
        /*    margin-right: 10px;*/
        /*    width: 20px; !* Adjust as needed *!*/
        /*    height: 60px; !* Adjust as needed *!*/
        /*    overflow: hidden;*/
        /*    position: relative;*/
        /*    display: inline-block;*/
        /*}*/
        /*.preview-item img {*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*    object-fit: cover;*/
        /*}*/
        .remove-btn {
            position: absolute;
            top: 2px; /* Adjust as needed */
            right: 2px; /* Adjust as needed */
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 2px;
            border-radius: 50%;
        }

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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('media_report.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Arabic title</label>
                                            <textarea  dir="rtl" type="text" class="form-control" name="title_ar" rows="4" placeholder="ضع عنوان"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">English title</label>
                                            <textarea required type="text" class="form-control" name="title_en" rows="4" placeholder="English title"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Arabic media report</label>
                                            <textarea required class="form-control" dir="rtl" name="media_report_content_ar" id="" cols="30" placeholder="اكتب وصف" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">English media report</label>
                                            <textarea required class="form-control" name="media_report_content_en" id="" cols="30" placeholder="English media report" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="">Project</label>
                                            ( <a href="{{ route('projects.add') }}">Add Project</a> )
                                            <select required class="form-control" onchange="get_activites_if_selected_project_ajax(this.value)" name="project_id" id="project_select">
                                                <option value="">Select project ...</option>
                                                @foreach($projects as $key)
                                                    <option value="{{ $key->id }}">{{ $key->project_name_en }}</option>
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
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Notes</label>
                                            <textarea name="notes" id="" cols="30" rows="2" placeholder="Notes" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Attachment</label>
                                            <input type="file" class="form-control" id="image-input" name="images[]" multiple accept="image/*">
                                        </div>
                                        <div class="preview-container row" id="image-preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <p style="font-size: 100px"><span class="fa fa-image"></span></p>
                                    <input required type="file" name="main_photo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    media_report.get_activites_if_selected_project_ajax
    <script>
        $(document).ready(function () {
            media_report_table_ajax();
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
                    const loader = $('<div>').addClass('loader col-md-3 d-flex justify-content-center align-items-center custom-container').text('Loading...'); // Add loader

                    reader.onloadstart = function() {
                        previewContainer.append(loader); // Show loader when loading starts
                    };

                    reader.onload = function(e) {
                        loader.remove(); // Remove loader when loading is complete
                        const removeBtn = $('<span>').addClass('remove-btn text-danger').html('&times;');
                        const img = new Image();

                        img.onload = function() {
                            // Create a canvas element
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');

                            // Set the maximum width and height for the resized image
                            const maxWidth = 250;
                            const maxHeight = 250;

                            // Calculate the new dimensions while maintaining aspect ratio
                            let width = img.width;
                            let height = img.height;

                            if (width > maxWidth || height > maxHeight) {
                                const aspectRatio = width / height;
                                if (width > height) {
                                    width = maxWidth;
                                    height = maxWidth / aspectRatio;
                                } else {
                                    height = maxHeight;
                                    width = maxHeight * aspectRatio;
                                }
                            }

                            // Set the canvas dimensions
                            canvas.width = width;
                            canvas.height = height;

                            // Draw the image onto the canvas
                            ctx.drawImage(img, 0, 0, width, height);

                            // Convert the canvas content to a data URL with compression
                            const quality = 0.6; // Adjust compression quality (0.6 is an example)
                            const compressedDataURL = canvas.toDataURL('image/jpeg', quality);

                            // Create an img element with the compressed image
                            const compressedImg = $('<img>').attr('src', compressedDataURL).addClass('img-preview');

                            // Create the preview item with the remove button and compressed image
                            const previewItem = $('<div>').addClass('preview-item col-md-3').append(removeBtn, compressedImg);

                            // Assign data attribute to remove button
                            $(removeBtn).attr('data-index', i);

                            // Add click event listener to remove button
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

                            // Append the preview item to the preview container
                            previewContainer.append(previewItem);
                        };

                        // Set the src attribute of the image to the data URL
                        img.src = e.target.result;
                    };

                    // Read the file as a data URL
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
                const src = $(this).attr('src');
                $('#preview-image').attr('src', src);
                $('#standard-modal').modal('show');
            });
        });
    </script>
@endsection
