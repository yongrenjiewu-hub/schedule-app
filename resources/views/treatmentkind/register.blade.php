<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>治療登録</title>
</head>
<body>
    <h1>治療登録</h1>

    <form method="POST" action="{{route('treatmentkind.store')}}">
        @csrf
        <div>
            <h3>カテゴリー</h3>
            <input type="text" name="category" placeholder="カテゴリー" required>
        </div>

        <div>
            <h3>キー</h3>
            <input type="text" name="key" placeholder="キー" required><br>
            </div>
        </div>

        <div>
            <h3>ケア名</h3>
            <input type="text" name="value" placeholder="治療名" required><br>
            </div>
        </div>
    
        <button type="submit">登録</button>
    </form>
    
</body>
</html>