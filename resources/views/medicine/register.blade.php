<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>薬登録</title>
</head>
<body>
    <h1>薬情報登録</h1>

    <form method="POST" action="{{route('medicine.store')}}">
        @csrf
        <div>
            <h3>種類</h3>
            <input type="text" name="kinds" placeholder="種類" required>
        </div>

        <div>
            <h3>薬</h3>
            <input type="text" name="drug_name" placeholder="薬剤名" required>
        </div>

        <div>
            <h3>用法</h3>
            <input type="text" name="usage" placeholder="用法" required>
        </div>

        <div>
            <h3>用量</h3>
            <input type="text" name="dose" placeholder="用量" required>
        </div>
    
        <button type="submit">登録</button>
    </form>
</body>
</html>