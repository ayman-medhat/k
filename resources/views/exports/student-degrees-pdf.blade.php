<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Degrees</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #333; }
        h1 { font-size: 18px; margin: 0 0 4px; }
        .subtitle { font-size: 11px; color: #666; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; text-align: center; }
        th { background: #f0f0f0; font-weight: 600; font-size: 9px; text-transform: uppercase; }
        td { font-size: 10px; }
        .left { text-align: left; }
        .right { text-align: right; }
        .bold { font-weight: 700; }
        .footer { margin-top: 12px; font-size: 9px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <h1>Student Degrees</h1>
    <div class="subtitle">
        {{ $exam->name }} — {{ $exam->grade?->name ?? '' }}
        @if($sectionId) - Section {{ \App\Models\Section::find($sectionId)?->name ?? '' }} @endif
        | {{ $exam->date?->format('M d, Y') ?? '' }} | {{ $exam->term?->name ?? '' }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th class="left" style="width: 20%;">Student</th>
                @foreach($examSubjects as $subject)
                    <th>
                        {{ $subject->name }}
                        <div style="font-weight: 400; font-size: 7px; color: #999;">max {{ $subject->pivot->max_marks }}</div>
                    </th>
                @endforeach
                <th style="width: 8%;">Total</th>
                <th style="width: 6%;">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="left bold">{{ $record['student_name'] }}</td>
                    @foreach($record['marks'] as $mark)
                        <td>{{ $mark['marks_obtained'] ?? '-' }}</td>
                    @endforeach
                    <td class="bold">{{ $record['total_obtained'] }}/{{ $record['total_max'] }}</td>
                    <td>{{ $record['percentage'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</div>
</body>
</html>
