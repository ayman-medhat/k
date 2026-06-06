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
        border-radius: 1rem;
        border: 1px solid var(--crm-panel-border);
        padding: 2rem;
        box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        max-width: 720px;
        margin: 0 auto;
    }
    .form-card h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--crm-text);
        margin-top: 0;
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
    }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label {
        display: block; margin-bottom: 0.5rem;
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
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem; display: block; }
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
    .actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; }
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
        padding: 0.75rem 1rem; margin-bottom: 1.5rem;
        font-size: 0.875rem; color: #92400e;
        display: flex; align-items: center; gap: 0.5rem;
    }
</style>

    <div class="form-card">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
            <a href="{{ route('leads') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">← Back</a>
        </div>
        <h1>
            @if($creatingParentForStudent)
                New Father
            @elseif($creatingMotherForStudent)
                New Mother
            @elseif($lead)
                Edit Lead
            @else
                New Lead
            @endif
        </h1>

        @if($creatingParentForStudent)
        <div class="parent-creation-banner">
            <span>⭐</span>
            <span>You are creating a new <strong>Father</strong>. After saving, you'll be returned to the Student form.</span>
        </div>
        @elseif($creatingMotherForStudent)
        <div class="parent-creation-banner">
            <span>⭐</span>
            <span>You are creating a new <strong>Mother</strong>. After saving, you'll be returned to the Student form.</span>
        </div>
        @endif

        @if($readOnly)
        <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1px solid #6ee7b7; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem; color: #065f46;">
            <div style="font-weight: 700; margin-bottom: 0.5rem;">✔ Accepted Lead — Read Only</div>
            <div style="font-size: 0.8rem;">This lead has been accepted and copied to Contacts. The information below is for reference only.</div>
        </div>

        <div class="card-details">
            @php $l = $lead; @endphp
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div><strong>English Name:</strong> {{ $l->nameEn }}</div>
                <div><strong>Arabic Name:</strong> {{ $l->nameAr }}</div>
                <div><strong>Email:</strong> {{ $l->email ?? 'N/A' }}</div>
                <div><strong>Phone:</strong> {{ $l->phone ?? 'N/A' }}</div>
                <div><strong>Categories:</strong> {{ implode(', ', $l->categories ?? []) }}</div>
                <div><strong>Status:</strong> {{ $l->status }}</div>
                <div><strong>Religion:</strong> {{ $l->religion ?? 'N/A' }}</div>
                <div><strong>Gender:</strong> {{ $l->gender ?? 'N/A' }}</div>
                <div><strong>Birth Date:</strong> {{ $l->birth_date?->format('Y-m-d') ?? 'N/A' }}</div>
                <div><strong>Age at 1st October:</strong> {{ $l->birth_date ? \App\Models\Student::formatAgeAtOctober($l->birth_date->format('Y-m-d')) : 'N/A' }}</div>
            </div>
            <div class="actions" style="margin-top: 1.5rem;">
                <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">← Back to Leads</a>
            </div>
        </div>
        @else

        <form wire:submit.prevent="{{ $creatingParentForStudent ? 'saveParentAndReturn' : ($creatingMotherForStudent ? 'saveMotherAndReturn' : 'save') }}">
            <div class="grid-2">
                <div class="form-group">
                    <label>English Name</label>
                    <input type="text" wire:model.blur="nameEn" placeholder="John Doe" {{ $readOnly ? 'disabled' : '' }}>
                    @error('nameEn') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Arabic Name</label>
                    <input type="text" wire:model.blur="nameAr" placeholder="جون دو" dir="rtl" {{ $readOnly ? 'disabled' : '' }}>
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

            @if(!$creatingParentForStudent)
            <div class="grid-2">
                <div class="form-group">
                    <label>Categories</label>
                    <div class="checkbox-group" style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 0.25rem;">
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
                    <label>Status</label>
                    <select wire:model="status">
                        <option value="New">New</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Tour Scheduled">Tour Scheduled</option>
                        <option value="Applied">Applied</option>
                        <option value="Enrolled">Enrolled</option>
                        <option value="Lost">Lost</option>
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
            @else
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
            @endif

            <div class="grid-2">
                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="date" wire:model.live="birth_date">
                    @error('birth_date') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Age at 1st October</label>
                    <input type="text" readonly value="{{ $birth_date ? ($ageFormatted ?: 'Auto-calculated') : '—' }}">
                </div>
            </div>

            @if(!$creatingParentForStudent && !$creatingMotherForStudent && in_array('Student', $categories))
            <hr class="divider">
            <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">📋 Student academic info is managed in the <a href="{{ route('students') }}" wire:navigate style="color: var(--crm-input-focus-border);">Students</a> section.</div>
            @endif

            <div class="actions">
                @if($creatingParentForStudent)
                    <button type="button" wire:click="cancelParentCreation" class="btn-secondary">← Back to Student</button>
                    <button type="submit" class="btn-success">Save Father & Return</button>
                @elseif($creatingMotherForStudent)
                    <button type="button" wire:click="cancelParentCreation" class="btn-secondary">← Back to Student</button>
                    <button type="submit" class="btn-success">Save Mother & Return</button>
                @else
                    <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">Save Lead</button>
                @endif
            </div>
        </form>
        @endif
    </div>
</div>
