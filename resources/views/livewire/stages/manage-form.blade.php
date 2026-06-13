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
    .btn-secondary {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1rem 0; }
    .grade-checklist { display: flex; flex-direction: column; gap: 0.25rem; }
    .grade-checklist label {
        display: flex; align-items: center; gap: 0.5rem;
        cursor: pointer; padding: 0.5rem; border-radius: 0.5rem;
        transition: background 0.15s; font-size: 0.9rem; color: var(--crm-text);
    }
    .grade-checklist label:hover { background: var(--crm-input-bg); }
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

    input[type="checkbox"] {
        appearance: none; -webkit-appearance: none;
        width: 1.1rem; height: 1.1rem;
        border-radius: 0.2rem;
        border: 2px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
    }
    input[type="checkbox"]:checked {
        background: #6366f1; border-color: #6366f1;
    }
    input[type="checkbox"]:checked::after {
        content: "\2713"; color: white; font-size: 0.65rem; font-weight: 700;
    }
</style>

    <div class="form-card">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <a href="{{ route('stages') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>{{ $stage ? __('stages.edit_stage') : __('stages.new_stage') }}</h1>

        <form wire:submit.prevent="save">
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.name_en') }}</label>
                    <input type="text" wire:model.blur="name" placeholder="Primary">
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.name_ar') }}</label>
                    <input type="text" wire:model.blur="name_ar" placeholder="المرحلة الإبتدائية" dir="rtl">
                    @error('name_ar') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                    <label>{{ __('stages.level_order') }}</label>
                    <input type="number" wire:model="level_order" min="0" placeholder="1">
                @error('level_order') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" wire:model="description" placeholder="Optional description">
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">🎓 Contained Grades</div>
            <div class="grade-checklist">
                @forelse($this->allGrades as $grade)
                <label>
                    <input type="checkbox"
                        value="{{ $grade->id }}"
                        wire:model.live="selectedGradeIds"
                        style="width: 1.1rem; height: 1.1rem; accent-color: #6366f1; cursor: pointer; flex-shrink: 0;"
                    >
                    <span style="font-weight: 600;">{{ $grade->name }}</span>
                    <span style="color: var(--crm-text-muted); font-size: 0.8rem;">({{ $grade->name_ar }})</span>
                </label>
                @empty
                <div style="color: var(--crm-text-muted); padding: 1rem;">{{ __('grades.no_grades') }} Create grades first.</div>
                @endforelse
            </div>

            <div class="actions">
                <a href="{{ route('stages') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                <button type="submit" class="btn-primary">{{ __('general.save') }}</button>
            </div>
        </form>
    </div>
</div>
