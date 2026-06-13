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
        --crm-table-head: #4b5563;
        --crm-toggle-bg: rgba(255,255,255,0.5);
        --crm-toggle-shadow: rgba(0,0,0,0.05);
        --crm-card-bg: rgba(255,255,255,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.1);
        --crm-tab-active-bg: white;
        --crm-tab-active-text: #4f46e5;
        --crm-divider-dashed: rgba(0,0,0,0.05);
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
        --crm-table-head: #94a3b8;
        --crm-toggle-bg: rgba(255,255,255,0.06);
        --crm-toggle-shadow: rgba(0,0,0,0.2);
        --crm-card-bg: rgba(30,41,59,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.4);
        --crm-tab-active-bg: #1e293b;
        --crm-tab-active-text: #a5b4fc;
        --crm-divider-dashed: rgba(255,255,255,0.05);
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
    .btn-secondary {
        background: var(--crm-btn-secondary-bg, #f3f4f6);
        color: var(--crm-btn-secondary-text, #374151);
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-secondary:hover {
        background: var(--crm-btn-secondary-hover, #e5e7eb);
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
    }
    td {
        color: var(--crm-text);
        font-size: 0.875rem;
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
    .btn-icon {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--crm-text-muted);
        transition: color 0.2s;
        font-weight: 600;
    }
    .btn-icon:hover {
        color: var(--crm-input-focus-border, #4f46e5);
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
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        background: var(--crm-panel-bg);
    }
    .error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.75rem;
        display: block;
    }
    .actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 0.75rem;
    }
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--crm-badge-indigo-bg, #e0e7ff);
        color: var(--crm-badge-indigo-text, #4338ca);
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--crm-text-muted);
    }
    .empty-state p {
        margin: 0.5rem 0;
    }
        .order-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            background: var(--crm-input-bg);
            color: var(--crm-text);
            font-weight: 700;
            font-size: 0.875rem;
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
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px -5px var(--crm-card-hover-shadow);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
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

    <div class="header">
        <h1>{{ __('grades.page_title') }}</h1>
        <div style="display: flex; align-items: center;">
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
            <a href="{{ route('grades.create') }}" wire:navigate class="btn-primary">{{ __('grades.add_new') }}</a>
        </div>
    </div>

    <div style="display: flex; gap: 0.5rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
        <button wire:click="filterByStage('')" class="toggle-btn {{ $selectedStageId === '' ? 'active' : '' }}" style="background: var(--crm-toggle-bg); border: none; padding: 0.3rem 0.75rem; border-radius: 9999px; font-weight: 600; color: var(--crm-text-muted); cursor: pointer; font-size: 0.6rem; transition: all 0.2s;">
            {{ __('general.all') }}
        </button>
        @foreach($this->allStages as $stage)
        <button wire:click="filterByStage({{ $stage->id }})" class="toggle-btn {{ $selectedStageId == $stage->id ? 'active' : '' }}" style="background: var(--crm-toggle-bg); border: none; padding: 0.3rem 0.75rem; border-radius: 9999px; font-weight: 600; color: var(--crm-text-muted); cursor: pointer; font-size: 0.6rem; transition: all 0.2s;">
            🗂️ {{ $stage->name }}
        </button>
        @endforeach
    </div>

    @if($viewMode === 'list')
    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th>{{ __('grades.level_order') }}</th>
                    <th>{{ __('general.name_en') }}</th>
                    <th>{{ __('general.name_ar') }}</th>
                    <th>Description</th>
                    <th>{{ __('sections.page_title') }}</th>
                    <th>{{ __('subjects.page_title') }}</th>
                    <th>{{ __('general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stages as $stage)
                <tr style="background: rgba(99,102,241,0.06);">
                    <td colspan="7" style="font-weight: 700; font-size: 0.9rem; color: #4f46e5; padding: 0.75rem 1rem;">
                        🗂️ {{ $stage->name }} <span style="font-weight: 400; color: var(--crm-text-muted); font-size: 0.8rem;">({{ $stage->name_ar }})</span>
                    </td>
                </tr>
                @foreach($stage->grades as $grade)
                <tr>
                    <td><span class="order-badge">{{ $grade->level_order }}</span></td>
                    <td style="font-weight: 600;">{{ $grade->name }}</td>
                    <td>{{ $grade->name_ar }}</td>
                    <td>{{ $grade->description ?? __('general.no_data') }}</td>
                    <td>
                        <span class="badge">{{ $grade->sections_count }}</span>
                    </td>
                    <td>
                        <span class="badge">{{ $grade->subjects_count }}</span>
                    </td>
                    <td>
                        <a href="{{ route('grades.edit', $grade) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="delete({{ $grade->id }})" wire:confirm="{{ __('grades.delete_confirm') }}" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">{{ __('general.delete') }}</button>
                    </td>
                </tr>
                @endforeach
                @endforeach

                @if($unassigned->count())
                <tr style="background: rgba(107,114,128,0.06);">
                    <td colspan="7" style="font-weight: 700; font-size: 0.9rem; color: var(--crm-text-muted); padding: 0.75rem 1rem;">
                        📋 Unassigned
                    </td>
                </tr>
                @foreach($unassigned as $grade)
                <tr>
                    <td><span class="order-badge">{{ $grade->level_order }}</span></td>
                    <td style="font-weight: 600;">{{ $grade->name }}</td>
                    <td>{{ $grade->name_ar }}</td>
                    <td>{{ $grade->description ?? __('general.no_data') }}</td>
                    <td>
                        <span class="badge">{{ $grade->sections_count }}</span>
                    </td>
                    <td>
                        <span class="badge">{{ $grade->subjects_count }}</span>
                    </td>
                    <td>
                        <a href="{{ route('grades.edit', $grade) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="delete({{ $grade->id }})" wire:confirm="{{ __('grades.delete_confirm') }}" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">{{ __('general.delete') }}</button>
                    </td>
                </tr>
                @endforeach
                @endif

                @if(!$stages->count() && !$unassigned->count())
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>{{ __('grades.no_grades') }}</p>
                        <p style="font-size: 0.875rem;">Create your first grade to get started.</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @else
    <div>
        @forelse($stages as $stage)
        <div style="margin-bottom: 0.75rem;">
            <div style="font-weight: 700; font-size: 1.1rem; color: #4f46e5; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                🗂️ {{ $stage->name }}
                <span style="font-weight: 400; color: var(--crm-text-muted); font-size: 0.85rem;">({{ $stage->name_ar }})</span>
            </div>
            <div class="cards-grid" style="margin-top: 0;">
                @foreach($stage->grades as $grade)
                <div class="card">
                    <div class="card-header">
                        <div>
                            <span class="order-badge" style="margin-bottom: 0.75rem; display: inline-flex;">{{ $grade->level_order }}</span>
                            <div class="card-title" style="margin-top: 0.75rem;">{{ $grade->name }}</div>
                            <div class="card-subtitle">{{ $grade->name_ar }}</div>
                        </div>
                        <span class="badge">{{ $grade->sections_count }} {{ __('sections.page_title') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="card-row">
                            <span class="card-label">Description</span>
                            <span class="card-value">{{ $grade->description ?? __('general.no_data') }}</span>
                        </div>
                        <div class="card-row">
                            <span class="card-label">{{ __('subjects.page_title') }}</span>
                            <span class="card-value"><span class="badge">{{ $grade->subjects_count }}</span></span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('grades.edit', $grade) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="delete({{ $grade->id }})" wire:confirm="{{ __('grades.delete_confirm') }}" class="btn-icon" style="color: #ef4444;">{{ __('general.delete') }}</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        @if($unassigned->count())
        <div style="margin-bottom: 0.75rem;">
            <div style="font-weight: 700; font-size: 1.1rem; color: var(--crm-text-muted); margin-bottom: 0.75rem;">
                📋 Unassigned
            </div>
            <div class="cards-grid" style="margin-top: 0;">
                @foreach($unassigned as $grade)
                <div class="card">
                    <div class="card-header">
                        <div>
                            <span class="order-badge" style="margin-bottom: 0.75rem; display: inline-flex;">{{ $grade->level_order }}</span>
                            <div class="card-title" style="margin-top: 0.75rem;">{{ $grade->name }}</div>
                            <div class="card-subtitle">{{ $grade->name_ar }}</div>
                        </div>
                        <span class="badge">{{ $grade->sections_count }} {{ __('sections.page_title') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="card-row">
                            <span class="card-label">Description</span>
                            <span class="card-value">{{ $grade->description ?? __('general.no_data') }}</span>
                        </div>
                        <div class="card-row">
                            <span class="card-label">{{ __('subjects.page_title') }}</span>
                            <span class="card-value"><span class="badge">{{ $grade->subjects_count }}</span></span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('grades.edit', $grade) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="delete({{ $grade->id }})" wire:confirm="{{ __('grades.delete_confirm') }}" class="btn-icon" style="color: #ef4444;">{{ __('general.delete') }}</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(!$stages->count() && !$unassigned->count())
        <div style="text-align: center; padding: 2rem; color: var(--crm-text-muted); background: var(--crm-empty-bg, rgba(255,255,255,0.7)); border-radius: 1rem;">
            {{ __('grades.no_grades') }}
        </div>
        @endif
    </div>
    @endif
</div>
