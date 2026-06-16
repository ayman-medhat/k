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
        padding: 0.75rem 2rem;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        height: 2.25rem;
    }
    .header h1 {
        font-size: 1.2rem;
        color: var(--crm-text);
        margin: 0;
        font-weight: 700;
        letter-spacing: -0.5px;
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
        height: 2.25rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
        font-size: 0.875rem;
    }
    .toggle-btn.active {
        background: var(--crm-tab-active-bg);
        color: var(--crm-tab-active-text);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
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
        background: var(--crm-btn-success-bg);
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
        padding: 0.75rem 2rem;
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
        text-align: center;
    }
    td {
        color: var(--crm-text);
        font-size: 0.875rem;
        text-align: center;
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
    .card-photo {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    .card-photo-placeholder {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        background: var(--crm-btn-secondary-bg);
        color: var(--crm-text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.125rem;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }
    [dir="rtl"] .card-photo,
    [dir="rtl"] .card-photo-placeholder {
        margin-right: 0;
        margin-left: 0.75rem;
    }
    .card-title {
        font-weight: 600;
        font-size: 1.125rem;
        color: var(--crm-text);
    }
    .card-subtitle {
        color: var(--crm-text-muted);
        font-size: 0.875rem;
        margin-top: 0.75rem;
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
        margin-bottom: 0.75rem;
    }
    .card-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
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
        margin-bottom: 0.75rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.75rem;
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
        margin-top: 0.75rem;
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
        margin-top: 0.75rem;
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
        margin-bottom: 0.75rem;
    }
    .cat-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        padding: 0.4rem 0.8rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.65rem;
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
        border-radius: 0.25rem;
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

    @if($message)
    <div style="background: #059669; color: white; padding: 0.75rem 1rem; border-radius: 0.75rem; margin-bottom: 0.75rem; font-weight: 600;">
        {{ $message }}
    </div>
    @endif

    <div class="header">
        <h1>{{ __('contacts.page_title') }}</h1>
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="{{ __('general.search_name_placeholder') }}"
            class="search-box"
            style="max-width: 500px; flex: 1; min-width: 150px;"
        />
        <div class="header-actions">
            <div class="toggle-group">
                <button wire:click="$set('viewMode', 'list')" class="toggle-btn {{ $viewMode === 'list' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    {{ __('general.list') }}
                </button>
                <button wire:click="$set('viewMode', 'cards')" class="toggle-btn {{ $viewMode === 'cards' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    {{ __('general.cards') }}
                </button>
            </div>
            @if(!($isGuest ?? false))
            <a href="{{ route('contacts.import') }}" wire:navigate class="btn-secondary" style="margin-right: 0.5rem;">{{ __('general.import') }}</a>
            <button wire:click="translateAllNames" class="btn-secondary" style="margin-right: 0.5rem;">{{ __('general.translate_all') }}</button>
            <a href="{{ route('contacts.export') }}" class="btn-secondary" style="margin-right: 0.5rem;">{{ __('general.export') }}</a>
            <a href="{{ route('contacts.create') }}" wire:navigate class="btn-primary">{{ __('contacts.add_new') }}</a>
            @endif
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
            {{ $catIcons[$cat] }} {{ __($cat === 'All' ? 'general.all' : 'general.' . strtolower($cat)) }}
            @if($cat === 'All')
                <span class="count-pill">{{ $totalCount }}</span>
            @elseif(isset($categoryCounts[$cat]))
                <span class="count-pill">{{ $categoryCounts[$cat] }}</span>
            @endif
        </button>
        @endforeach
    </div>

    <div class="stage-sub-bar" style="flex-wrap: wrap; gap: 0.75rem;">
        <div x-show="$wire.filterCategory === 'Student'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
            <button wire:click="$set('filterStage', '')" class="stage-chip {{ $filterStage === '' ? 'active' : '' }}">
                {{ __('general.all') }} {{ __('general.stages') }}
            </button>
            @foreach($this->allStages as $stage)
            <button wire:click="$set('filterStage', '{{ $stage->id }}')" class="stage-chip {{ $filterStage == $stage->id ? 'active' : '' }}">
                {{ $stage->name }}
            </button>
            @endforeach
        </div>
    </div>

    @if($viewMode === 'list')
    @if(!($isGuest ?? false) && count($selectedContacts) > 0)
    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 0.75rem; background: rgba(99,102,241,0.08); border-radius: 0.75rem; border: 1px solid rgba(99,102,241,0.15);">
        <span style="font-size: 0.85rem; font-weight: 600; color: var(--crm-tab-active-text);">{{ count($selectedContacts) }} {{ __('general.selected') }}</span>
        <button wire:click="bulkRestore" wire:confirm="Restore {{ count($selectedContacts) }} selected contact(s) to leads?" class="btn-success" style="font-size: 0.75rem; padding: 0.4rem 0.9rem;">{{ __('general.restore_selected') }}</button>
        <button wire:click="$set('selectedContacts', [])" class="btn-icon" style="font-size: 0.8rem; color: var(--crm-text-muted);">{{ __('general.clear_selection') }}</button>
    </div>
    @endif
    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    @if(!($isGuest ?? false))
                    <th style="width: 1%;"><input type="checkbox" wire:model.live="selectAll" style="cursor: pointer;"></th>
                    @endif
                    <th style="width: 20%;">{{ __('general.name_en_ar') }}</th>
                    <th style="width: 1%;">{{ __('general.relation') }}</th>
                    <th>{{ __('general.category') }}</th>
                    <th>{{ __('general.religion') }}</th>
                    <th>{{ __('general.gender') }}</th>
                    <th>{{ __('general.grade') }}</th>
                    <th>{{ __('general.age_at_oct_short') }}</th>
                    <th>{{ __('general.status') }}</th>
                    @if(!($isGuest ?? false))
                    <th>{{ __('general.actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    @if(!($isGuest ?? false))
                    <td><input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}" wire:model.live="selectedContacts" style="cursor: pointer;"></td>
                    @endif
            <td style="width: 20%; word-break: break-word; text-align: left;">
                <div style="font-weight: 600; color: var(--crm-text);">
                    {{ app()->getLocale() === 'ar' ? $contact->nameAr : $contact->nameEn }}
                </div>
                <div style="color: var(--crm-text-muted); font-size: 0.75rem;">
                    {{ app()->getLocale() === 'ar' ? $contact->nameEn : $contact->nameAr }}
                </div>
            </td>
                    <td>
                        @if(in_array('Student', $contact->categories ?? []))
                            @if($contact->parent)
                            <div style="font-size: 0.8rem; color: #d97706;">👨 {{ app()->getLocale() === 'ar' ? $contact->parent->nameAr : $contact->parent->nameEn }}</div>
                            @endif
                            @if($contact->mother)
                            <div style="font-size: 0.8rem; color: #8b5cf6; margin-top: 0.75rem;">👩 {{ app()->getLocale() === 'ar' ? $contact->mother->nameAr : $contact->mother->nameEn }}</div>
                            @endif
                            @if(!$contact->parent && !$contact->mother)
                            <div style="color: var(--crm-text-muted); font-size: 0.8rem;">{{ __('general.no_data') }}</div>
                            @endif
                        @elseif(in_array('Parent', $contact->categories ?? []))
                            @if($contact->children->count())
                                @foreach($contact->children as $child)
                                <div style="font-size: 0.8rem; color: var(--crm-text);">🎒 {{ app()->getLocale() === 'ar' ? $child->nameAr : $child->nameEn }}</div>
                                @endforeach
                            @else
                                <div style="color: var(--crm-text-muted); font-size: 0.8rem;">{{ __('general.no_children') }}</div>
                            @endif
                        @else
                            <div>{{ $contact->email ?? __('general.na') }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ $contact->phone ?? __('general.na') }}</div>
                        @endif
                    </td>
                    <td>
                        @foreach($contact->categories ?? [] as $cat)
                            <span class="badge {{ $cat === 'Student' ? 'badge-student' : ($cat === 'Parent' ? 'badge-parent' : '') }}" style="display: inline-block; margin: 0.1rem;">
                                {{ __("general." . strtolower($cat)) }}
                            </span>
                        @endforeach
                    </td>
                    <td>{{ app()->getLocale() === 'ar' ? ($contact->religion_ar ?? __('general.' . strtolower($contact->religion))) : $contact->religion }}</td>
                    <td>{{ app()->getLocale() === 'ar' ? ($contact->gender_ar ?? __('general.' . strtolower($contact->gender))) : $contact->gender }}</td>
                    <td>
                        @if(in_array('Student', $contact->categories ?? []) && $contact->student && $contact->student->grade)
                            <span style="font-size: 0.875rem;">{{ $contact->student->grade->name }}</span>
                        @else
                            <span style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ __('general.no_data') }}</span>
                        @endif
                    </td>
                    <td>
                        @if(in_array('Student', $contact->categories ?? []) && $contact->birth_date)
                            <div style="font-size: 0.875rem;">{{ \App\Models\Student::formatAgeAtOctober($contact->birth_date->format('Y-m-d')) }}</div>
                        @else
                            <span style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ __('general.no_data') }}</span>
                        @endif
                    </td>
                    <td><span class="badge">{{ app()->getLocale() === 'ar' ? ($contact->status_ar ?? __('general.' . strtolower($contact->status))) : $contact->status }}</span></td>
                    <td>
                        @if(!($isGuest ?? false))
                        <a href="{{ route('contacts.edit', $contact) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="restore({{ $contact->id }})" wire:confirm="{{ __('contacts.restore_confirm') }}" class="btn-icon" style="color: #3b82f6; margin-left: 0.5rem;">{{ __('contacts.restore') }}</button>
                        <button wire:click="delete({{ $contact->id }})" wire:confirm="{{ __('contacts.delete_confirm') }}" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">{{ __('general.delete') }}</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" style="text-align: center; padding: 2rem; color: var(--crm-text-muted);">{{ __('contacts.no_contacts') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 0.75rem;">
            {{ $contacts->links() }}
        </div>
    </div>
    @else
    @if(!($isGuest ?? false) && count($selectedContacts) > 0)
    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; margin-bottom: 0.75rem; background: rgba(99,102,241,0.08); border-radius: 0.75rem; border: 1px solid rgba(99,102,241,0.15);">
        <span style="font-size: 0.85rem; font-weight: 600; color: var(--crm-tab-active-text);">{{ count($selectedContacts) }} {{ __('general.selected') }}</span>
        <button wire:click="bulkRestore" wire:confirm="Restore {{ count($selectedContacts) }} selected contact(s) to leads?" class="btn-success" style="font-size: 0.75rem; padding: 0.4rem 0.9rem;">{{ __('general.restore_selected') }}</button>
        <button wire:click="$set('selectedContacts', [])" class="btn-icon" style="font-size: 0.8rem; color: var(--crm-text-muted);">{{ __('general.clear_selection') }}</button>
    </div>
    @endif
    <div class="cards-grid">
        @forelse($contacts as $contact)
        <div class="card {{ in_array('Student', $contact->categories ?? []) && $contact->parent ? 'has-parent' : '' }}">
            <div class="card-header">
                @php $photo = $contact->photo ?? $contact->student?->photo; @endphp
                @if($photo)
                    <img src="{{ asset('storage/' . $photo) }}" alt="" class="card-photo">
                @else
                    <div class="card-photo card-photo-placeholder">{{ strtoupper(substr(app()->getLocale() === 'ar' ? $contact->nameAr : $contact->nameEn, 0, 1)) }}</div>
                @endif
                <div>
                    <div class="card-title">{{ app()->getLocale() === 'ar' ? $contact->nameAr : $contact->nameEn }}</div>
                    <div class="card-subtitle">{{ app()->getLocale() === 'ar' ? $contact->nameEn : $contact->nameAr }}</div>
                </div>
                <div class="card-badges">
                    @foreach($contact->categories ?? [] as $cat)
                        <span class="badge {{ $cat === 'Student' ? 'badge-student' : ($cat === 'Parent' ? 'badge-parent' : '') }}" style="display: inline-block;">
                            {{ __("general." . strtolower($cat)) }}
                        </span>
                    @endforeach
                    <span class="badge">{{ app()->getLocale() === 'ar' ? ($contact->status_ar ?? __('general.' . strtolower($contact->status))) : $contact->status }}</span>
                </div>
            </div>

            <div class="card-body">
                <div class="card-row">
                    <span class="card-label">{{ __('general.relation') }}</span>
                    <span class="card-value" style="text-align: right;">
                        @if(in_array('Student', $contact->categories ?? []))
                            @if($contact->parent)<div style="color: #d97706;">👨 {{ app()->getLocale() === 'ar' ? $contact->parent->nameAr : $contact->parent->nameEn }}</div>@endif
                            @if($contact->mother)<div style="color: #8b5cf6;">👩 {{ app()->getLocale() === 'ar' ? $contact->mother->nameAr : $contact->mother->nameEn }}</div>@endif
                            @if(!$contact->parent && !$contact->mother)<span style="color: var(--crm-text-muted);">{{ __('general.no_data') }}</span>@endif
                        @elseif(in_array('Parent', $contact->categories ?? []))
                            @if($contact->children->count())
                                @foreach($contact->children as $child)
                                <div>🎒 {{ app()->getLocale() === 'ar' ? $child->nameAr : $child->nameEn }}</div>
                                @endforeach
                            @else
                                <span style="color: var(--crm-text-muted);">{{ __('general.no_children') }}</span>
                            @endif
                        @else
                            <div>{{ $contact->email ?? __('general.na') }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.75rem;">{{ $contact->phone ?? __('general.na') }}</div>
                        @endif
                    </span>
                </div>
                <div class="card-row">
                    <span class="card-label">{{ __('general.grade') }}</span>
                    <span class="card-value">{{ in_array('Student', $contact->categories ?? []) && $contact->student && $contact->student->grade ? $contact->student->grade->name : __('general.no_data') }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">{{ __('general.religion') }}</span>
                    <span class="card-value">{{ app()->getLocale() === 'ar' ? ($contact->religion_ar ?? __('general.' . strtolower($contact->religion))) : $contact->religion }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">{{ __('general.gender') }}</span>
                    <span class="card-value">{{ app()->getLocale() === 'ar' ? ($contact->gender_ar ?? __('general.' . strtolower($contact->gender))) : $contact->gender }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">{{ __('general.birthday') }}</span>
                    <span class="card-value">{{ $contact->birth_date ? $contact->birth_date->format('M d, Y') : __('general.na') }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">{{ __('general.age_at_oct_short') }}</span>
                    <span class="card-value">
                        @if(in_array('Student', $contact->categories ?? []) && $contact->birth_date)
                            {{ \App\Models\Student::formatAgeAtOctober($contact->birth_date->format('Y-m-d')) }}
                        @else
                            {{ __('general.na') }}
                        @endif
                    </span>
                </div>
                @if(in_array('Parent', $contact->categories ?? []) && $contact->children->count() > 1)
                <div class="card-row">
                    <span class="card-label">{{ __('general.children_count') }}</span>
                    <span class="card-value">{{ $contact->children->count() }}</span>
                </div>
                @endif
                @if($contact->documents->count())
                <div class="card-row" style="flex-wrap: wrap;">
                    <span class="card-label" style="width: 100%; margin-bottom: 0.25rem;">{{ __('general.official_documents') }}</span>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                        @foreach($contact->documents as $doc)
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" title="{{ $doc->notes ?? $doc->file_name }}" style="font-size: 1.2rem; text-decoration: none;">
                                @if(str_contains($doc->file_type, 'pdf')) 📄 @else 🖼️ @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="card-actions">
                @if(!($isGuest ?? false))
                <a href="{{ route('contacts.edit', $contact) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                <button wire:click="restore({{ $contact->id }})" wire:confirm="{{ __('contacts.restore_confirm') }}" class="btn-icon" style="color: #3b82f6;">{{ __('contacts.restore') }}</button>
                <button wire:click="delete({{ $contact->id }})" wire:confirm="{{ __('contacts.delete_confirm') }}" class="btn-icon" style="color: #ef4444;">{{ __('general.delete') }}</button>
                @endif
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--crm-text-muted); background: var(--crm-empty-bg); border-radius: 1rem;">
            {{ __('contacts.no_contacts') }}
        </div>
        @endforelse
    </div>
    <div style="margin-top: 0.75rem;">
        {{ $contacts->links() }}
    </div>
    @endif
</div>
