<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOOKIS</title>
</head>
<body>
<table>
        @foreach($users as $user)
    <tr>
            <td>
                {{$user->id}}
            </td>
    </tr>
        @endforeach
</table>
</body>
</html>