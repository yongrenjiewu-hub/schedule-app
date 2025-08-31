<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>食事登録画面</title>
</head>
<body>
    <h1>食事登録画面</h1>

    <form method="POST" action="{{route('meal.store')}}">
        @csrf
        <div>
            <h3>食事名</h3>
            <input type="text" name="food_name" placeholder="食事名" required>
        </div>

        <div>
            <h3>食事形態</h3>
            <input type="text" name="food_form" placeholder="食事形態" required><br>
            </div>
        </div>
    
        <button type="submit">登録</button>
    </form>
</body>
</html>