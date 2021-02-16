@extends('layers.parts.master')
@section('content')
<table>
        @foreach($users as $user)
    <tr>
            <td>
                {{$user->id}}
            </td>
    </tr>
        @endforeach
</table>
@endsection
</body>
</html>
