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
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .form-card {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem;
        box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        max-width: 720px;
        margin: 0 auto;
    }
    .form-card h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--crm-text);
        margin-top: 0;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
    }
    .form-group { margin-bottom: 0.75rem; }
    .form-group label {
        display: block; margin-bottom: 0.75rem;
        font-weight: 500; color: var(--crm-text-muted);
        font-size: 0.875rem;
    }
    .form-group input, .form-group select {
        width: 100%; padding: 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        transition: all 0.2s; box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
        background: var(--crm-panel-bg);
    }
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.75rem; display: block; }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-success {
        background: var(--crm-btn-success-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg);
        color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1rem 0; }
    .parent-select-row { display: flex; gap: 0.5rem; align-items: flex-end; }
    .parent-select-row .form-group { flex: 1; margin-bottom: 0; }
    .checkbox-group label { border-radius: 0.5rem; padding: 0.35rem 0.65rem; border: 1px solid var(--crm-input-border); transition: all 0.15s; }
    .checkbox-group label:has(input:checked) { background: transparent; border-color: transparent; }
    .checkbox-group label:has(input:checked) span { font-weight: 400; color: var(--crm-text); }
    .parent-creation-banner {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 1px solid #fde68a; border-radius: 0.75rem;
        padding: 0.75rem 1rem; margin-bottom: 0.75rem;
        font-size: 0.875rem; color: #92400e;
        display: flex; align-items: center; gap: 0.5rem;
    }
</style>

    <div class="form-card">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
            <a href="{{ route('leads') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>
            @if($creatingParentForStudent)
                {{ __('leads.new_father') }}
            @elseif($creatingMotherForStudent)
                {{ __('leads.new_mother') }}
            @elseif($lead)
                {{ __('leads.edit_lead') }}
            @else
                {{ __('leads.new_lead') }}
            @endif
        </h1>

        @if($creatingParentForStudent)
        <div class="parent-creation-banner">
            <span>⭐</span>
            <span>{!! __('leads.creating_father') !!}</span>
        </div>
        @elseif($creatingMotherForStudent)
        <div class="parent-creation-banner">
            <span>⭐</span>
            <span>{!! __('leads.creating_mother') !!}</span>
        </div>
        @endif

        @if($readOnly)
        <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1px solid #6ee7b7; border-radius: 0.75rem; padding: 1rem; margin-bottom: 0.75rem; font-size: 0.9rem; color: #065f46;">
            <div style="font-weight: 700; margin-bottom: 0.75rem;">{{ __('leads.accepted_readonly') }}</div>
            <div style="font-size: 0.8rem;">{{ __('leads.accepted_readonly_desc') }}</div>
        </div>

        <div class="card-details">
            @php $l = $lead; @endphp
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div><strong>{{ __('general.name_en') }}:</strong> {{ $l->nameEn }}</div>
                <div><strong>{{ __('general.name_ar') }}:</strong> {{ $l->nameAr }}</div>
                <div><strong>{{ __('general.email') }}:</strong> {{ $l->email ?? __('general.na') }}</div>
                <div><strong>{{ __('general.phone') }}:</strong> {{ $l->phone ?? __('general.na') }}</div>
                <div><strong>{{ __('general.categories') }}:</strong> {{ collect($l->categories ?? [])->map(fn($c) => __('general.' . strtolower($c)))->implode(', ') }}</div>
                <div><strong>{{ __('general.status') }}:</strong> {{ app()->getLocale() === 'ar' ? ($l->status_ar ?? __('general.' . strtolower($l->status))) : $l->status }}</div>
                <div><strong>{{ __('general.religion') }}:</strong> {{ app()->getLocale() === 'ar' ? ($l->religion_ar ?? __('general.' . strtolower($l->religion))) : $l->religion }}</div>
                <div><strong>{{ __('general.gender') }}:</strong> {{ app()->getLocale() === 'ar' ? ($l->gender_ar ?? __('general.' . strtolower($l->gender))) : $l->gender }}</div>
                <div><strong>{{ __('general.birth_date') }}:</strong> {{ $l->birth_date?->format('Y-m-d') ?? __('general.na') }}</div>
                <div><strong>{{ __('general.age_at_oct') }}:</strong> {{ $l->birth_date ? \App\Models\Student::formatAgeAtOctober($l->birth_date->format('Y-m-d')) : __('general.na') }}</div>
            </div>
            <div class="actions" style="margin-top: 0.75rem;">
                <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">{{ __('leads.back_to_leads') }}</a>
            </div>
        </div>
        @else

        <form wire:submit.prevent="{{ $creatingParentForStudent ? 'saveParentAndReturn' : ($creatingMotherForStudent ? 'saveMotherAndReturn' : 'save') }}">
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.name_en') }}</label>
                    <input type="text" wire:model.blur="nameEn" placeholder="{{ __('general.john_doe_en') }}" {{ $readOnly ? 'disabled' : '' }}>
                    @error('nameEn') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.name_ar') }}</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" wire:model.blur="nameAr" placeholder="{{ __('general.john_doe_ar') }}" dir="rtl" style="flex: 1;" {{ $readOnly ? 'disabled' : '' }}>
                        @if(!$readOnly)
                        <button type="button" wire:click="translateName" class="btn-secondary" style="padding: 0.4rem 0.7rem; font-size: 0.75rem; white-space: nowrap; flex-shrink: 0;" title="Translate Arabic name to Latin letters">ترجمة</button>
                        @endif
                    </div>
                    @error('nameAr') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0.75rem;">
                <label>{{ __('general.photo') }}</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    @if($photo && !is_object($photo))
                        <img src="{{ asset('storage/' . $photo) }}" style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover; border: 2px solid var(--crm-border);">
                    @elseif($photo && is_object($photo))
                        <img src="{{ $photo->temporaryUrl() }}" style="width: 4rem; height: 4rem; border-radius: 50%; object-fit: cover; border: 2px solid var(--crm-border);">
                    @endif
                    <input type="file" wire:model="photo" accept="image/*" style="font-size: 0.875rem;" {{ $readOnly ? 'disabled' : '' }}>
                </div>
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.email') }}</label>
                    <input type="email" wire:model.blur="email" placeholder="{{ __('general.email_placeholder') }}">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.phone') }}</label>
                    <input type="text" wire:model.blur="phone" placeholder="{{ __('general.phone_placeholder') }}">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.categories') }}</label>
                    <div class="checkbox-group" style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 0.75rem;">
                        @foreach($this->allowedCategoryOptions as $cat)
                        <label style="display: flex; align-items: center; gap: 0.35rem; cursor: pointer;">
                            <div style="position: relative; width: 1.1rem; height: 1.1rem; flex-shrink: 0;">
                                <input type="checkbox" value="{{ $cat }}" wire:click="toggleCategory('{{ $cat }}')" {{ in_array($cat, $categories) ? 'checked' : '' }} style="position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; margin: 0;">
                                <div style="width: 100%; height: 100%; border: 2px solid var(--crm-input-border, #d1d5db); border-radius: 0.25rem; display: flex; align-items: center; justify-content: center; background: transparent !important;">
                                    @if(in_array($cat, $categories)) <span style="font-size: 0.75rem; line-height: 1;">✅</span> @endif
                                </div>
                            </div>
                            <span style="font-size: 0.875rem; color: var(--crm-text);">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('categories') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.nationality') }}</label>
                    <select wire:model.live="nationality">
                        <option value="Egyptian">{{ __('general.egyptian') }}</option>
                        <option value="American">{{ __('general.american') }}</option>
                        <option value="British">{{ __('general.british') }}</option>
                        <option value="Other">{{ __('general.other') }}</option>
                    </select>
                    @error('nationality') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            @if($nationality === 'Egyptian')
            <div class="form-group">
                <label>{{ __('general.national_id') }}</label>
                <input type="text" wire:model="national_id" placeholder="{{ __('general.national_id_placeholder') }}">
                @error('national_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            @else
            <div class="form-group">
                <label>{{ __('general.passport_no') }}</label>
                <input type="text" wire:model="passport_no" placeholder="{{ __('general.passport_placeholder') }}">
                @error('passport_no') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif

            @if(!$creatingParentForStudent && !$creatingMotherForStudent)
            @if(in_array('Student', $categories))
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">{{ __('general.parent_info') }}</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.father') }}</label>
                    <div class="parent-select-row">
                        <select wire:model="parent_id" style="flex: 1;">
                            <option value="">{{ __('general.select_father') }}</option>
                            @foreach($this->availableParents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->nameEn }} ({{ $parent->nameAr }})</option>
                            @endforeach
                        </select>
                        <button type="button" wire:click="startCreatingParent" class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; white-space: nowrap;">{{ __('general.add') }}</button>
                    </div>
                    @error('parent_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.mother') }}</label>
                    <div class="parent-select-row">
                        <select wire:model="mother_id" style="flex: 1;">
                            <option value="">{{ __('general.select_mother') }}</option>
                            @foreach($this->availableMothers as $mother)
                            <option value="{{ $mother->id }}">{{ $mother->nameEn }} ({{ $mother->nameAr }})</option>
                            @endforeach
                        </select>
                        <button type="button" wire:click="startCreatingMother" class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; white-space: nowrap;">{{ __('general.add') }}</button>
                    </div>
                    @error('mother_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('general.grade') }}</label>
                <select wire:model="grade_id">
                    <option value="">{{ __('general.select_grade') }}</option>
                    @foreach($this->availableGrades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif
            <hr class="divider">
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.status') }}</label>
                    <select wire:model="status">
                        <option value="New">{{ __('general.new') }}</option>
                        <option value="Contacted">{{ __('general.contacted') }}</option>
                        <option value="Tour Scheduled">{{ __('general.tour_scheduled') }}</option>
                        <option value="Applied">{{ __('general.applied') }}</option>
                        <option value="Enrolled">{{ __('general.enrolled') }}</option>
                        <option value="Lost">{{ __('general.lost') }}</option>
                    </select>
                    @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.religion') }}</label>
                    <select wire:model="religion">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Muslim">{{ __('general.muslim') }}</option>
                        <option value="Christian">{{ __('general.christian') }}</option>
                    </select>
                    @error('religion') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.gender') }}</label>
                    <select wire:model="gender">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Male">{{ __('general.male') }}</option>
                        <option value="Female">{{ __('general.female') }}</option>
                    </select>
                    @error('gender') <span class="error">{{ $message }}</span> @enderror
                </div>
                @if($nationality !== 'Egyptian')
                <div class="form-group">
                    <label>{{ __('general.birth_date') }}</label>
                    <input type="date" wire:model.live="birth_date">
                    @error('birth_date') <span class="error">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
            @if($birth_date)
            <div class="form-group">
                <label>{{ __('general.age_at_oct') }}</label>
                <input type="text" readonly value="{{ $ageFormatted ?: __('general.auto_calculated') }}">
            </div>
            @endif
            @else
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.status') }}</label>
                    <select wire:model="status">
                        <option value="New">{{ __('general.new') }}</option>
                        <option value="Contacted">{{ __('general.contacted') }}</option>
                        <option value="Tour Scheduled">{{ __('general.tour_scheduled') }}</option>
                        <option value="Applied">{{ __('general.applied') }}</option>
                        <option value="Enrolled">{{ __('general.enrolled') }}</option>
                        <option value="Lost">{{ __('general.lost') }}</option>
                    </select>
                    @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.religion') }}</label>
                    <select wire:model="religion">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Muslim">{{ __('general.muslim') }}</option>
                        <option value="Christian">{{ __('general.christian') }}</option>
                    </select>
                    @error('religion') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.gender') }}</label>
                    <select wire:model="gender">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Male">{{ __('general.male') }}</option>
                        <option value="Female">{{ __('general.female') }}</option>
                    </select>
                    @error('gender') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif

            @if(!$creatingParentForStudent && !$creatingMotherForStudent && in_array('Student', $categories))
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">{!! __('general.student_academic_info') !!}</div>
            @endif

            <div class="actions">
                @if($creatingParentForStudent)
                    <button type="button" wire:click="cancelParentCreation" class="btn-secondary">← Back to Student</button>
                    <button type="submit" class="btn-success">{{ __('leads.save_father') }}</button>
                @elseif($creatingMotherForStudent)
                    <button type="button" wire:click="cancelParentCreation" class="btn-secondary">← Back to Student</button>
                    <button type="submit" class="btn-success">{{ __('leads.save_mother') }}</button>
                @else
                    <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                    <button type="submit" class="btn-primary">{{ __('leads.save_lead') }}</button>
                @endif
            </div>
        </form>
        @endif
    </div>

    @if($showDuplicateModal && $existingDuplicate)
    <div class="modal-overlay" wire:ignore.self x-data x-init="$el.style.display='flex'">
        <div class="modal-box" style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border); padding: 2rem; max-width: 480px; width: 100%; margin: 2rem auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--crm-text); margin: 0 0 0.5rem;">{{ __('general.duplicate_found') }}</h3>
            <p style="color: var(--crm-text-muted); font-size: 0.9rem; margin-bottom: 0.75rem;">
                {{ __('general.duplicate_national_id') }} <strong>{{ $national_id }}</strong>
            </p>
            <div style="background: var(--crm-input-bg); border-radius: 0.5rem; padding: 0.75rem 1rem; margin-bottom: 0.75rem; border: 1px solid var(--crm-divider);">
                <div style="font-weight: 600; color: var(--crm-text);">{{ $existingDuplicate->nameEn }} ({{ $existingDuplicate->nameAr }})</div>
                <div style="color: var(--crm-text-muted); font-size: 0.85rem; margin-top: 0.75rem;">{{ __('general.status') }}: {{ $existingDuplicate->status }} | {{ __('general.categories') }}: {{ collect($existingDuplicate->categories ?? [])->map(fn($c) => __('general.' . strtolower($c)))->implode(', ') }}</div>
            </div>
            <p style="color: var(--crm-text-muted); font-size: 0.85rem; margin-bottom: 0.75rem;">{{ __('general.what_to_do') }}</p>
            <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                <button wire:click="ignoreDuplicate" class="btn-secondary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">{{ __('general.ignore') }}</button>
                <button wire:click="confirmUpdateExisting" class="btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">{{ __('general.update_existing') }}</button>
            </div>
        </div>
    </div>
    <style>
        .modal-overlay {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            align-items: center; justify-content: center; padding: 1rem;
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
    @endif
</div>
