<div class="crm-container">
<style>
    :root {
        --crm-bg-from: #f3f4f6;
        --crm-bg-to: #e5e7eb;
        --crm-text: #1f2937;
        --crm-text-muted: #6b7280;
        --crm-border: rgba(0,0,0,0.05);
        --crm-panel-bg: rgba(255,255,255,0.7);
        --crm-panel-border: rgba(255,255,255,0.5);
        --crm-panel-shadow: rgba(0,0,0,0.05);
        --crm-input-bg: #f9fafb;
        --crm-input-border: #d1d5db;
        --crm-input-focus-border: #6366f1;
    }
    .dark {
        --crm-bg-from: #0f172a;
        --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9;
        --crm-text-muted: #94a3b8;
        --crm-border: rgba(255,255,255,0.05);
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b;
        --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1;
    }
    .crm-container {
        font-family: "Inter", system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh;
        padding: 2rem;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .header h1 {
        font-size: 2.5rem;
        color: var(--crm-text);
        margin: 0;
        font-weight: 800;
        letter-spacing: -1px;
    }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid var(--crm-panel-border);
        padding: 2rem;
        box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) {
        .glass-panel { padding: 1rem; }
    }
    .grade-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-bottom: 2rem;
    }
    .grade-chip {
        padding: 0.75rem 1rem;
        border-radius: 9999px;
        border: 2px solid var(--crm-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        font-size: 0.9rem;
    }
    .grade-chip:hover {
        border-color: var(--crm-input-focus-border);
        transform: translateY(-2px);
    }
    .grade-chip.active {
        border-color: #6366f1;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
    }
    .subject-group {
        margin-bottom: 1.5rem;
    }
    .subject-group-title {
        font-weight: 700;
        color: var(--crm-text);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .subject-check {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background 0.15s;
        margin-bottom: 0.25rem;
    }
    .subject-check:hover {
        background: var(--crm-input-bg);
    }
    .subject-check input[type="checkbox"] {
        width: 1.1rem;
        height: 1.1rem;
        accent-color: #6366f1;
        cursor: pointer;
    }
    .subject-check label {
        cursor: pointer;
        color: var(--crm-text);
        font-weight: 500;
    }
    .branch-indent {
        margin-left: 1.75rem;
    }
    .branch-indent label {
        color: var(--crm-text-muted);
        font-size: 0.9rem;
    }
    .badge-main {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        background: #dbeafe;
        color: #1d4ed8;
        text-transform: uppercase;
    }
    .badge-optional {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        background: #fef3c7;
        color: #b45309;
        text-transform: uppercase;
    }
    .badge-religion {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        background: #e0e7ff;
        color: #4338ca;
        text-transform: uppercase;
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--crm-text-muted);
    }
</style>

    <div class="header">
        <h1>Grade &amp; Subject Assignment</h1>
    </div>

    <div class="glass-panel">
        <div style="font-weight: 600; color: var(--crm-text-muted); margin-bottom: 0.75rem;">Select a Grade</div>
        <div class="grade-grid">
            @foreach($this->grades as $grade)
            <button
                wire:click="selectGrade({{ $grade->id }})"
                class="grade-chip @if($selectedGradeId === $grade->id) active @endif"
            >
                <div>{{ $grade->name }}</div>
                <div style="font-size: 0.75rem; opacity: 0.75;">{{ $grade->name_ar }}</div>
            </button>
            @endforeach
        </div>

        @if($selectedGradeId)
            <hr style="border: none; border-top: 1px solid var(--crm-border); margin: 1.5rem 0;">

            <div style="font-weight: 600; color: var(--crm-text); margin-bottom: 1rem;">
                Subjects for <span style="color: var(--crm-input-focus-border);">{{ $this->grades->firstWhere("id", $selectedGradeId)?->name }}</span>
            </div>

            @forelse($this->rootSubjects as $subject)
                <div class="subject-group">
                    <div class="subject-check" style="font-weight: 600;">
                        <input type="checkbox"
                            id="subject-{{ $subject->id }}"
                            value="{{ $subject->id }}"
                            wire:change="toggleSubject({{ $subject->id }})"
                            @if(in_array($subject->id, $assignedSubjectIds)) checked @endif
                        >
                        <label for="subject-{{ $subject->id }}">
                            {{ $subject->name }}
                            @if($subject->is_religion_based)
                                <span class="badge-religion">Religion-based</span>
                            @elseif($subject->is_main)
                                <span class="badge-main">Main</span>
                            @else
                                <span class="badge-optional">Optional</span>
                            @endif
                        </label>
                    </div>

                    @if($subject->children->count())
                        @foreach($subject->children as $child)
                        <div class="subject-check branch-indent">
                            <input type="checkbox"
                                id="subject-{{ $child->id }}"
                                value="{{ $child->id }}"
                                wire:change="toggleSubject({{ $child->id }})"
                                @if(in_array($child->id, $assignedSubjectIds)) checked @endif
                            >
                            <label for="subject-{{ $child->id }}">
                                {{ $child->name }}
                                @if($child->religion)
                                    <span style="font-size: 0.75rem; color: var(--crm-text-muted);">({{ $child->religion }})</span>
                                @endif
                                @if(!$child->is_main)
                                    <span class="badge-optional">Optional</span>
                                @endif
                            </label>
                        </div>
                        @endforeach
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    No subjects defined. Create subjects first.
                </div>
            @endforelse
        @else
            <div class="empty-state">
                Select a grade above to manage its subject assignments.
            </div>
        @endif
    </div>
</div>
