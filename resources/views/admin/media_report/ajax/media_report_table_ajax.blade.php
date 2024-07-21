<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Ar title</th>
            <th style="width: 40%">En title</th>
            <th>Added By</th>
            <th>Insert at</th>
            <th style="width: 10%">Operation</th>
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
                    <td>{{ $key->title_ar }}</td>
                    <td>{{ $key->title_en }}</td>
                    <td>{{ $key->user->name ?? '' }}</td>
                    <td scope="row">{{ $key->created_at ?? '' }}</td>
                    <td>
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
