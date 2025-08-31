<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>治療情報</title>
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
        }

        li.treatment-item {
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
        <h1>{{ $patient->pt_name ?? '患者名不明' }} の治療情報</h1>
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
    <h2>治療</h2>

    @if ($patient)
        @forelse ($patient->ptSchedules as $schedule)
            @php
                $treatments = $schedule->treatmentkind ?? collect();
            @endphp

            @if ($treatments->isEmpty())
                <div class="no-data">治療なし（スケジュールID: {{ $schedule->pt_schedule_id }}）</div>
            @else
                <div class="no-data">スケジュールID: {{ $schedule->pt_schedule_id }}</div>
                <ul>
                    @foreach ($treatments as $treatment)
                        @php $master = $treatment->treatmentkindMaster; @endphp
                        @if ($master)
                            @foreach (['Ftreatment_date', 'Streatment_date', 'Ttreatment_date'] as $timeField)
                                @if (!empty($master->$timeField))
                                    <li class="treatment-item">
                                        治療: {{ $master->value ?? '未設定' }}（{{ $master->$timeField }}）
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            @endif
        @empty
            <div class="no-data">スケジュールがありません。</div>
        @endforelse
    @else
        <div class="no-data">患者が選択されていません。</div>
    @endif

</main>

</body>
</html>
