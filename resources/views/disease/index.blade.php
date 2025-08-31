<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>疾患</title>
</head>
<body>
    <h1>疾患情報</h1>

    <a href="{{route('patient.index')}}">患者一覧へ</a>

    <ul>
    @foreach ($m_disease as $disease)
        <li>
            {{$disease->disease_name}}
        </li>
    @endforeach

    </form>
    </ul>
    
</body>
</html>