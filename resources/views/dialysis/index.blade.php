<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>透析情報</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            width: 100%;
            background-color: #f2f2f2;
            padding: 15px 30px;
            border-bottom: 2px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }

        .header-left h1 {
            margin: 0;
            font-size: 1.5rem;
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

        main {
            width: 100%;
            max-width: 600px;
            background: #fafafa;
            padding: 30px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            margin-top: 30px;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li.dialysis-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 0 3px rgba(0,0,0,0.1);
        }

        .no-data {
            text-align: center;
            color: #999;
            font-style: italic;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <h1>{{ $patient->pt_name ?? '患者名不明' }} の透析情報</h1>
    </div>
    <div class="header-right">
        @if(isset($patient))
            <a href="{{ route('patient.information', $patient->pt_id) }}">
                患者情報へ戻る
            </a>
        @endif
    </div>
</header>

<main>
    <h2>透析履歴</h2>

    @if($patient->ptSchedules->isEmpty())
        <div class="no-data">スケジュールなし</div>
    @else
        <ul>
            @foreach($patient->ptSchedules as $schedule)
                @if($schedule->dialysis->isNotEmpty())
                    @foreach($schedule->dialysis as $dialysis)
                        <li class="dialysis-item">
                            部位: {{ optional($dialysis->dialysisMaster)->part ?? '未設定' }}<br>
                            日: {{ optional($dialysis->dialysisMaster)->dialysis_day ?? '未設定' }}
                        </li>
                    @endforeach
                @else
                    <li class="no-data">透析データなし</li>
                @endif
            @endforeach
        </ul>
    @endif

    
</main>

</body>
</html>
