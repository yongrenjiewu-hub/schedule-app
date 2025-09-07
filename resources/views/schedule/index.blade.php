<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スケジュール</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f8fa;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.5em;
        }

        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }

        .patient-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }

        .patient-section h3 {
            margin-top: 0;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }

        li {
            background-color: #f1f1f1;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
        }

        form {
            display: inline;
        }

        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-left: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }

        strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>スケジュール</h1>
    <a href="{{ route('assigned.index') }}">My患者へ</a>
</header>

<main>
    <h2>担当患者数: {{ $assignedPatients->count() }}名</h2>

    @foreach ($patients as $patient)
        <div class="patient-section">
            <h3>{{ $patient->pt_name }}</h3>
            

            @foreach ($patient->ptSchedules as $schedule)
                <div>
                    <strong>{{ \Carbon\Carbon::parse($schedule->daily_schedule_date)->format('Y-m-d') }}</strong>
                    <ul>
                        @foreach ($schedule->sortedItems as $item)
                            <li>
                                {{ $item['label'] }}: {{ $item['value'] }}（{{ $item['time'] }}）

                                @if (!empty($item['deleteRoute']))
                                    <form method="POST" action="{{ $item['deleteRoute'] }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endforeach

</main>


</body>
</html>
