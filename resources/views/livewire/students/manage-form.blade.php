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
    .form-group input:read-only {
        background: var(--crm-btn-secondary-bg);
        cursor: not-allowed;
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
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1rem 0; }
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
            <a href="{{ route('students') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>{{ $student ? __('students.edit_student') : __('students.new_student') }}</h1>

        @if($isControl)
        <div style="background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 1px solid #fde68a; border-radius: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 0.75rem; font-size: 0.875rem; color: #92400e; display: flex; align-items: center; gap: 0.5rem;">
            <span>🔒</span>
            <span><strong>Control Mode</strong> — You can only modify Seat No. and Secret Code.</span>
        </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="form-group">
                <label>Select Student Contact</label>
                <select wire:model.live="contact_id" {{ $isControl ? 'disabled' : '' }}>
                    <option value="">{{ __('general.select') }}</option>
                    @foreach($this->availableContacts as $c)
                        <option value="{{ $c->id }}">{{ $c->nameEn }} ({{ $c->nameAr }})</option>
                    @endforeach
                </select>
                @error('contact_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                <label>Select Grade</label>
                <select wire:model.live="grade_id" {{ $isControl ? 'disabled' : '' }}>
                        <option value="">{{ __('general.select_grade') }}</option>
                        @foreach($this->availableGrades as $g)
                            <option value="{{ $g->id }}">{{ $g->name }} ({{ $g->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('grade_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                <label>Select Class</label>
                <select wire:model="section_id" {{ $isControl ? 'disabled' : '' }}>
                        <option value="">{{ __('general.select') }}</option>
                        @foreach($this->availableSections as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('section_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            @php $langOpts = $this->secondLanguageOptions; @endphp
            @if($langOpts->count())
            <div class="form-group">
                <label>Second Language</label>
                <select wire:model="second_language_id" {{ $isControl ? 'disabled' : '' }}>
                    <option value="">{{ __('general.select') }}</option>
                    @foreach($langOpts as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }} ({{ $lang->name_ar }})</option>
                    @endforeach
                </select>
                @error('second_language_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif

            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">📋 Government Info</div>

            <div class="grid-3">
                <div class="form-group">
                    <label>Government Code</label>
                    <input type="text" wire:model="government_code" placeholder="e.g. 12345" {{ $isControl ? 'readonly' : '' }}>
                    @error('government_code') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Seat No.</label>
                    <input type="text" wire:model="seat_no" placeholder="e.g. A12">
                    @error('seat_no') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Secret Code</label>
                    <input type="text" wire:model="secret_code" placeholder="e.g. SEC-001">
                    @error('secret_code') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">👨‍👩‍👧 Parents</div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.father') }}</label>
                    <select wire:model="father_id" {{ $isControl ? 'disabled' : '' }}>
                    <option value="">{{ __('general.select_father') }}</option>
                        @foreach($this->availableFathers as $f)
                            <option value="{{ $f->id }}">{{ $f->nameEn }} ({{ $f->nameAr }})</option>
                        @endforeach
                    </select>
                    @error('father_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.mother') }}</label>
                    <select wire:model="mother_id" {{ $isControl ? 'disabled' : '' }}>
                        <option value="">{{ __('general.select_mother') }}</option>
                        @foreach($this->availableMothers as $m)
                            <option value="{{ $m->id }}">{{ $m->nameEn }} ({{ $m->nameAr }})</option>
                        @endforeach
                    </select>
                    @error('mother_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Guardian</label>
                <select wire:model="guardian" {{ $isControl ? 'disabled' : '' }}>
                    <option value="father">{{ __('general.father') }}</option>
                    <option value="mother">{{ __('general.mother') }}</option>
                    <option value="other">{{ __('general.other') }}</option>
                </select>
                @error('guardian') <span class="error">{{ $message }}</span> @enderror
            </div>

            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">📷 Photo & Age</div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Photo</label>
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <input type="file" wire:model="photo" accept="image/*" style="flex: 1;" {{ $isControl ? 'disabled' : '' }}>
                    </div>
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                    @if($photo)
                        <div style="margin-top: 0.75rem;">
                            <img src="{{ $photo->temporaryUrl() }}" style="max-width: 120px; border-radius: 0.5rem; border: 1px solid var(--crm-input-border);">
                        </div>
                    @elseif($existingPhoto)
                        <div style="margin-top: 0.75rem;">
                            <img src="{{ Storage::url($existingPhoto) }}" style="max-width: 120px; border-radius: 0.5rem; border: 1px solid var(--crm-input-border);">
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ __('general.age_at_oct') }}</label>
                    <input type="text" readonly value="{{ $ageFormatted ?: __('general.auto_calculated') }}" placeholder="{{ __('general.age_birth_auto') }}">
                    <small style="color: var(--crm-text-muted); font-size: 0.75rem;">Calculated automatically when a contact is selected.</small>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('students') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                <button type="submit" class="btn-primary">{{ __('general.save') }}</button>
            </div>
        </form>
    </div>
</div>
