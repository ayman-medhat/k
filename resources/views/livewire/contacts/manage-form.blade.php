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
        --crm-divider-dashed: rgba(0,0,0,0.05);
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
        --crm-divider-dashed: rgba(255,255,255,0.05);
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 2rem;
    }
    .form-card {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        max-width: 720px; margin: 0 auto;
    }
    .form-card h1 {
        font-size: 1.75rem; font-weight: 800; color: var(--crm-text);
        margin-top: 0; margin-bottom: 1.5rem; letter-spacing: -0.5px;
    }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label {
        display: block; margin-bottom: 0.5rem;
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
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; display: block; }
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1rem 0; }
    .checkbox-group label { border-radius: 0.5rem; padding: 0.35rem 0.65rem; border: 1px solid var(--crm-input-border); transition: all 0.15s; }
    .checkbox-group label:has(input:checked) { background: var(--crm-badge-indigo-bg); border-color: var(--crm-input-focus-border); }
    .checkbox-group label:has(input:checked) span { font-weight: 700; color: var(--crm-input-focus-border); }
    .parent-select-row { display: flex; gap: 0.5rem; align-items: flex-end; }
    .parent-select-row .form-group { flex: 1; margin-bottom: 0; }
</style>

    <div class="form-card">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
            <a href="{{ route('contacts') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">← Back</a>
        </div>
        <h1>{{ $contact ? 'Edit Contact' : 'New Contact' }}</h1>

        <form wire:submit.prevent="save">
            <div class="grid-2">
                <div class="form-group">
                    <label>English Name</label>
                    <input type="text" wire:model.blur="nameEn" placeholder="John Doe">
                    @error('nameEn') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Arabic Name</label>
                    <input type="text" wire:model.blur="nameAr" placeholder="جون دو" dir="rtl">
                    @error('nameAr') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" wire:model.blur="email" placeholder="john@example.com">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" wire:model.blur="phone" placeholder="+123456789">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-3">
                <div class="form-group">
                    <label>Categories</label>
                    <div class="checkbox-group" style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 0.25rem;">
                        @foreach(['Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'] as $cat)
                        <label style="display: flex; align-items: center; gap: 0.35rem; cursor: pointer;">
                            <input type="checkbox" value="{{ $cat }}" wire:click="toggleCategory('{{ $cat }}')" {{ in_array($cat, $categories) ? 'checked' : '' }} style="width: auto;">
                            <span style="font-size: 0.875rem; color: var(--crm-text);">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('categories') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Nationality</label>
                    <select wire:model.live="nationality">
                        <option value="Egyptian">Egyptian</option>
                        <option value="American">American</option>
                        <option value="British">British</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('nationality') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select wire:model="status">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Alumni">Alumni</option>
                    </select>
                    @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Religion</label>
                    <select wire:model="religion">
                        <option value="">-- Select --</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Christian">Christian</option>
                    </select>
                    @error('religion') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select wire:model="gender">
                        <option value="">-- Select --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            @if($nationality === 'Egyptian')
            <div class="form-group">
                <label>National ID (14 Digits)</label>
                <input type="text" wire:model="national_id" placeholder="29001011234567">
                @error('national_id') <span class="error">{{ $message }}</span> @enderror
                <small style="color: var(--crm-text-muted); font-size: 0.75rem;">Age and birth date will be calculated automatically.</small>
            </div>
            @else
            <div class="form-group">
                <label>Passport Number</label>
                <input type="text" wire:model="passport_no" placeholder="A1234567">
                @error('passport_no') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif

            @if(in_array('Student', $categories))
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">🎓 Assign Grade</div>
            <div class="form-group">
                <label>Select Grade</label>
                <select wire:model="grade_id">
                    <option value="">-- No Grade Selected --</option>
                    @foreach($this->availableGrades as $g)
                        <option value="{{ $g->id }}">{{ $g->name }} ({{ $g->name_ar }})</option>
                    @endforeach
                </select>
                @error('grade_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif

            @if(in_array('Student', $categories) && $grade_id)
            @php $secondLangOpts = $this->secondLanguageOptions; @endphp
            @if($secondLangOpts->count())
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">🌐 Choose Second Language</div>
            <div class="form-group">
                <label>Select Language</label>
                <select wire:model="second_language_subject_id">
                    <option value="">-- Choose Language --</option>
                    @foreach($secondLangOpts as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }} ({{ $lang->name_ar }})</option>
                    @endforeach
                </select>
                @error('second_language_subject_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif
            @endif

            @if(in_array('Student', $categories))
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">👨 Assign Father</div>
            <div class="form-group">
                <label>Select Father</label>
                <select wire:model="parent_id">
                    <option value="">-- No Father Selected --</option>
                    @foreach($this->availableParents as $p)
                        <option value="{{ $p->id }}">{{ $p->nameEn }} ({{ $p->nameAr }})</option>
                    @endforeach
                </select>
                @error('parent_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">👩 Assign Mother</div>
            <div class="form-group">
                <label>Select Mother</label>
                <select wire:model="mother_id">
                    <option value="">-- No Mother Selected --</option>
                    @foreach($this->availableMothers as $m)
                        <option value="{{ $m->id }}">{{ $m->nameEn }} ({{ $m->nameAr }})</option>
                    @endforeach
                </select>
                @error('mother_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <hr class="divider">
            @endif

            <div class="actions">
                <a href="{{ route('contacts') }}" wire:navigate class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Save Contact</button>
            </div>
        </form>
    </div>
</div>
