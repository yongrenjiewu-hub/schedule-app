<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>患者情報登録</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #fff;
            color: #333;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 2px solid #ccc;
            margin-bottom: 30px;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: bold;
        }

        header a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 1rem;
        }

        header a:hover {
            text-decoration: underline;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fafafa;
            padding: 25px 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        form h3 {
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        select,
        input[type="text"],
        input[type="tel"],
        input[type="number"],
        input[type="hidden"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
            color: #333;
        }

        select[multiple] {
            height: auto;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #007bff;
            border: none;
            padding: 12px 25px;
            color: #fff;
            font-weight: bold;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 30px auto 0;
            width: 150px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
    </style>
</head>

<body>
    <header>
        <h1>患者情報登録</h1>
        {{-- 患者が1件以上いる場合は戻るリンク表示 --}}
        @if ($m_patient->count() > 0)
            <a href="{{ route('patient.information', $m_patient->first()->pt_id) }}">戻る</a>
        @endif
    </header>

    <form method="POST" action="{{ route('patient.update', $id) }}">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">

        <div>
            <h3>病気</h3>
            <select name="disease" required>
                <option value="">選択してください</option>
                @foreach ($m_disease as $disease)
                    <option value="{{ $disease->disease_id }}" 
                        @if(optional($m_patient->first())->disease_id == $disease->disease_id) selected @endif>
                        {{ $disease->disease_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 看護ケア --}}
        @php
            $allCareCategories = $t_care_kind->pluck('care_kind_id');
        @endphp

        <div>
            <h3>看護ケア</h3>
            @foreach ($m_care_kind as $category => $careKinds)
                <label>{{ $category }} のケア種類を選択</label>
                <select name="care[{{ $category }}]" >
                    <option value="">選択してください</option>
                    @foreach ($careKinds as $care)
                        <option value="{{ $care->care_kind_id }}" 
                            @if($allCareCategories->contains($care->care_kind_id)) selected @endif>
                            {{ $care->value }}
                        </option>
                    @endforeach
                </select>
            @endforeach
        </div>


        {{-- 治療 --}}
        @php
        // カテゴリ毎にグループ化している前提（$allTreatmentKinds に DBから全件のMTreatmentkindモデルが入っていると仮定）
        $TreatmentKinds = $allTreatmentKinds->groupBy('category');
    
        $categoryLabels = [
            'treatment' => '治療',
            'check' => '検査',
            'rehabilitation' => 'リハビリ',
            'operation' => '手術',
            'check_data' => 'データ',
            'その他' => 'その他',
        ];
    
        // 既に選択されている treatment_kind_id の配列
        $selectedIds = $selectedTreatmentKindIds ?? [];
        @endphp
        
        @foreach ($TreatmentKinds as $category => $items)
            <h4>{{ $categoryLabels[$category] ?? $category }}</h4>
            <ul>
            @foreach ($items as $item)
                <li>
                    <label>
                        <input type="checkbox" name="treatment[{{ $category }}][]" value="{{ $item->treatment_kind_id }}"
                            {{ in_array($item->treatment_kind_id, $selectedIds) ? 'checked' : '' }}>
                        {{ $item->value }}
                    </label>
                </li>
            @endforeach
            </ul>
        @endforeach

        {{-- 透析 --}}
        @php
            $allDialysisParts = $t_pt_dialysis->pluck('t_pt_dialysis_part');
        @endphp

        <div>
            <h3>透析</h3>
            @foreach ($m_dialysis as $dialysis => $dia)
                <label>{{ $dialysis }}</label>
                <select name="dialysis[{{ $dialysis }}]" >
                    <option value="">選択してください</option>
                    @foreach ($dia as $d)
                        <option value="{{ $d->dialysis_id }}" 
                            @if($allDialysisParts->contains($d->dialysis_id)) selected @endif>
                            {{ $d->part }}
                        </option>
                    @endforeach
                </select>
            @endforeach
        </div>

        {{-- 薬 --}}
        @php
        $uniqueMedicines = $m_medicine->unique('drug_name');
        @endphp

        <div>
            <h3>薬</h3>
            @foreach ($uniqueMedicines as $medicine)
                <label>
                    <input type="checkbox" name="medicine[]" value="{{ $medicine->medicine_id }}"
                    {{ (is_array($selectedMedicineIds) && in_array((string)$medicine->medicine_id, array_map('strval', $selectedMedicineIds))) ? 'checked' : '' }}>

                    {{ $medicine->drug_name }}
                </label><br>
            @endforeach
        </div>

        {{-- 食事 --}}
        <div>
            <h3>食事</h3>
            <select name="meal[]" multiple>
                @foreach ($m_meal as $meal)
                    <option value="{{ $meal->meal_id }}"
                        @if(in_array($meal->meal_id, $selectedMealIds ?? [])) selected @endif>
                        {{ $meal->food_name }} : {{ $meal->food_form }} ({{ $meal->food_time_label }})
                    </option>
                @endforeach
            </select>
        </div>


        <input type="submit" value="登録">
    </form>
</body>

</html>
