{{-- ============================================================
     Parent Dashboard View
     Route: /parent — Shows children cards + "Add Child" form
     Uses CRM CSS variables for consistent light/dark mode
     ============================================================ --}}
<div class="crm-container" style="padding: 2rem 1rem;">
<style>
    {{-- CRM container styling (gradient bg from CSS variables) --}}
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh;
    }
</style>
    <div style="max-width: 900px; margin: 0 auto;">
    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
        <div>
            <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--crm-text, #1f2937); margin: 0;">My Dashboard</h1>
            <p style="color: var(--crm-text-muted, #6b7280); margin-top: 0.75rem; font-size: 0.9rem;">
                Welcome, {{ $parentLead->nameEn }}
            </p>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('message'))
    <div style="background: #059669; color: white; padding: 0.75rem 1rem; border-radius: 0.75rem; margin-bottom: 0.75rem; font-weight: 600;">
        {{ session('message') }}
    </div>
    @endif

    {{-- Parent Info Card --}}
    <div style="background: var(--crm-card-bg, white); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border, rgba(255,255,255,0.5)); padding: 1.5rem; margin-bottom: 0.75rem; box-shadow: 0 10px 15px -3px var(--crm-panel-shadow, rgba(0,0,0,0.05));">
        <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--crm-text, #1f2937); margin: 0 0 1rem 0; padding-bottom: 0.75rem; border-bottom: 2px solid var(--crm-divider, #e5e7eb);">Parent Information</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
            <div>
                <span style="font-size: 0.75rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Name (En)</span>
                <div style="font-weight: 600; color: var(--crm-text, #1f2937);">{{ $parentLead->nameEn }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Name (Ar)</span>
                <div style="font-weight: 600; color: var(--crm-text, #1f2937);" dir="rtl">{{ $parentLead->nameAr }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Email</span>
                <div style="color: var(--crm-text, #1f2937);">{{ $parentLead->email }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Phone</span>
                <div style="color: var(--crm-text, #1f2937);">{{ $parentLead->phone ?? '—' }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Status</span>
                <div>
                    <span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background: #e0e7ff; color: #4338ca;">{{ $parentLead->status }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Child / Edit Child Button --}}
    <div style="margin-bottom: 0.75rem;">
        <button wire:click="toggleForm" style="padding: 0.6rem 1.5rem; background: var(--crm-btn-primary-bg); color: white; border: none; border-radius: 9999px; font-weight: 600; font-size: 0.9rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3); transition: all 0.2s;">
            {{ $showForm ? 'Cancel' : '+ Add Child' }}
        </button>
    </div>

    {{-- Add/Edit Child Form --}}
    @if($showForm)
    <form wire:submit="addChild" style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border); padding: 1.5rem; margin-bottom: 0.75rem; box-shadow: 0 10px 15px -3px var(--crm-panel-shadow);">
        <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--crm-text); margin: 0 0 1.25rem 0; padding-bottom: 0.75rem; border-bottom: 2px solid var(--crm-divider);">{{ $editingChildId ? 'Edit Child' : 'Add Child' }}</h2>

        <style>
            .form-input {
                width: 100%; padding: 0.6rem 0.75rem; border-radius: 0.5rem;
                border: 1px solid var(--crm-input-border, #d1d5db); font-size: 0.9rem;
                box-sizing: border-box; background: var(--crm-input-bg, #f9fafb);
                color: var(--crm-text, #1f2937); transition: all 0.15s;
            }
            .form-input:focus {
                outline: none; border-color: var(--crm-input-focus-border, #6366f1);
                box-shadow: 0 0 0 3px var(--crm-input-focus-ring, rgba(99,102,241,0.2));
            }
            .form-label {
                display: block; font-size: 0.85rem; font-weight: 600;
                color: var(--crm-table-head, #4b5563); margin-bottom: 0.75rem;
            }
        </style>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label class="form-label">Name (English) <span style="color: #ef4444;">*</span></label>
                <input type="text" wire:model="childNameEn" class="form-input">
                @error('childNameEn') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="form-label">Name (Arabic) <span style="color: #ef4444;">*</span></label>
                <input type="text" wire:model="childNameAr" class="form-input" dir="rtl">
                @error('childNameAr') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="form-label">Gender <span style="color: #ef4444;">*</span></label>
                <select wire:model="childGender" class="form-input">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('childGender') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="form-label">National ID</label>
                <input type="text" wire:model="childNationalId" class="form-input" maxlength="14" placeholder="14-digit national ID">
                @error('childNationalId') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="form-label">Date of Birth <span style="color: #ef4444;">*</span></label>
                <input type="date" wire:model="childBirthDate" class="form-input">
                @error('childBirthDate') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="form-label">Grade <span style="color: #ef4444;">*</span></label>
                <select wire:model="childGradeId" class="form-input">
                    <option value="">Select Grade</option>
                    @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('childGradeId') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 0.75rem; text-align: right;">
            <button type="submit" style="padding: 0.6rem 2rem; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; border: none; border-radius: 9999px; font-weight: 600; font-size: 0.9rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.3); transition: all 0.2s;">
                {{ $editingChildId ? 'Update Child' : 'Add Child' }}
            </button>
        </div>
    </form>
    @endif

    {{-- Children Section --}}
    <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--crm-text, #1f2937); margin: 0 0 1rem 0;">My Children</h2>

    @if(count($children) === 0)
    <div style="text-align: center; padding: 3rem; background: var(--crm-empty-bg, var(--crm-card-bg, white)); border-radius: 1rem; border: 1px solid var(--crm-panel-border, rgba(255,255,255,0.5));">
        <div style="font-size: 3rem; margin-bottom: 0.75rem;">👶</div>
        <p style="color: var(--crm-text-muted, #6b7280);">No children registered yet.</p>
    </div>
    @else
    <div style="display: grid; gap: 1rem;">
        @foreach($children as $child)
        <div style="background: var(--crm-card-bg, white); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border, rgba(255,255,255,0.5)); padding: 1.25rem; box-shadow: 0 4px 6px -1px var(--crm-panel-shadow, rgba(0,0,0,0.05));">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <div style="font-size: 1.1rem; font-weight: 700; color: var(--crm-text, #1f2937);">{{ $child->nameEn }}</div>
                    <div style="color: var(--crm-text-muted, #6b7280); font-size: 0.85rem;" dir="rtl">{{ $child->nameAr }}</div>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                    @if($child->status === 'Accepted')
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background: #dcfce7; color: #15803d;">✓ Accepted</span>
                    @elseif($child->status === 'Cancelled')
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background: #fee2e2; color: #dc2626;">✕ Cancelled</span>
                    @elseif($child->status === 'New')
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background: #fef3c7; color: #d97706;">Pending Review</span>
                    @else
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background: #e0e7ff; color: #4338ca;">{{ $child->status }}</span>
                    @endif
                    @if(!in_array($child->status, ['Accepted', 'Cancelled']))
                    <button wire:click="editChild({{ $child->id }})" style="padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #93c5fd; background: transparent; color: #2563eb; cursor: pointer;">
                        Edit
                    </button>
                    <button wire:click="cancelChild({{ $child->id }})" wire:confirm="Cancel admission for {{ $child->nameEn }}?" style="padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; border: 1px solid #fca5a5; background: transparent; color: #dc2626; cursor: pointer;">
                        Cancel
                    </button>
                    @endif
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 0.75rem; margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid var(--crm-divider-dashed, rgba(0,0,0,0.05));">
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Gender</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->gender ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Grade</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->grade->name ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Date of Birth</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->birth_date ? $child->birth_date->format('M d, Y') : '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Age</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->detailed_age ?? ($child->age ? $child->age . ' years' : '—') }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">National ID</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->national_id ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Email</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->email ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Phone</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->phone ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Religion</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->religion ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Nationality</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->nationality ?? '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Registered</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->created_at ? $child->created_at->format('M d, Y') : '—' }}</div>
                </div>
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Source</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->source ?? '—' }}</div>
                </div>
                @if($child->passport_no)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Passport</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->passport_no }}</div>
                </div>
                @endif
                @if($child->mother)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Mother</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->mother->nameEn }}</div>
                </div>
                @endif
            </div>

            @if($child->notes)
            <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid var(--crm-divider-dashed, rgba(0,0,0,0.05));">
                <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Notes</span>
                <div style="font-size: 0.85rem; color: var(--crm-text, #1f2937); margin-top: 0.75rem;">{{ $child->notes }}</div>
            </div>
            @endif

            @if($child->linkedContact && $child->linkedStudent)
            <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid var(--crm-divider-dashed, rgba(0,0,0,0.05)); display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Student ID</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->id }}</div>
                </div>
                @if($child->linkedStudent->section)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Class</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->section->name }}</div>
                </div>
                @endif
                @if($child->linkedStudent->grade)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Grade</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->grade->name }}</div>
                </div>
                @endif
                @if($child->linkedStudent->seat_no)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Seat No</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->seat_no }}</div>
                </div>
                @endif
                @if($child->linkedStudent->government_code)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Gov Code</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->government_code }}</div>
                </div>
                @endif
                @if($child->linkedStudent->guardian)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Guardian</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ ucfirst($child->linkedStudent->guardian) }}</div>
                </div>
                @endif
                @if($child->linkedStudent->age_at_october)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">Age (Oct 1)</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->age_at_october }} years</div>
                </div>
                @endif
                @if($child->linkedStudent->secondLanguage)
                <div>
                    <span style="font-size: 0.7rem; color: var(--crm-text-muted, #6b7280); font-weight: 500; text-transform: uppercase;">2nd Language</span>
                    <div style="font-size: 0.9rem; color: var(--crm-text, #1f2937);">{{ $child->linkedStudent->secondLanguage->name }}</div>
                </div>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    </div>
</div>
