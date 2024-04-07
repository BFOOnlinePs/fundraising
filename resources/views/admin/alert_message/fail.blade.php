@if(\Illuminate\Support\Facades\Session::has('fail'))
    <div class="alert alert-danger">
        <span>{{ \Illuminate\Support\Facades\Session::get('fail') }}</span>
    </div>
@endif
