<div class="crm-container">
<style>
    :root {
        --crm-bg-from: #f3f4f6; --crm-bg-to: #e5e7eb;
        --crm-text: #1f2937; --crm-text-muted: #6b7280;
        --crm-panel-bg: rgba(255,255,255,0.7);
        --crm-panel-border: rgba(255,255,255,0.5);
        --crm-panel-shadow: rgba(0,0,0,0.05);
        --crm-input-bg: #f9fafb; --crm-input-border: #d1d5db;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.2);
        --crm-btn-secondary-bg: #f3f4f6; --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151; --crm-divider: #e5e7eb;
        --crm-badge-green-bg: #d1fae5; --crm-badge-green-text: #065f46;
        --crm-badge-red-bg: #fee2e2; --crm-badge-red-text: #991b1b;
        --crm-badge-yellow-bg: #fef3c7; --crm-badge-yellow-text: #92400e;
        --crm-badge-blue-bg: #dbeafe; --crm-badge-blue-text: #1e40af;
    }
    .dark {
        --crm-bg-from: #0f172a; --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9; --crm-text-muted: #94a3b8;
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b; --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-btn-secondary-bg: #334155; --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0; --crm-divider: #334155;
        --crm-badge-green-bg: #064e3b; --crm-badge-green-text: #6ee7b7;
        --crm-badge-red-bg: #7f1d1d; --crm-badge-red-text: #fca5a5;
        --crm-badge-yellow-bg: #78350f; --crm-badge-yellow-text: #fcd34d;
        --crm-badge-blue-bg: #1e3a5f; --crm-badge-blue-text: #93c5fd;
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .form-card {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        max-width: 900px; margin: 0 auto;
    }
    .form-card h1 {
        font-size: 1.75rem; font-weight: 800; color: var(--crm-text);
        margin-top: 0; margin-bottom: 0.75rem; letter-spacing: -0.5px;
    }
    .form-group { margin-bottom: 0.75rem; }
    .form-group label {
        display: block; margin-bottom: 0.75rem;
        font-weight: 500; color: var(--crm-text-muted); font-size: 0.875rem;
    }
    .form-group input, .form-group select {
        width: 100%; padding: 0.75rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        transition: all 0.2s; box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
        background: var(--crm-panel-bg);
    }
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.75rem; display: block; }
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
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .badge {
        display: inline-block; padding: 0.25rem 0.75rem;
        border-radius: 9999px; font-size: 0.75rem; font-weight: 600;
        background: var(--crm-badge-indigo-bg, #e0e7ff); color: var(--crm-badge-indigo-text, #4338ca);
    }
    .badge-green { background: var(--crm-badge-green-bg); color: var(--crm-badge-green-text); }
    .badge-red { background: var(--crm-badge-red-bg); color: var(--crm-badge-red-text); }
    .badge-yellow { background: var(--crm-badge-yellow-bg); color: var(--crm-badge-yellow-text); }
    .badge-blue { background: var(--crm-badge-blue-bg); color: var(--crm-badge-blue-text); }
    .attendance-row {
        display: grid; grid-template-columns: 1fr 200px 200px;
        gap: 0.75rem; align-items: center;
        padding: 0.75rem; border-bottom: 1px solid var(--crm-divider);
        font-size: 0.9rem;
    }
    .attendance-row:hover { background: var(--crm-input-bg); border-radius: 0.5rem; }
    .attendance-row .student-name { font-weight: 600; color: var(--crm-text); }
    .attendance-row select {
        padding: 0.5rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.85rem; width: 100%;
    }
    .attendance-row select:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
    }
    .attendance-row input {
        padding: 0.5rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.85rem; width: 100%; box-sizing: border-box;
    }
    .attendance-row input:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
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

    <div class="form-card">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <a href="{{ route('attendance') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>{{ __('attendance.mark_attendance') }}</h1>

        <form wire:submit.prevent="save">
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.grade') }}</label>
                    <select wire:model.live="grade_id">
                        <option value="">{{ __('general.select_grade') }}</option>
                        @foreach($this->grades as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.class') }}</label>
                    <select wire:model.live="section_id">
                        <option value="">{{ __('general.select') }}</option>
                        @foreach($this->sections as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('section_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group" style="max-width: 250px;">
                <label>{{ __('attendance.date') }}</label>
                <input type="date" wire:model.live="date">
                @error('date') <span class="error">{{ $message }}</span> @enderror
            </div>

            @if(count($records) > 0)
            <hr class="divider" style="border: none; border-top: 1px solid var(--crm-divider); margin: 1.25rem 0;">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
                <span>👨‍🎓 {{ __('nav.students') }} ({{ count($records) }})</span>
                <div style="display: flex; gap: 0.5rem; font-size: 0.8rem;">
                    <span class="badge badge-green">{{ __('attendance.present') }}</span>
                    <span class="badge badge-red">{{ __('attendance.absent') }}</span>
                    <span class="badge badge-yellow">{{ __('attendance.late') }}</span>
                    <span class="badge badge-blue">{{ __('attendance.excused') }}</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 160px 160px; gap: 0.75rem; padding: 0.5rem 0.75rem; font-size: 0.75rem; font-weight: 600; color: var(--crm-text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--crm-divider);">
                <span>{{ __('attendance.student') }}</span>
                <span>{{ __('general.status') }}</span>
                <span>{{ __('general.notes') }}</span>
            </div>

            <div style="max-height: 500px; overflow-y: auto;">
                @foreach($records as $index => $record)
                <div class="attendance-row">
                    <span class="student-name">{{ $record['student_name'] }}</span>
                    <select wire:model="records.{{ $index }}.status">
                        <option value="present">{{ __('attendance.present') }}</option>
                        <option value="absent">{{ __('attendance.absent') }}</option>
                        <option value="late">{{ __('attendance.late') }}</option>
                        <option value="excused">{{ __('attendance.excused') }}</option>
                    </select>
                    <input type="text" wire:model="records.{{ $index }}.notes" placeholder="Optional notes">
                </div>
                @endforeach
            </div>

            <div class="actions">
                <a href="{{ route('attendance') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                <button type="submit" class="btn-primary">{{ __('general.save') }}</button>
            </div>
            @elseif($section_id && $date)
            <div class="empty-state" style="text-align: center; padding: 2rem; color: var(--crm-text-muted);">
                <p>No active enrollments found for this class and date.</p>
                <p style="font-size: 0.875rem;">Make sure students are enrolled in this class for the current academic year.</p>
            </div>
            @else
            <div class="empty-state" style="text-align: center; padding: 2rem; color: var(--crm-text-muted);">
                <p>Select a grade, class, and date to begin.</p>
            </div>
            @endif
        </form>
    </div>
</div>
