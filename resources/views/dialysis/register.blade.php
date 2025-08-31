<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>透析情報登録</title>
</head>
<body>
    <h1>透析情報登録</h1>

    <form method="POST" action="{{route('dialysis.store')}}">
        @csrf
        <div>
            <h3>部位</h3>
            <input type="text" name="part" placeholder="部位" required>
        </div>

        <div>
            <h3>曜日</h3>
            <input type="text" name="dialysis_day" placeholder="曜日" required><br>
            </div>
        </div>
    
        <button type="submit">登録</button>
    </form>
</body>
</html>