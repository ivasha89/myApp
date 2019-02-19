<!doctype html>
<html lang="en">
<head>
        <title>Document</title>
</head>
<body>

    <ul>
        @foreach ($slbs as $slb)
            <li>{{ $slb->stts }}</li>
        @endforeach
    </ul>

</body>
</html>