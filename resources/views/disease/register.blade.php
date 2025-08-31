<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>疾患登録</title>
</head>
<body>
    <h1>疾患情報登録</h1>

    <form method="POST" action="{{route('disease.store')}}">
        @csrf
        <div>
            <h3>疾患名</h3>
            <input type="text" name="disease_name" placeholder="疾患名" required>
        </div>
    
        <button type="submit">登録</button>
    </form>
</body>
</html>