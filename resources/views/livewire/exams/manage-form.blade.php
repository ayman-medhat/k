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
        max-width: 720px; margin: 0 auto;
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
    .form-group input, .form-group select, .form-group textarea {
        width: 100%; padding: 0.75rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        transition: all 0.2s; box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
        background: var(--crm-panel-bg);
    }
    .form-group textarea { resize: vertical; min-height: 80px; }
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.75rem; display: block; }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-primary-sm {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.4rem 0.8rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        font-size: 0.8rem; transition: all 0.2s ease;
    }
    .btn-primary-sm:hover { transform: translateY(-1px); }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .btn-danger-sm {
        background: #ef4444; color: white; padding: 0.4rem 0.8rem;
        border-radius: 9999px; font-weight: 600; border: none; cursor: pointer;
        font-size: 0.8rem; transition: all 0.2s ease;
    }
    .btn-danger-sm:hover { background: #dc2626; }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1rem 0; }
    .subject-row {
        display: grid; grid-template-columns: 1fr 120px 80px;
        gap: 0.75rem; align-items: center;
        padding: 0.5rem; border-radius: 0.5rem;
    }
    .subject-row:hover { background: var(--crm-input-bg); }
    .subject-row select, .subject-row input {
        padding: 0.5rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.85rem; width: 100%; box-sizing: border-box;
    }
    .subject-row select:focus, .subject-row input:focus {
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
            <a href="{{ route('exams') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>{{ $exam ? __('exams.edit_exam') : __('exams.new_exam') }}</h1>

        <form wire:submit.prevent="save">
            <div class="form-group">
                <label>{{ __('exams.exam_name') }}</label>
                <input type="text" wire:model.blur="name" placeholder="e.g. Midterm 2025">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.grade') }}</label>
                    <select wire:model.live="grade_id">
                        <option value="">{{ __('general.select_grade') }}</option>
                        @foreach($this->gradeOptions as $g)
                            <option value="{{ $g->id }}">{{ $g->name }} ({{ $g->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('grade_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('exams.term') }}</label>
                    <select wire:model.blur="term_id">
                        <option value="">{{ __('general.select') }}</option>
                        @foreach($this->termOptions as $t)
                            <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->academicYear?->name ?? '' }})</option>
                        @endforeach
                    </select>
                    @error('term_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('exams.date') }}</label>
                    <input type="date" wire:model.blur="date">
                    @error('date') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea wire:model="description" placeholder="Optional description"></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <hr class="divider">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <div style="font-weight: 600; color: var(--crm-text-muted);">{{ __('nav.subjects') }}</div>
                <button type="button" wire:click="addSubject" class="btn-primary-sm">+ Add Subject</button>
            </div>

            @if(count($subjects) > 0)
            <div style="display: grid; grid-template-columns: 1fr 120px 40px; gap: 0.75rem; padding: 0.5rem; font-size: 0.75rem; font-weight: 600; color: var(--crm-text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--crm-divider);">
                <span>{{ __('nav.subjects') }}</span>
                <span>{{ __('exams.max_score') }}</span>
                <span></span>
            </div>
            @endif

            <div style="max-height: 400px; overflow-y: auto;">
                @foreach($subjects as $index => $subject)
                <div class="subject-row">
                    <select wire:model="subjects.{{ $index }}.subject_id">
                        <option value="">{{ __('general.select') }}</option>
                        @foreach($this->subjectOptions as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                        @endforeach
                    </select>
                    <input type="number" step="0.01" wire:model.blur="subjects.{{ $index }}.max_marks" placeholder="100">
                    <button type="button" wire:click="removeSubject({{ $index }})" class="btn-danger-sm">✕</button>
                </div>
                @endforeach
            </div>
            @error('subjects') <span class="error">{{ $message }}</span> @enderror

            <div class="actions">
                <a href="{{ route('exams') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                <button type="submit" class="btn-primary">{{ __('general.save') }}</button>
            </div>
        </form>
    </div>
</div>
