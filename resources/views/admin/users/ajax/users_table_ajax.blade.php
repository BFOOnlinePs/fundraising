<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <td>الاسم</td>
            <td>البريد الالكتروني</td>
            <td>صلاحية المستخدم</td>
            <td>العمليات</td>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="4" class="text-center">No data</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->email }}</td>
                    <td>
                        @if($key->user_role == 1)
                            Admin
                        @elseif($key->user_role == 2)
                            Recruiting money
                        @elseif($key->user_role == 3)
                            Employee
                        @elseif($key->user_role == 4)
                            Media officer
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit',['id'=>$key->id]) }}" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
