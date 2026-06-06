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
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 2rem;
    }
    .header {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;
    }
    .header h1 {
        font-size: 2.5rem; color: var(--crm-text); margin: 0;
        font-weight: 800; letter-spacing: -1px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(99,102,241,0.4); }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) { .glass-panel { padding: 1rem; } }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 0.5rem 0.75rem; text-align: left; border-bottom: 1px solid var(--crm-divider-dashed); }
    @media (max-width: 640px) { th, td { padding: 0.35rem 0.5rem; } }
    th {
        font-weight: 600; color: var(--crm-table-head);
        text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;
    }
    td { color: var(--crm-text); font-size: 0.875rem; }
    .btn-icon {
        background: none; border: none; cursor: pointer;
        color: var(--crm-text-muted); transition: color 0.2s; font-weight: 600;
    }
    .btn-icon:hover { color: var(--crm-input-focus-border, #4f46e5); }
    .badge {
        display: inline-block; padding: 0.25rem 0.75rem;
        border-radius: 9999px; font-size: 0.75rem; font-weight: 600;
        background: var(--crm-badge-indigo-bg, #e0e7ff);
        color: var(--crm-badge-indigo-text, #4338ca);
    }
    .empty-state { text-align: center; padding: 3rem; color: var(--crm-text-muted); }
    .empty-state p { margin: 0.5rem 0; }
    .search-box {
        padding: 0.5rem 1rem; border-radius: 9999px; border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        font-size: 0.875rem; outline: none; width: 240px;
    }
    .search-box:focus {
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
    }
</style>

    <div class="header">
        <h1>Students</h1>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search students..." class="search-box">
            @if(!$isControl)
            <a href="{{ route('students.create') }}" wire:navigate class="btn-primary">+ Add Student</a>
            @endif
        </div>
    </div>

    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Class</th>
                    <th>Gov. Code</th>
                    <th>Seat No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td style="font-weight: 600;">
                        <a href="{{ route('students.edit', $student) }}" wire:navigate style="color: var(--crm-text); text-decoration: none;">
                            {{ $student->contact?->nameEn ?? 'N/A' }}
                        </a>
                    </td>
                    <td>{{ $student->grade?->name ?? 'N/A' }}</td>
                    <td>{{ $student->section?->name ?? '—' }}</td>
                    <td>{{ $student->government_code ?? '—' }}</td>
                    <td>{{ $student->seat_no ?? '—' }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student) }}" wire:navigate class="btn-icon">Edit</a>
                        @if(!$isControl)
                        <button wire:click="delete({{ $student->id }})" wire:confirm="Delete this student record?" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">Delete</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <p>No students found.</p>
                        <p style="font-size: 0.875rem;">Create a contact with Student category first, then add their academic info here.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($students->hasPages())
    <div style="margin-top: 1rem;">
        {{ $students->links() }}
    </div>
    @endif
</div>
