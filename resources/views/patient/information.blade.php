<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>患者情報</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        header {
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        header h1 {
            margin-bottom: 10px;
        }

        .nav-links a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .main-content {
            display: flex;
            gap: 30px;
        }

        .left-column {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 2%;
        }

        .info-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 30%;
            box-sizing: border-box;
        }

        .info-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.1rem;
            color: #333;
        }

        .right-column {
            width: 40%;
        }

        .record-form {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f0f8ff;
        }

        .record-form textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }

        .record-form button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .record-form button:hover {
            background-color: #0056b3;
        }

        .record-list {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        .record-entry {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .record-entry:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<header>
    <h1>患者情報</h1>
    <div>
        <strong>👤 氏名：</strong>{{ $m_patient->pt_name }}<br>
        <strong>性別：</strong>{{ $m_patient->sex }}　
        <strong>血液型：</strong>{{ $m_patient->blood_type }}
        <strong>部屋番号：</strong>100{{ $m_patient->room_id }}号室<br>
        <strong>疾患名：</strong>{{ $m_patient->disease->disease_name}}
        <strong>主治医：</strong>{{ $m_patient->Dr_name }}
    </div>
    <div class="nav-links" style="margin-top:10px;">
        <a href="{{ route('patient.index') }}">患者一覧へ</a>

        @foreach ($patients as $roomPatients)
            @foreach ($roomPatients as $firstPatient)
                <a href="{{ route('assigned.index',['pt_id' => $firstPatient->pt_id]) }}">My患者</a>
                @break
            @endforeach
            @break
        @endforeach

        <a href="{{ route('patient.add', $m_patient->pt_id) }}">患者情報登録</a>
    </div>
</header>

<div class="main-content">
    {{-- 左カラム --}}
    <div class="left-column">
        @php
            $schedule = $todaySchedules->first();
        @endphp

        @if ($schedule)
            {{-- 透析 --}}
            <div class="info-box">
                <h3><a href="{{ route('dialysis.index', ['pt_id' => $m_patient->pt_id]) }}">透析</a></h3>
                @foreach ($schedule->dialysis as $d)
                    <div>
                        部位: {{ optional($d->dialysisMaster)->part ?? '未設定' }},
                        日: {{ optional($d->dialysisMaster)->dialysis_day ?? '未設定' }}
                    </div>
                @endforeach
            </div>

            {{-- 治療 --}}
            <div class="info-box">
                <h3><a href="{{ route('treatmentkind.index', ['pt_id' => $m_patient->pt_id]) }}">治療</a></h3>

                @php
                    $groupedTreatment = $schedule->treatmentkind->groupBy(function($item) {
                        return optional($item->treatmentkindMaster)->category ?? 'その他';
                    });

                    $categoryLabels = [
                        'treatment' => '治療',
                        'check' => '検査',
                        'rehabilitation' => 'リハビリ',
                        'operation' => '手術',
                        'check_data' => 'データ',
                        'その他' => 'その他',
                    ];
                @endphp

                @foreach ($groupedTreatment as $category => $items)
                    <h4>{{ $categoryLabels[$category] ?? $category }}</h4>
                    <ul>
                        @foreach ($items as $t)
                            <li>{{ optional($t->treatmentkindMaster)->value ?? '未設定' }}</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>

            {{-- ケア --}}
            <div class="info-box">
                <h3><a href="{{ route('carekind.index', ['pt_id' => $m_patient->pt_id]) }}">ケア</a></h3>
                @foreach ($schedule->carekind as $c)
                    <div>項目: {{ optional($c->carekindMaster)->value ?? '未設定' }}</div>
                @endforeach
            </div>

            {{-- 食事 --}}
            <div class="info-box">
                <h3><a href="{{ route('meal.index', ['pt_id' => $m_patient->pt_id]) }}">食事</a></h3>
                @if ($schedule->meals->isEmpty())
                    <div class="no-data">食事なし</div>
                @else
                    <ul>
                        @foreach ($schedule->meals as $meal)
                            <li class="meal-item">
                                食事: {{ $meal->food_name ?? '未設定' }}<br>
                                形態: {{ $meal->food_form ?? '未設定' }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- 薬 --}}
            <div class="info-box">
                <h3><a href="{{ route('medicine.index', ['pt_id' => $m_patient->pt_id]) }}">薬</a></h3>
                @forelse ($schedule->medicines as $tMedicine)
                    <div>
                        薬: {{ optional($tMedicine->medicineMaster)->drug_name ?? '未設定' }}<br>
                        用法: {{ optional($tMedicine->medicineMaster)->usage ?? '未設定' }}<br>
                        時間帯: {{ optional($tMedicine->medicineMaster)->medicine_time_label ?? '未設定' }}
                    </div>
                @empty
                    <div>登録された薬がありません。</div>
                @endforelse
            </div>
        @else
            <p>本日のスケジュールがありません。</p>
        @endif
    </div>


    {{-- 右カラム --}}
    <div class="right-column">
        <div class="record-form">
            <h2>📄 メモ入力</h2>
            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('document.extra') }}">
                @csrf
                <input type="hidden" name="pt_id" value="{{ $m_patient->pt_id }}">
                <textarea name="pt_record" rows="4" placeholder="文書を入力">{{ old('pt_record') }}</textarea><br>

                @error('pt_record')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <button type="submit">登録</button>
            </form>
        </div>

        <div class="record-list">
            <h2>🗃 メモ一覧</h2>
            @forelse ($m_patient->records as $record)
                @if (empty($record->pt_record))
                    @continue
                @endif
                <div class="record-entry">
                    <strong>記録:</strong> {{ $record->pt_record }}
                </div>
            @empty
                <p>メモがまだ登録されていません。</p>
            @endforelse
        </div>
    </div>
</div>

</body>
</html>
