@foreach($data as $key)
    <a target="_blank" href="{{ asset('storage/media_report/'.$key->filename_with_extension) }}" class="col-md-3">
        <div class="card border p-3 m-3">
            <div class="card-body">
                <h4><p class="bg-success-subtle rounded-circle p-2 float-start text-center" style="width: 30px;height: 30px">{{ ($loop->index) + 1 }}</p> <p class="h4" style="margin-left: 40px">{{ $key->extension }}</p></h4>
                <hr>
                <h5>{{ $key->filename_with_extension }}</h5>
            </div>
        </div>
    </a>
@endforeach
