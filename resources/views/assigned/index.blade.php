<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My患者一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background-color: #f9f9f9;
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
            gap: 20px;
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

        .patient-card {
            border: 1px solid #aaa;
            border-radius: 6px;
            padding: 10px;
            background-color: #fafafa;
            box-shadow: 1px 1px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
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

        /* 横並びスタイル */
        .schedule-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #333;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .schedule-section {
            flex: 1 1 200px;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .schedule-section h4 {
            margin: 0 0 5px;
            font-size: 1rem;
            color: #555;
        }

        @media (max-width: 768px) {
            .schedule-info {
                flex-direction: column;
            }

            .schedule-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <h1>My患者一覧</h1>
    </div>

    <div class="header-right">
        <a href="{{ route('patient.index') }}">患者一覧に戻る</a>
        <a href="{{ route('schedule.index') }}">スケジュール</a>
    </div>
</header>

@forelse ($patients as $roomId => $patientsInRoom)
    <div class="room-container">
        <div class="room-title">部屋 {{ $roomId }}</div>

        @forelse ($patientsInRoom as $patient)
            <div class="patient-card">
                <a href="{{ route('patient.information', $patient->pt_id) }}">
                    👤 {{ $patient->pt_name }}
                </a>
                <p>性別: {{ $patient->sex }}</p>
                <p>血液型: {{ $patient->blood_type }}</p>

                <div class="schedule-info">
                    @forelse ($patient->ptSchedules as $schedule)
                        <div class="schedule-section">
                            <h4>透析</h4>
                            @foreach ($schedule->dialysis as $d)
                                <div>部位: {{ optional($d->dialysisMaster)->part ?? '未設定' }}</div>
                                <div>日: {{ optional($d->dialysisMaster)->dialysis_day ?? '未設定' }}</div>
                            @endforeach
                        </div>

                        <div class="schedule-section">
                            <h4>治療</h4>
                            @foreach ($schedule->treatmentkind as $t)
                                <div>項目: {{ optional($t->treatmentkindMaster)->value ?? '未設定' }}</div>
                            @endforeach
                        </div>

                        <div class="schedule-section">
                            <h4>ケア</h4>
                            @foreach ($schedule->carekind as $c)
                                <div>項目: {{ optional($c->carekindMaster)->value ?? '未設定' }}</div>
                            @endforeach
                        </div>

                        <div class="schedule-section">
                            <h4>食事</h4>
                                @foreach ($schedule->meals as $meal)   
                                        食事: {{ $meal->food_name ?? '未設定' }}<br>
                                        形態: {{ $meal->food_form ?? '未設定' }}                                   
                                @endforeach
                        </div>

                        @if (\Carbon\Carbon::parse($schedule->daily_schedule_date)->isSameDay(\Carbon\Carbon::parse($today)))
                            <div class="schedule-section">
                                <h4>薬</h4>
                                <div>薬の数: {{ $schedule->medicines->count() }}</div>
                                @foreach ($schedule->medicines as $tMedicine)
                                    <div>薬: {{ optional($tMedicine->medicineMaster)->drug_name ?? '未設定' }}</div>
                                    <div>用法: {{ optional($tMedicine->medicineMaster)->usage ?? '未設定' }}</div>
                                    <div>用量: {{ optional($tMedicine->medicineMaster)->dose ?? '未設定' }}</div>
                                @endforeach
                            </div>
                        @endif
                    @empty
                        <div>スケジュールなし</div>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('assigned.remove', $patient->pt_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </div>
        @empty
            <p>この部屋に患者はいません。</p>
        @endforelse
    </div>
@empty
    <p>My患者は登録されていません。</p>
@endforelse

<script>
    const schedules = @json($reminderSchedules);

    if (Notification.permission !== "granted") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                setupReminders();
            }
        });
    } else {
        setupReminders();
    }

    function setupReminders() {
        const notifyBeforeMinutes = 5;
        const now = Date.now();

        schedules.forEach(schedule => {
            const scheduleTime = new Date(schedule.datetime).getTime();
            const notifyTime = scheduleTime - notifyBeforeMinutes * 60 * 1000;
            const delay = notifyTime - now;

            if (delay > 0) {
                setTimeout(() => {
                    new Notification("リマインダー", {
                        body: `患者 ${schedule.pt_name} の予定時間です：${schedule.datetime}`,
                    });
                }, delay);
            }
        });
    }
</script>

</body>
</html>
