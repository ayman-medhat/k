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
        --crm-input-focus-ring: rgba(99,102,241,0.2);
        --crm-table-head: #4b5563;
        --crm-card-bg: rgba(255,255,255,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.1);
        --crm-badge-indigo-bg: #e0e7ff;
        --crm-badge-indigo-text: #4338ca;
        --crm-badge-student-bg: #fef3c7;
        --crm-badge-student-text: #d97706;
        --crm-badge-parent-bg: #dcfce7;
        --crm-badge-parent-text: #15803d;
        --crm-banner-bg: linear-gradient(135deg, #fffbeb, #fef3c7);
        --crm-banner-border: #fde68a;
        --crm-banner-label: #92400e;
        --crm-banner-name: #78350f;
        --crm-btn-secondary-bg: #f3f4f6;
        --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151;
        --crm-divider: #e5e7eb;
        --crm-divider-dashed: rgba(0,0,0,0.05);
        --crm-toggle-bg: rgba(255,255,255,0.5);
        --crm-toggle-shadow: rgba(0,0,0,0.05);
        --crm-tab-bg: rgba(255,255,255,0.6);
        --crm-tab-hover-bg: rgba(255,255,255,0.9);
        --crm-tab-text: #6b7280;
        --crm-tab-hover-text: #4f46e5;
        --crm-tab-active-bg: white;
        --crm-tab-active-text: #4f46e5;
        --crm-tab-active-border: #6366f1;
        --crm-tab-shadow: rgba(0,0,0,0.06);
        --crm-tab-active-shadow: rgba(99,102,241,0.2);
        --crm-pill-bg: #e0e7ff;
        --crm-pill-text: #4338ca;
        --crm-pill-active-bg: #6366f1;
        --crm-pill-active-text: white;
        --crm-empty-bg: rgba(255,255,255,0.7);
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
        --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-table-head: #94a3b8;
        --crm-card-bg: rgba(30,41,59,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.4);
        --crm-badge-indigo-bg: #312e81;
        --crm-badge-indigo-text: #a5b4fc;
        --crm-badge-student-bg: #451a03;
        --crm-badge-student-text: #fcd34d;
        --crm-badge-parent-bg: #052e16;
        --crm-badge-parent-text: #4ade80;
        --crm-banner-bg: linear-gradient(135deg, #451a03, #78350f);
        --crm-banner-border: #92400e;
        --crm-banner-label: #fef3c7;
        --crm-banner-name: #fde68a;
        --crm-btn-secondary-bg: #334155;
        --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0;
        --crm-divider: #334155;
        --crm-divider-dashed: rgba(255,255,255,0.05);
        --crm-toggle-bg: rgba(255,255,255,0.06);
        --crm-toggle-shadow: rgba(0,0,0,0.2);
        --crm-tab-bg: rgba(255,255,255,0.06);
        --crm-tab-hover-bg: rgba(255,255,255,0.12);
        --crm-tab-text: #94a3b8;
        --crm-tab-hover-text: #a5b4fc;
        --crm-tab-active-bg: #1e293b;
        --crm-tab-active-text: #a5b4fc;
        --crm-tab-active-border: #6366f1;
        --crm-tab-shadow: rgba(0,0,0,0.2);
        --crm-tab-active-shadow: rgba(99,102,241,0.4);
        --crm-pill-bg: #312e81;
        --crm-pill-text: #e0e7ff;
        --crm-pill-active-bg: #6366f1;
        --crm-pill-active-text: white;
        --crm-empty-bg: rgba(30,41,59,0.7);
    }

    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
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
    .header-actions {
        display: flex;
        align-items: center;
    }
    .toggle-group {
        display: flex;
        background: var(--crm-toggle-bg);
        border-radius: 9999px;
        padding: 0.25rem;
        margin-right: 1rem;
        box-shadow: inset 0 2px 4px var(--crm-toggle-shadow);
    }
    .toggle-btn {
        background: transparent;
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-weight: 600;
        color: var(--crm-text-muted);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.875rem;
    }
    .toggle-btn.active {
        background: var(--crm-tab-active-bg);
        color: var(--crm-tab-active-text);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4);
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
    }
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 0.8rem;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4);
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-success:hover {
        transform: translateY(-1px);
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
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 0.5rem 0.75rem;
        text-align: left;
        border-bottom: 1px solid var(--crm-divider-dashed);
    }
    @media (max-width: 640px) {
        th, td { padding: 0.35rem 0.5rem; }
    }
    th {
        font-weight: 600;
        color: var(--crm-table-head);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    td {
        color: var(--crm-text);
        font-size: 0.875rem;
    }
    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--crm-badge-indigo-bg);
        color: var(--crm-badge-indigo-text);
    }
    .badge-student {
        background: var(--crm-badge-student-bg);
        color: var(--crm-badge-student-text);
    }
    .badge-parent {
        background: var(--crm-badge-parent-bg);
        color: var(--crm-badge-parent-text);
    }
    /* Cards Layout */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.5rem;
    }
    .card {
        background: var(--crm-card-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid var(--crm-panel-border);
        padding: 1.5rem;
        box-shadow: 0 10px 15px -3px var(--crm-panel-shadow);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card.has-parent {
        border-top: 3px solid #f59e0b;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px -5px var(--crm-card-hover-shadow);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .card-title {
        font-weight: 600;
        font-size: 1.125rem;
        color: var(--crm-text);
    }
    .card-subtitle {
        color: var(--crm-text-muted);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .card-badges {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        align-items: flex-end;
    }
    .parent-banner {
        background: var(--crm-banner-bg);
        border: 1px solid var(--crm-banner-border);
        border-radius: 0.75rem;
        padding: 0.5rem 0.75rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
    }
    .parent-banner-label {
        color: var(--crm-banner-label);
        font-weight: 500;
    }
    .parent-banner-name {
        color: var(--crm-banner-name);
        font-weight: 700;
    }
    .card-body {
        margin-bottom: 1.5rem;
    }
    .card-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        border-bottom: 1px dashed var(--crm-divider-dashed);
        padding-bottom: 0.25rem;
    }
    .card-row:last-child {
        border-bottom: none;
    }
    .card-label {
        color: var(--crm-text-muted);
        font-weight: 500;
    }
    .card-value {
        color: var(--crm-text);
        font-weight: 600;
        text-align: right;
    }
    .card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        border-top: 1px solid var(--crm-divider-dashed);
        padding-top: 1rem;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--crm-text-muted);
        font-size: 0.875rem;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
        background: var(--crm-panel-bg);
    }
    .parent-select-row {
        display: flex;
        gap: 0.5rem;
        align-items: flex-end;
    }
    .parent-select-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }
    .error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: block;
    }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg);
        color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-secondary:hover {
        background: var(--crm-btn-secondary-hover);
    }
    .actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }
    .btn-icon {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--crm-text-muted);
        transition: color 0.2s;
        font-weight: 600;
    }
    .btn-icon:hover {
        color: var(--crm-tab-active-text);
    }
    .divider {
        border: none;
        border-top: 1px solid var(--crm-divider);
        margin: 1rem 0;
    }
    /* Category Tabs */
    .category-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .cat-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        border: 2px solid transparent;
        background: var(--crm-tab-bg);
        color: var(--crm-tab-text);
        transition: all 0.2s ease;
        backdrop-filter: blur(6px);
        box-shadow: 0 1px 3px var(--crm-tab-shadow);
    }
    .cat-tab:hover {
        background: var(--crm-tab-hover-bg);
        color: var(--crm-tab-hover-text);
        transform: translateY(-1px);
    }
    .cat-tab.active {
        background: var(--crm-tab-active-bg);
        border-color: var(--crm-tab-active-border);
        color: var(--crm-tab-active-text);
        box-shadow: 0 4px 12px var(--crm-tab-active-shadow);
    }
    .cat-tab .count-pill {
        background: var(--crm-pill-bg);
        color: var(--crm-pill-text);
        font-size: 0.7rem;
        padding: 0.1rem 0.45rem;
        border-radius: 9999px;
        font-weight: 700;
    }
    .cat-tab.active .count-pill {
        background: var(--crm-pill-active-bg);
        color: var(--crm-pill-active-text);
    }
    .stage-sub-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 1.25rem;
        padding: 0.6rem 0.8rem;
        background: rgba(99,102,241,0.05);
        border-radius: 0.75rem;
        border: 1px solid rgba(99,102,241,0.1);
    }
    .stage-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.9rem;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        border: none;
        background: var(--crm-tab-bg);
        color: var(--crm-tab-text);
        transition: all 0.2s ease;
    }
    .stage-chip:hover {
        background: var(--crm-tab-hover-bg);
        color: var(--crm-tab-hover-text);
    }
    .stage-chip.active {
        background: #6366f1;
        color: white;
        box-shadow: 0 2px 8px rgba(99,102,241,0.3);
    }
</style>

    <div class="header">
        <h1>Leads Pipeline</h1>
        <div class="header-actions">
            <div class="toggle-group">
                <button wire:click="$set('viewMode', 'list')" class="toggle-btn {{ $viewMode === 'list' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    List
                </button>
                <button wire:click="$set('viewMode', 'cards')" class="toggle-btn {{ $viewMode === 'cards' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Cards
                </button>
            </div>
            <a href="{{ route('leads.create') }}" wire:navigate class="btn-primary">+ Add New Lead</a>
        </div>
    </div>

    {{-- Category Filter Tabs --}}
    @php
        $categories = $allowedCategories ?? ['All', 'Parent', 'Student', 'Employee', 'Supplier', 'Partner', 'Owner'];
        $catIcons = ['All' => '👥', 'Parent' => '🏠', 'Student' => '🎒', 'Employee' => '💼', 'Supplier' => '📦', 'Partner' => '🤝', 'Owner' => '👑'];
    @endphp
    <div class="category-tabs">
        @foreach($categories as $cat)
        <button
            wire:click="$set('filterCategory', '{{ $cat }}')"
            class="cat-tab {{ $filterCategory === $cat ? 'active' : '' }}"
        >
            {{ $catIcons[$cat] }} {{ $cat }}
            @if($cat === 'All')
                <span class="count-pill">{{ $totalCount }}</span>
            @elseif(isset($categoryCounts[$cat]))
                <span class="count-pill">{{ $categoryCounts[$cat] }}</span>
            @endif
        </button>
        @endforeach
    </div>

    <div x-show="$wire.filterCategory === 'Student'"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2">
    <div class="stage-sub-bar">
        <button wire:click="$set('filterStage', '')" class="stage-chip {{ $filterStage === '' ? 'active' : '' }}">
            All Stages
        </button>
        @foreach($this->allStages as $stage)
        <button wire:click="$set('filterStage', '{{ $stage->id }}')" class="stage-chip {{ $filterStage == $stage->id ? 'active' : '' }}">
            {{ $stage->name }}
        </button>
        @endforeach
    </div>
    </div>

    @if($viewMode === 'list')
    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Name (En/Ar)</th>
                    <th style="width: 1%;">Relation</th>
                    <th>Category</th>
                    <th>Religion</th>
                    <th>Gender</th>
                    <th>Grade</th>
                    <th>Age at 1st Oct</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr>
                    <td style="width: 20%; word-break: break-word;">
                        <div style="font-weight: 600; color: var(--crm-text);">{{ $lead->nameEn }}</div>
                        <div style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ $lead->nameAr }}</div>
                        @if($lead->status === 'Accepted')
                        <div style="color: #059669; font-size: 0.75rem; margin-top: 0.25rem; font-weight: 600;">✓ Accepted</div>
                        @endif
                    </td>
                    <td>
                        @if(in_array('Student', $lead->categories ?? []))
                            @if($lead->parent)
                            <div style="font-size: 0.8rem; color: #d97706;">👨 {{ $lead->parent->nameEn }}</div>
                            @endif
                            @if($lead->mother)
                            <div style="font-size: 0.8rem; color: #8b5cf6; margin-top: 0.15rem;">👩 {{ $lead->mother->nameEn }}</div>
                            @endif
                            @if(!$lead->parent && !$lead->mother)
                            <div style="color: var(--crm-text-muted); font-size: 0.8rem;">—</div>
                            @endif
                        @elseif(in_array('Parent', $lead->categories ?? []) && $lead->children->count())
                            @foreach($lead->children as $child)
                            <div style="font-size: 0.8rem; color: var(--crm-text);">🎒 {{ $child->nameEn }}</div>
                            @endforeach
                        @else
                            <div>{{ $lead->email ?? 'N/A' }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ $lead->phone ?? 'N/A' }}</div>
                        @endif
                    </td>
                    <td>
                        @foreach($lead->categories ?? [] as $cat)
                            <span class="badge {{ $cat === 'Student' ? 'badge-student' : ($cat === 'Parent' ? 'badge-parent' : '') }}" style="display: inline-block; margin: 0.1rem;">
                                {{ $cat }}
                            </span>
                        @endforeach
                    </td>
                    <td>{{ $lead->religion ?? '—' }}</td>
                    <td>{{ $lead->gender ?? '—' }}</td>
                    <td>
                        @if(in_array('Student', $lead->categories ?? []) && $lead->grade)
                            <span style="font-size: 0.875rem;">{{ $lead->grade->name }}</span>
                        @else
                            <span style="color: var(--crm-text-muted); font-size: 0.75rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if(in_array('Student', $lead->categories ?? []) && $lead->birth_date)
                            <div style="font-size: 0.875rem;">{{ \App\Models\Student::formatAgeAtOctober($lead->birth_date->format('Y-m-d')) }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.75rem;">Age at 1st October</div>
                        @else
                            <span style="color: var(--crm-text-muted); font-size: 0.75rem;">—</span>
                        @endif
                    </td>
                    <td><span class="badge">{{ $lead->status }}</span></td>
                    <td>
                        @if($lead->status === 'Accepted')
                        <span style="color: #059669; font-weight: 600; font-size: 0.8rem;">✔ Transferred</span>
                        @else
                        <a href="{{ route('leads.edit', $lead) }}" wire:navigate class="btn-icon">Edit</a>
                        <button wire:click="accept({{ $lead->id }})" wire:confirm="Accept this lead and copy to contacts?" class="btn-icon" style="color: #10b981; margin-left: 0.5rem;">Accept</button>
                        <button wire:click="delete({{ $lead->id }})" wire:confirm="Are you sure you want to delete this lead?" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">Delete</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 2rem; color: var(--crm-text-muted);">No leads found. Start by adding one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 1rem;">
            {{ $leads->links() }}
        </div>
    </div>
    @else
    <div class="cards-grid">
        @forelse($leads as $lead)
        <div class="card {{ in_array('Student', $lead->categories ?? []) && $lead->parent ? 'has-parent' : '' }}">
            <div class="card-header">
                <div>
                    <div class="card-title">
                        {{ $lead->nameEn }}
                        @if($lead->status === 'Accepted')
                        <span style="font-size: 0.7rem; background: #059669; color: white; padding: 0.15rem 0.5rem; border-radius: 9999px; vertical-align: middle; margin-left: 0.4rem;">Accepted</span>
                        @endif
                    </div>
                    <div class="card-subtitle">{{ $lead->nameAr }}</div>
                </div>
                <div class="card-badges">
                    @foreach($lead->categories ?? [] as $cat)
                        <span class="badge {{ $cat === 'Student' ? 'badge-student' : ($cat === 'Parent' ? 'badge-parent' : '') }}" style="display: inline-block;">
                            {{ $cat }}
                        </span>
                    @endforeach
                    <span class="badge">{{ $lead->status }}</span>
                </div>
            </div>

            <div class="card-body">
                <div class="card-row">
                    <span class="card-label">Relation</span>
                    <span class="card-value" style="text-align: right;">
                        @if(in_array('Student', $lead->categories ?? []))
                            @if($lead->parent)<div style="color: #d97706;">👨 {{ $lead->parent->nameEn }}</div>@endif
                            @if($lead->mother)<div style="color: #8b5cf6;">👩 {{ $lead->mother->nameEn }}</div>@endif
                            @if(!$lead->parent && !$lead->mother)<span style="color: var(--crm-text-muted);">—</span>@endif
                        @elseif(in_array('Parent', $lead->categories ?? []) && $lead->children->count())
                            @foreach($lead->children as $child)
                            <div>🎒 {{ $child->nameEn }}</div>
                            @endforeach
                        @else
                            <div>{{ $lead->email ?? 'N/A' }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ $lead->phone ?? 'N/A' }}</div>
                        @endif
                    </span>
                </div>
                <div class="card-row">
                    <span class="card-label">Grade</span>
                    <span class="card-value">{{ in_array('Student', $lead->categories ?? []) && $lead->grade ? $lead->grade->name : '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Religion</span>
                    <span class="card-value">{{ $lead->religion ?? '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Gender</span>
                    <span class="card-value">{{ $lead->gender ?? '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Birthday</span>
                    <span class="card-value">{{ $lead->birth_date ? $lead->birth_date->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Age at 1st Oct</span>
                    <span class="card-value">
                        @if(in_array('Student', $lead->categories ?? []) && $lead->birth_date)
                            {{ \App\Models\Student::formatAgeAtOctober($lead->birth_date->format('Y-m-d')) }}
                        @else
                            N/A
                        @endif
                    </span>
                </div>
                @if(in_array('Parent', $lead->categories ?? []) && $lead->children->count() > 1)
                <div class="card-row">
                    <span class="card-label">Children Count</span>
                    <span class="card-value">{{ $lead->children->count() }}</span>
                </div>
                @endif
            </div>
            <div class="card-actions">
                @if($lead->status === 'Accepted')
                <span style="color: #059669; font-weight: 600; font-size: 0.85rem;">✔ Transferred to Contacts</span>
                @else
                <a href="{{ route('leads.edit', $lead) }}" wire:navigate class="btn-icon">Edit</a>
                <button wire:click="accept({{ $lead->id }})" wire:confirm="Accept this lead and copy to contacts?" class="btn-icon" style="color: #10b981;">Accept</button>
                <button wire:click="delete({{ $lead->id }})" wire:confirm="Are you sure you want to delete this lead?" class="btn-icon" style="color: #ef4444;">Delete</button>
                @endif
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--crm-text-muted); background: var(--crm-empty-bg); border-radius: 1rem;">
            No leads found. Start by adding one!
        </div>
        @endforelse
    </div>
    <div style="margin-top: 1rem;">
        {{ $leads->links() }}
    </div>
    @endif
</div>
