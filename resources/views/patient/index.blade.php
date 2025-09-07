<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Patient一覧表示</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .header-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .header-right a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .header-right a:hover {
            text-decoration: underline;
        }

        .header-right form {
            margin: 0;
        }

        .room-container {
            border: 2px solid #333;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
        }
        .room-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #1a1a1a;
        }
        .patients-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .patient-card {
            border: 1px solid #aaa;
            border-radius: 6px;
            padding: 10px;
            background-color: #fafafa;
            box-shadow: 1px 1px 4px rgba(0,0,0,0.1);
        }
        .patient-card a {
            font-weight: bold;
            text-decoration: none;
            color: #0066cc;
        }
        .patient-card a:hover {
            text-decoration: underline;
        }
        form {
            margin-top: 10px;
        }
        form button {
            background-color: #007bff;
            border: none;
            padding: 6px 10px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        /* スケジュール情報 */
        .schedule-info {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #333;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .schedule-section {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-left">
            <h1>10F病棟</h1>
        </div>
    
        <div class="header-right">
            <a href="{{ route('patient.register') }}">患者を追加</a>
    
            @foreach ($patients as $roomPatients)
                @foreach ($roomPatients as $firstPatient)
                    <a href="{{ route('assigned.index',['pt_id' => $firstPatient->pt_id]) }}">My患者</a>
                    @break
                @endforeach
                @break
            @endforeach
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    

    <div>
        @foreach ($patients as $room_id => $roomPatients)
            <div class="room-container">
                <div class="room-title">100{{ $room_id }}号室</div>

                <div class="patients-grid">
                    @foreach ($roomPatients as $patient)
                        <div class="patient-card">
                            <a href="{{ route('patient.information', $patient->pt_id) }}">
                                👤 {{ $patient->pt_name }}
                            </a>

                            <div>{{ $patient->disease->disease_name}}</div>

                            {{-- My患者追加 --}}
                            <form action="{{ route('assigned.add', $patient->pt_id) }}" method="POST">
                                @csrf
                                <button type="submit">My患者追加</button>
                            </form>

                            {{-- 患者情報削除 --}}
                            <form action="{{ route('patient.destroy', $patient->pt_id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                            

                            {{-- スケジュール --}}
                            <div class="schedule-info">
                                @forelse ($patient->ptSchedules as $schedule)
                                    <div class="schedule-section">

                                        {{-- 透析 --}}
                                        @foreach ($schedule->dialysis as $dialysis)
                                            <div>
                                                部位: {{ optional($dialysis->dialysisMaster)->part ?? '未設定' }},
                                                日: {{ optional($dialysis->dialysisMaster)->dialysis_day ?? '未設定' }}
                                            </div>
                                        @endforeach

                                        {{-- 治療 --}}
                                        @foreach ($schedule->treatmentkind as $treatment)
                                            <div>
                                                治療: {{ optional($treatment->treatmentkindMaster)->value ?? '未設定' }}
                                            </div>
                                        @endforeach

                                        {{-- ケア --}}
                                        @foreach ($schedule->carekind as $care)
                                            <div>
                                                ケア: {{ optional($care->carekindMaster)->value ?? '未設定' }}
                                            </div>
                                        @endforeach

                                        {{-- 食事 --}}
                                        <div>
                                            @foreach ($schedule->meals as $meal)   
                                                    食事: {{ $meal->food_name ?? '未設定' }}<br>
                                                    形態: {{ $meal->food_form ?? '未設定' }}                                   
                                            @endforeach
                                        </div>

                                        {{-- 薬 --}}
                                        @if (\Carbon\Carbon::parse($schedule->daily_schedule_date)->isSameDay(\Carbon\Carbon::parse($today)))
                                            <div>薬の数: {{ $schedule->medicines->count() }}</div>
                                            @foreach ($schedule->medicines as $tMedicine)
                                                <div>
                                                    薬: {{ optional($tMedicine->medicineMaster)->drug_name ?? '未設定' }}<br>
                                                    用法: {{ optional($tMedicine->medicineMaster)->usage ?? '未設定' }}<br>
                                                    用量: {{ optional($tMedicine->medicineMaster)->dose ?? '未設定' }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @empty
                                    <div>スケジュールなし</div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
