<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Ar title</th>
            <th style="width: 40%">En title</th>
            <th style="width: 20%">Operation</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No data</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td style="white-space:pre-wrap;word-wrap:break-word;" class="col-md-3" scope="row">{{ $key->title_ar }}</td>
                    <td style="white-space:pre-wrap;word-wrap:break-word;" class="col-md-3" scope="row">{{ $key->title_en }}</td>
                    <td class="col-md-2" scope="row">
                        @if(auth()->user()->user_role == 1)
                            <a href="{{ route('media_report.edit',['id'=>$key->id]) }}" class="btn btn-dark btn-sm"><span class="fa fa-edit"></span></a>
                        @elseif(auth()->user()->user_role == 3)
                            <a href="{{ route('media_report.edit',['id'=>$key->id]) }}" class="btn btn-dark btn-sm"><span class="fa fa-edit"></span></a>
                        @elseif(auth()->user()->user_role == 4)
                            <a href="{{ route('media_report.details',['id'=>$key->id]) }}" class="btn btn-dark btn-sm"><span class="fa fa-search"></span></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $data->links() }}
