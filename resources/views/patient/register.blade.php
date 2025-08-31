<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>患者登録</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f2f2f2;
            padding: 10px 20px;
            border-bottom: 2px solid #ccc;
        }

        .header-left h1 {
            margin: 0;
            font-size: 1.8rem;
            color: #333;
        }

        .header-right a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .header-right a:hover {
            text-decoration: underline;
        }

        form {
            max-width: 600px;
            margin: auto;
            background: #fafafa;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        form h3 {
            margin-bottom: 5px;
        }

        form input, form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .error-messages {
            color: red;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

<header>
    <div class="header-left">
        <h1>患者登録</h1>
    </div>
    <div class="header-right">
        <a href="{{ route('patient.index') }}">患者一覧へ戻る</a>
    </div>
</header>

@if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('patient.store') }}">
    @csrf

    <div>
        <h3>部屋番号</h3>
        <input type="number" name="room_id" value="1" required>
    </div>

    <div>
        <h3>氏名</h3>
        <input type="text" name="pt_name" placeholder="氏名" required>
    </div>

    <div>
        <h3>性別</h3>
        <select name="sex" required>
            <option value="">選択して下さい</option>
            <option value="0">男性</option>
            <option value="1">女性</option>
            <option value="2">Non-binary</option>
        </select>
    </div>

    <div>
        <h3>血液型</h3>
        <select name="blood_type" required>
            <option value="">選択して下さい</option>
            <option value="0">A</option>
            <option value="1">B</option>
            <option value="2">O</option>
            <option value="3">AB</option>
        </select>
    </div>

    <div>
        <h3>生年月日</h3>
        <input type="text" name="birthday" placeholder="例: 1980-01-01" required onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}">
    </div>

    <div>
        <h3>疾患名</h3>
        <select name="disease_id" required>
            <option value="">選択して下さい</option>
            @foreach ($diseases as $disease)
                <option value="{{ $disease->disease_id }}">{{ $disease->disease_name }}</option>
            @endforeach
        </select>
        
    </div>

    <div>
        <h3>電話番号</h3>
        <input type="tel" name="tell_number" placeholder="例: 09012345678" required>
    </div>

    <div>
        <h3>キーパーソン</h3>
        <input type="text" name="key_person" placeholder="キーパーソン名" required>
    </div>

    <div>
        <h3>主治医</h3>
        <input type="text" name="Dr_name" placeholder="主治医名" required>
    </div>

    <button type="submit">登録</button>
</form>

</body>
</html>
