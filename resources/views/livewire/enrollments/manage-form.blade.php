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
    .student-list {
        max-height: 320px; overflow-y: auto;
        border: 1px solid var(--crm-divider); border-radius: 0.5rem;
        margin-top: 0.75rem;
    }
    .student-item {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid var(--crm-divider);
        font-size: 0.875rem; color: var(--crm-text);
    }
    .student-item:last-child { border-bottom: none; }
    .student-item:hover { background: var(--crm-btn-secondary-bg); }
    .checkbox-all {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        background: var(--crm-btn-secondary-bg);
        border-bottom: 1px solid var(--crm-divider);
        font-weight: 600; font-size: 0.875rem; color: var(--crm-text);
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
            <a href="{{ route('enrollments') }}" wire:navigate class="btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">{{ __('general.back') }}</a>
        </div>
        <h1>{{ $enrollment ? __('enrollments.edit_enrollment') : __('enrollments.new_enrollment') }}</h1>

        <form wire:submit.prevent="save">
            @if($enrollment)
                {{-- Edit mode: single student --}}
                <div class="form-group">
                    <label>{{ __('enrollments.student') }}</label>
                    <select wire:model.blur="student_id">
                        <option value="">{{ __('general.select') }}</option>
                        @foreach($this->availableStudents as $s)
                            <option value="{{ $s->id }}">{{ $s->contact?->nameEn ?? __('general.na') }} ({{ $s->contact?->nameAr ?? '' }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            @endif

            <div class="form-group">
                <label>{{ __('enrollments.academic_year') }}</label>
                <select wire:model.blur="academic_year_id">
                    <option value="">{{ __('general.select') }}</option>
                    @foreach($this->academicYears as $ay)
                        <option value="{{ $ay->id }}">{{ $ay->name }}</option>
                    @endforeach
                </select>
                @error('academic_year_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('enrollments.grade') }}</label>
                    <select wire:model.live="grade_id">
                        <option value="">{{ __('general.select_grade') }}</option>
                        @foreach($this->grades as $g)
                            <option value="{{ $g->id }}">{{ $g->name }} ({{ $g->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('grade_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.class') }}</label>
                    <select wire:model.live="section_id">
                        <option value="">{{ __('general.all') }}</option>
                        @foreach($this->availableSections as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('section_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div wire:key="student-list-section">
                <hr class="divider">
                <div class="form-group">
                    <label>Select Students to Enroll</label>
                    @if($studentsByGradeAndSection->isNotEmpty())
                        <div class="student-list">
                            <div class="checkbox-all" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; background: var(--crm-btn-secondary-bg); border-bottom: 1px solid var(--crm-divider); font-weight: 600; font-size: 0.875rem; color: var(--crm-text); cursor: pointer;" wire:click="toggleSelectAll">
                                <span style="width: 1.25rem; text-align: center; font-size: 1rem;">{{ $selectAll ? '✅' : '☐' }}</span>
                                <span style="flex:1;">{{ __('general.all') }}</span>
                                <span style="color: var(--crm-text-muted); font-weight: 400;">{{ count($studentsByGradeAndSection) }} {{ __('nav.students') }}</span>
                            </div>
                            @foreach($studentsByGradeAndSection as $student)
                                <div class="student-item" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-bottom: 1px solid var(--crm-divider); font-size: 0.875rem; color: var(--crm-text); cursor: pointer;" wire:click="toggleStudent({{ $student->id }})">
                                    <span style="width: 1.25rem; text-align: center; font-size: 1rem;">{{ in_array((string)$student->id, $selectedStudents) ? '✅' : '☐' }}</span>
                                    <span style="flex:1;">
                                        {{ $student->contact?->nameEn ?? __('general.na') }}
                                        <span style="color: var(--crm-text-muted); font-size: 0.8rem;">({{ $student->contact?->nameAr ?? '' }})</span>
                                        @if($student->section)
                                            <span style="color: var(--crm-text-muted); font-size: 0.8rem;">— {{ $student->section->name }}</span>
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: var(--crm-text-muted); font-size: 0.875rem; padding: 1rem 0;">{{ __('exams.no_students') }}</p>
                    @endif
                    @error('selectedStudents') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('enrollments.enrollment_date') }}</label>
                    <input type="date" wire:model.blur="enrolled_at">
                    @error('enrolled_at') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('enrollments.status') }}</label>
                    <select wire:model="status">
                        <option value="active">{{ __('general.active') }}</option>
                        <option value="transferred">Transferred</option>
                        <option value="graduated">Graduated</option>
                        <option value="dropped">Dropped</option>
                    </select>
                    @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('enrollments') }}" wire:navigate class="btn-secondary">{{ __('general.cancel') }}</a>
                <button type="submit" class="btn-primary">{{ __('general.save') }}</button>
            </div>
        </form>
    </div>
</div>
