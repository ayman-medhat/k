<div class="crm-container">
<style>
    :root {
        --crm-bg-from: #f3f4f6; --crm-bg-to: #e5e7eb;
        --crm-text: #1f2937; --crm-text-muted: #6b7280;
        --crm-border: rgba(0,0,0,0.05);
        --crm-panel-bg: rgba(255,255,255,0.7);
        --crm-panel-border: rgba(255,255,255,0.5);
        --crm-panel-shadow: rgba(0,0,0,0.05);
        --crm-input-bg: #f9fafb; --crm-input-border: #d1d5db;
        --crm-input-focus-border: #6366f1;
        --crm-table-head: #4b5563;
        --crm-btn-secondary-bg: #f3f4f6;
        --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151;
        --crm-divider-dashed: rgba(0,0,0,0.05);
        --crm-badge-green-bg: #d1fae5; --crm-badge-green-text: #065f46;
        --crm-badge-red-bg: #fee2e2; --crm-badge-red-text: #991b1b;
        --crm-badge-yellow-bg: #fef3c7; --crm-badge-yellow-text: #92400e;
        --crm-badge-blue-bg: #dbeafe; --crm-badge-blue-text: #1e40af;
    }
    .dark {
        --crm-bg-from: #0f172a; --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9; --crm-text-muted: #94a3b8;
        --crm-border: rgba(255,255,255,0.05);
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b; --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1;
        --crm-table-head: #94a3b8;
        --crm-btn-secondary-bg: #334155;
        --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0;
        --crm-divider-dashed: rgba(255,255,255,0.05);
        --crm-badge-green-bg: #064e3b; --crm-badge-green-text: #6ee7b7;
        --crm-badge-red-bg: #7f1d1d; --crm-badge-red-text: #fca5a5;
        --crm-badge-yellow-bg: #78350f; --crm-badge-yellow-text: #fcd34d;
        --crm-badge-blue-bg: #1e3a5f; --crm-badge-blue-text: #93c5fd;
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; height: 2.25rem; flex-wrap: wrap; gap: 0.5rem; }
    .header h1 { font-size: 1.2rem; color: var(--crm-text); margin: 0; font-weight: 700; letter-spacing: -0.5px; }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(99,102,241,0.4); }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg); color: var(--crm-btn-secondary-text);
        padding: 0.5rem 1rem; border-radius: 9999px; font-weight: 600;
        border: none; cursor: pointer; transition: all 0.2s ease;
        text-decoration: none; display: inline-block;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) { .glass-panel { padding: 1rem; } }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid var(--crm-divider-dashed); }
    @media (max-width: 640px) { th, td { padding: 0.35rem 0.5rem; } }
    th { }
    td { color: var(--crm-text); font-size: 0.875rem; }
    .badge {
        display: inline-block; padding: 0.25rem 0.75rem;
        border-radius: 9999px; font-size: 0.75rem; font-weight: 600;
        background: var(--crm-badge-indigo-bg, #e0e7ff); color: var(--crm-badge-indigo-text, #4338ca);
    }
    .badge-green { background: var(--crm-badge-green-bg); color: var(--crm-badge-green-text); }
    .badge-red { background: var(--crm-badge-red-bg); color: var(--crm-badge-red-text); }
    .badge-yellow { background: var(--crm-badge-yellow-bg); color: var(--crm-badge-yellow-text); }
    .badge-blue { background: var(--crm-badge-blue-bg); color: var(--crm-badge-blue-text); }
    .btn-icon {
        background: none; border: none; cursor: pointer;
        color: var(--crm-text-muted); transition: color 0.2s; font-weight: 600;
    }
    .btn-icon:hover { color: var(--crm-input-focus-border, #4f46e5); }
    .empty-state { text-align: center; padding: 3rem; color: var(--crm-text-muted); }
    .empty-state p { margin: 0.5rem 0; }
    .filter-select {
        padding: 0.5rem 1rem; border-radius: 9999px; border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.875rem; outline: none;
    }
    .filter-select:focus {
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
    }
    .filters { display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center; }
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
        <h1>{{ __('attendance.page_title') }}</h1>
        <div class="filters">
            <select wire:model.live="grade_id" class="filter-select">
                <option value="">{{ __('general.all') }}</option>
                @foreach($this->grades as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
            <select wire:model.live="section_id" class="filter-select">
                <option value="">{{ __('general.all') }}</option>
                @foreach($this->sections as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->name_ar }})</option>
                @endforeach
            </select>
            <select wire:model.live="status_filter" class="filter-select">
                <option value="">{{ __('general.all') }}</option>
                <option value="present">{{ __('attendance.present') }}</option>
                <option value="absent">{{ __('attendance.absent') }}</option>
                <option value="late">{{ __('attendance.late') }}</option>
                <option value="excused">{{ __('attendance.excused') }}</option>
            </select>
            <input type="date" wire:model.live="date_from" class="filter-select" placeholder="From" style="width: 150px;">
            <input type="date" wire:model.live="date_to" class="filter-select" placeholder="To" style="width: 150px;">
            <a href="{{ route('attendance.take') }}" wire:navigate class="btn-primary">{{ __('attendance.mark_attendance') }}</a>
        </div>
    </div>

    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th>{{ __('attendance.student') }}</th>
                    <th>{{ __('general.class') }}</th>
                    <th>{{ __('general.grade') }}</th>
                    <th>{{ __('attendance.date') }}</th>
                    <th>{{ __('general.status') }}</th>
                    <th>{{ __('general.notes') }}</th>
                    <th>{{ __('general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                <tr>
                    <td style="font-weight: 600;">{{ $record->student?->contact?->nameEn ?? __('general.na') }}</td>
                    <td>{{ $record->section?->name ?? __('general.na') }}</td>
                    <td>{{ $record->section?->grade?->name ?? __('general.na') }}</td>
                    <td>{{ $record->date->format('M d, Y') }}</td>
                    <td>
                        @php
                            $statusClass = match($record->status) {
                                'present' => 'badge-green',
                                'absent' => 'badge-red',
                                'late' => 'badge-yellow',
                                'excused' => 'badge-blue',
                                default => '',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ __("attendance.".$record->status) }}</span>
                    </td>
                    <td>{{ $record->notes ?? __('general.no_data') }}</td>
                    <td>
                        <a href="{{ route('attendance.take', ['section_id' => $record->section_id, 'date' => $record->date->format('Y-m-d')]) }}" wire:navigate class="btn-icon">{{ __('general.edit') }}</a>
                        <button wire:click="delete({{ $record->id }})" wire:confirm="{{ __('general.are_you_sure') }}" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">{{ __('general.delete') }}</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>{{ __('attendance.no_attendance') }}</p>
                        <p style="font-size: 0.875rem;">Take attendance for a class to get started.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($records->hasPages())
    <div style="margin-top: 0.75rem;">
        {{ $records->links() }}
    </div>
    @endif
</div>
