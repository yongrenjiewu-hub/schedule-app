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

    @foreach ($assignedPatients as $assigned)
    <div class="patient-section">
        <h3>{{ $assigned->patient->pt_name }}</h3>

        @foreach ($assigned->patient->ptSchedules as $schedule)
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



    
    {{-- @foreach ($assignedPatients as $assigned)
    <div class="patient-section">
        <h3>{{ $assigned->patient->pt_name }}</h3>

        @foreach ($assigned->patient->ptSchedules as $schedule)
            <div>
                <strong>{{ \Carbon\Carbon::parse($schedule->daily_schedule_date)->format('Y-m-d') }}</strong>
                <ul>
                    {{-- ケア --}}
                    {{-- @foreach ($schedule->carekind as $care)
                        @php $master = $care->carekindMaster; @endphp
                        @if ($master)
                            @foreach (['Fcare_date', 'Scare_date', 'Tcare_date'] as $timeField)
                                @if (!empty($master->$timeField))
                                    <li>
                                        看護ケア: {{ $master->value ?? '未設定' }}（{{ $master->$timeField }}）
                                        @if (isset($care->t_care_kind_id))
                                            <form method="POST" action="{{ route('schedule.carekind.destroy', ['id' => $care->t_care_kind_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">削除</button>
                                            </form>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach    --}}

                    {{-- 治療 --}}
                    {{-- @foreach ($schedule->treatmentkind as $treatment)
                        @php $master = $treatment->treatmentkindMaster; @endphp
                        @if ($master)
                            @foreach (['Ftreatment_date', 'Streatment_date', 'Ttreatment_date'] as $timeField)
                                @if (!empty($master->$timeField))
                                    <li>
                                        治療: {{ $master->value ?? '未設定' }}（{{ $master->$timeField }}）
                                        @if (isset($treatment->t_treatment_kind_id))
                                            <form method="POST" action="{{ route('schedule.treatmentkind.destroy', ['id' => $treatment->t_treatment_kind_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">削除</button>
                                            </form>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach --}}

                    {{-- 透析 --}}
                    {{-- @foreach ($schedule->dialysis as $dialysis)
                        @if ($dialysis->dialysisMaster)
                            <li>
                                透析: {{ $dialysis->dialysisMaster->part }} {{ $dialysis->dialysisMaster->dialysis_day }}
                                （{{ $dialysis->dialysisMaster->dialysis_date ?? '時間未設定' }}）
                                @if (isset($dialysis->pt_dialysis_id))
                                    <form method="POST" action="{{ route('schedule.dialysis.destroy', ['id' => $dialysis->pt_dialysis_id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                @endif
                            </li>
                        @endif
                    @endforeach --}}

                    {{-- 食事（時間帯別に表示＋削除） --}}
                    {{-- @php
                        $groupedMeals = $schedule->meals->groupBy('food_time_label');
                    @endphp

                    @foreach (['朝', '昼', '夜'] as $timeLabel)
                        @php $mealsTime = $groupedMeals->get($timeLabel, collect()); @endphp

                        @if ($mealsTime->isNotEmpty())
                            <ul>
                                @foreach ($mealsTime as $meal)
                                    <li>
                                        食事: {{ $meal->food_name }} {{ $meal->food_form }}（{{ $meal->food_time }}）
                                        @if (isset($meal->pivot->t_meal_id))
                                            <form method="POST" action="{{ route('schedule.meal.destroy', ['id' => $meal->pivot->t_meal_id]) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">削除</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach --}}

                    {{-- 薬（当日分のみ表示） --}}
                    {{-- <ul>
                    @foreach ($schedule->medicines as $medicine)
                        @if ($medicine->medicineMaster)
                            <li>
                                薬: {{ $medicine->medicineMaster->drug_name }}({{$medicine->medicineMaster->medicine_time}})
                                @if (isset($medicine->t_medicine_id))
                                    <form method="POST" action="{{ route('schedule.medicine.destroy', ['id' => $medicine->t_medicine_id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    </ul>

            </div>
        @endforeach
    </div>
@endforeach --}}
</main>

</body>
</html>
