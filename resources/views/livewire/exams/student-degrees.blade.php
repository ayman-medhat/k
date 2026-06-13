<div class="crm-container">
<style>
    :root {
        --crm-bg-from: #f3f4f6; --crm-bg-to: #e5e7eb;
        --crm-text: #1f2937; --crm-text-muted: #6b7280;
        --crm-border: rgba(0,0,0,0.05);
        --crm-panel-bg: rgba(255,255,255,0.7);
        --crm-panel-border: rgba(255,255,255,0.5);
        --crm-panel-shadow: rgba(0,0,0,0.05);
        --crm-input-bg: #f9fafb; --crm-input-border: #d1d5db;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.2);
        --crm-table-head: #4b5563;
        --crm-btn-secondary-bg: #f3f4f6;
        --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151;
        --crm-divider: #e5e7eb;
        --crm-divider-dashed: rgba(0,0,0,0.05);
    }
    .dark {
        --crm-bg-from: #0f172a; --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9; --crm-text-muted: #94a3b8;
        --crm-border: rgba(255,255,255,0.05);
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b; --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-table-head: #94a3b8;
        --crm-btn-secondary-bg: #334155;
        --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0;
        --crm-divider: #334155;
        --crm-divider-dashed: rgba(255,255,255,0.05);
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; height: 2.25rem; flex-wrap: wrap; gap: 0.5rem; }
    .header h1 { font-size: 1.2rem; color: var(--crm-text); margin: 0; font-weight: 700; letter-spacing: -0.5px; }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) { .glass-panel { padding: 1rem; } }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid var(--crm-divider-dashed); }
    @media (max-width: 640px) { th, td { padding: 0.35rem 0.5rem; } }
    th { font-weight: 600; color: var(--crm-table-head); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; background: var(--crm-panel-bg); position: sticky; top: 0; }
    td { color: var(--crm-text); font-size: 0.875rem; }
    tbody tr:hover { background: var(--crm-btn-secondary-bg); }
    .empty-state { text-align: center; padding: 3rem; color: var(--crm-text-muted); }
    .empty-state p { margin: 0.5rem 0; }
    .filter-select {
        padding: 0.5rem 1rem; border-radius: 9999px; border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.875rem; outline: none; width: 100%; box-sizing: border-box;
    }
    .filter-select:focus {
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
    }
    .filter-label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.75rem; color: var(--crm-text); }
    .filters-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 0.75rem; }
    @media (min-width: 768px) { .filters-grid { grid-template-columns: 1fr 1fr 1fr; } }
    .text-muted { color: var(--crm-text-muted); }
    .btn-icon-sm {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;
        border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;
    }
    .btn-icon-sm:hover { background: var(--crm-btn-secondary-hover); }
    .btn-icon-sm:disabled { opacity: 0.4; cursor: not-allowed; }
    .btn-icon-sm.primary { background: #6366f1; color: white; }
    .btn-icon-sm.primary:hover { background: #4f46e5; }
    .btn-icon-sm.success { background: #059669; color: white; }
    .btn-icon-sm.success:hover { background: #047857; }
    .header-actions { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
    @media print { .no-print { display: none !important; } }
    @media print {
        .crm-container { background: none !important; padding: 0 !important; min-height: auto !important; }
        .glass-panel { box-shadow: none !important; backdrop-filter: none !important; border: 1px solid #ddd !important; }
        th { background: #f0f0f0 !important; }
        tbody tr:hover { background: none !important; }
    }
    /* Standard height for all buttons and search boxes */
    .btn-primary, .btn-secondary, .btn-danger, .btn-danger-sm {
        height: 2.25rem;
        padding-top: 0.3rem;
        padding-bottom: 0.3rem;
        display: inline-flex;
        align-items: center;
        box-sizing: border-box;
    }
    .search-box {
        height: 2.25rem;
        padding: 0.15rem 1rem;
        border-radius: 9999px;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        font-size: 0.875rem;
        outline: none;
        display: inline-flex;
        align-items: center;
        box-sizing: border-box;
    }
    .search-box:focus {
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
    }
</style>

    <div class="header">
        <h1>{{ __('exams.student_degrees') }}</h1>
        <div class="header-actions no-print">
            <button onclick="window.print()" class="btn-icon-sm">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
                {{ __('exams.print') }}
            </button>
            <a href="#"
               onclick="event.preventDefault(); doExport('pdf')"
               class="btn-icon-sm primary"
               {{ !$this->exam_id ? 'style=pointer-events:none;opacity:0.4' : '' }}>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                PDF
            </a>
            <a href="#"
               onclick="event.preventDefault(); doExport('excel')"
               class="btn-icon-sm success"
               {{ !$this->exam_id ? 'style=pointer-events:none;opacity:0.4' : '' }}>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="16" x2="16" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="20" x2="13" y2="20"/></svg>
                Excel
            </a>
        </div>

        <script>
            function doExport(type) {
                var examId = document.getElementById('exam_id');
                if (!examId || !examId.value) return false;
                var name = prompt('Enter file name:', 'student-degrees');
                if (!name) return false;
                var gradeId = document.getElementById('grade_id');
                var sectionId = document.getElementById('section_id');
                var url = (type === 'pdf' ? '{{ route('student-degrees.pdf') }}' : '{{ route('student-degrees.excel') }}')
                    + '?grade_id=' + encodeURIComponent(gradeId ? gradeId.value : '')
                    + '&exam_id=' + encodeURIComponent(examId.value)
                    + '&section_id=' + encodeURIComponent(sectionId ? sectionId.value : '')
                    + '&filename=' + encodeURIComponent(name);
                window.location.href = url;
            }
        </script>
    </div>

    <div class="filters-grid">
        <div>
            <label for="grade_id" class="filter-label">{{ __('general.grade') }}</label>
            <select id="grade_id" wire:model.live="grade_id" class="filter-select">
                <option value="">{{ __('general.select_grade') }}</option>
                @foreach($this->grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }} {{ $grade->name_ar ? "($grade->name_ar)" : '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="section_id" class="filter-label">{{ __('general.section') }}</label>
            <select id="section_id" wire:model.live="section_id" class="filter-select">
                <option value="">{{ __('general.all') }} {{ __('general.section') }}s</option>
                @foreach($this->sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }} {{ $section->name_ar ? "($section->name_ar)" : '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="exam_id" class="filter-label">{{ __('exams.exam_name') }}</label>
            <select id="exam_id" wire:model.live="exam_id" class="filter-select">
                <option value="">{{ __('general.select') }}</option>
                @foreach($this->exams as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->name }} ({{ $exam->date->format('d M Y') }})</option>
                @endforeach
            </select>
        </div>
    </div>

    @if(count($this->records) > 0)
        <div class="glass-panel" style="padding: 0; overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="text-align: left; position: sticky; left: 0; z-index: 1; background: var(--crm-panel-bg);">#</th>
                        <th style="text-align: left; position: sticky; left: 0; z-index: 1; background: var(--crm-panel-bg);">{{ __('exams.student') }}</th>
                        @foreach($this->examSubjects as $subject)
                            <th style="text-align: center;">
                                {{ $subject->name }}
                                <div style="font-weight: 400; font-size: 0.65rem; color: var(--crm-text-muted);">max {{ $subject->pivot->max_marks }}</div>
                            </th>
                        @endforeach
                        <th style="text-align: center;">{{ __('exams.total') }}</th>
                        <th style="text-align: center;">%</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->records as $index => $record)
                        <tr>
                            <td style="text-align: left; color: var(--crm-text-muted);">{{ $index + 1 }}</td>
                            <td style="font-weight: 600;">{{ $record['student_name'] }}</td>
                            @foreach($record['marks'] as $mark)
                                <td style="text-align: center;">
                                    @if($mark['marks_obtained'] !== null)
                                        {{ $mark['marks_obtained'] }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td style="text-align: center; font-weight: 700;">
                                {{ $record['total_obtained'] }} / {{ $record['total_max'] }}
                            </td>
                            <td style="text-align: center; font-weight: 700;">
                                {{ $record['percentage'] }}%
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
    @elseif($this->exam_id)
        <div class="glass-panel">
            <div class="empty-state">
                <p>No records found for the selected filters.</p>
            </div>
        </div>
    @else
        <div class="glass-panel">
            <div class="empty-state">
                <p>Select a grade and exam to view student degrees.</p>
            </div>
        </div>
    @endif
</div>
