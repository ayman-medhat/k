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
    .header h1 small { font-size: 1.2rem; font-weight: 400; color: var(--crm-text-muted); }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.5rem 1rem; border-radius: 9999px; font-weight: 600;
        border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) { .glass-panel { padding: 1rem; } }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 0.6rem 0.75rem; text-align: left; border-bottom: 1px solid var(--crm-divider-dashed); white-space: nowrap; }
    @media (max-width: 640px) { th, td { padding: 0.35rem 0.5rem; } }
    th { font-weight: 600; color: var(--crm-table-head); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; background: var(--crm-panel-bg); position: sticky; top: 0; }
    td { color: var(--crm-text); font-size: 0.875rem; }
    .empty-state { text-align: center; padding: 3rem; color: var(--crm-text-muted); }
    .empty-state p { margin: 0.5rem 0; }
    .filter-select {
        padding: 0.5rem 1rem; border-radius: 9999px; border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.875rem; outline: none;
    }
    .filter-select:focus {
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
    }
    .marks-input {
        width: 80px; padding: 0.4rem; border-radius: 0.375rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.85rem; text-align: center; box-sizing: border-box;
    }
    .marks-input:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
    }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem; }
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
        <div>
            <h1>{{ $exam->name }} <small>{{ $exam->grade?->name ?? '' }}</small></h1>
            <div style="color: var(--crm-text-muted); font-size: 0.9rem; margin-top: 0.75rem;">
                {{ $exam->date->format('M d, Y') }} — {{ $exam->term?->name ?? __('general.na') }}
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <select wire:model.live="section_id" class="filter-select">
                <option value="">{{ __('general.select') }}</option>
                @foreach($this->sections as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($section_id && count($records) > 0)
    <form wire:submit.prevent="save">
        <div class="glass-panel" style="padding: 0; overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="position: sticky; left: 0; z-index: 1; background: var(--crm-panel-bg);">{{ __('exams.student') }}</th>
                        @foreach($this->examSubjects as $subject)
                            <th style="text-align: center;">
                                {{ $subject->name }}
                                <div style="font-weight: 400; font-size: 0.65rem; color: var(--crm-text-muted);">{{ __('exams.max_score') }}: {{ $subject->pivot->max_marks }}</div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $rIndex => $record)
                    <tr>
                        <td style="font-weight: 600; position: sticky; left: 0; background: var(--crm-panel-bg);">{{ $record['student_name'] }}</td>
                        @foreach($record['marks'] as $mIndex => $mark)
                        <td style="text-align: center;">
                            <input type="number" step="0.01" min="0"
                                wire:model="records.{{ $rIndex }}.marks.{{ $mIndex }}.marks_obtained"
                                class="marks-input"
                                placeholder="{{ __('general.no_data') }}"
                                style="width: 75px;">
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="actions">
            <a href="{{ route('exams') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
            <button type="submit" class="btn-primary">{{ __('exams.enter_marks') }}</button>
        </div>
    </form>
    @elseif($section_id)
    <div class="glass-panel">
        <div class="empty-state">
            <p>No active enrollments found for this class.</p>
            <p style="font-size: 0.875rem;">Make sure students are enrolled in the current academic year.</p>
        </div>
    </div>
    @else
    <div class="glass-panel">
        <div class="empty-state">
            <p>Select a class to enter marks.</p>
        </div>
    </div>
    @endif
</div>
