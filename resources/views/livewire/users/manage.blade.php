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
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.2);
        --crm-table-head: #4b5563;
        --crm-card-bg: rgba(255,255,255,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.1);
        --crm-badge-indigo-bg: #e0e7ff;
        --crm-badge-indigo-text: #4338ca;
        --crm-btn-secondary-bg: #f3f4f6;
        --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151;
        --crm-divider: #e5e7eb;
        --crm-divider-dashed: rgba(0,0,0,0.05);
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
    }
    .dark {
        --crm-bg-from: #0f172a; --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9; --crm-text-muted: #94a3b8;
        --crm-border: rgba(255,255,255,0.05);
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b; --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-table-head: #94a3b8;
        --crm-card-bg: rgba(30,41,59,0.7);
        --crm-card-hover-shadow: rgba(0,0,0,0.4);
        --crm-badge-indigo-bg: #312e81; --crm-badge-indigo-text: #a5b4fc;
        --crm-btn-secondary-bg: #334155; --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0; --crm-divider: #334155;
        --crm-divider-dashed: rgba(255,255,255,0.05);
        --crm-tab-bg: rgba(30,41,59,0.6);
        --crm-tab-hover-bg: rgba(30,41,59,0.9);
        --crm-tab-text: #94a3b8;
        --crm-tab-hover-text: #818cf8;
        --crm-tab-active-bg: rgba(30,41,59,0.9);
        --crm-tab-active-text: #818cf8;
        --crm-tab-active-border: #6366f1;
        --crm-tab-shadow: rgba(0,0,0,0.2);
        --crm-tab-active-shadow: rgba(99,102,241,0.3);
        --crm-pill-bg: #312e81; --crm-pill-text: #a5b4fc;
        --crm-pill-active-bg: #6366f1; --crm-pill-active-text: white;
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
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
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .role-admin { background: #e0e7ff; color: #4338ca; }
    .role-hr { background: #dbeafe; color: #1d4ed8; }
    .role-student_affairs { background: #fef3c7; color: #b45309; }
    .role-academic { background: #dcfce7; color: #15803d; }
    .role-parent { background: #e0e7ff; color: #4338ca; }
    .role-student { background: #fce7f3; color: #be185d; }
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
        gap: 0.75rem;
        align-items: center;
    }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease; text-decoration: none; display: inline-block;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-danger {
        background: none; border: none; color: #ef4444;
        cursor: pointer; font-size: 0.85rem; font-weight: 500;
        padding: 0.3rem 0.6rem; border-radius: 0.5rem;
        transition: all 0.15s;
    }
    .btn-danger:hover { background: rgba(239,68,68,0.1); }
    .email-text { color: var(--crm-text-muted); font-size: 0.8rem; }
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
        <h1>{{ __('users.page_title') }}</h1>
        <div class="header-actions">
            <a href="{{ route('users.create') }}" wire:navigate class="btn-primary">{{ __('users.add_new') }}</a>
        </div>
    </div>

    @if(session('error'))
    <div style="padding: 1rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 0.75rem; color: #ef4444; margin-bottom: 0.75rem; font-weight: 500;">
        {{ session('error') }}
    </div>
    @endif

    @if(session()->has('message'))
    <div style="padding: 1rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 0.75rem; color: #059669; margin-bottom: 0.75rem; font-weight: 500;">
        {{ session('message') }}
    </div>
    @endif

    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th>{{ __('users.name') }}</th>
                    <th>{{ __('users.email') }}</th>
                    <th>{{ __('users.role') }}</th>
                    <th>Created</th>
                    <th>{{ __('general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td style="font-weight: 600;">
                        {{ $u->name }}
                        @if($u->id === auth()->id())
                            <span style="font-size: 0.7rem; color: var(--crm-text-muted); margin-left: 0.35rem;">(you)</span>
                        @endif
                    </td>
                    <td><span class="email-text">{{ $u->email }}</span></td>
                    <td>
                        <span class="role-badge role-{{ $u->role }}">
                            {{ str_replace('_', ' ', $u->role) }}
                        </span>
                    </td>
                    <td style="font-size: 0.8rem; color: var(--crm-text-muted);">{{ $u->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $u) }}" wire:navigate class="btn-primary" style="padding: 0.3rem 0.8rem; font-size: 0.8rem; box-shadow: none;">{{ __('general.edit') }}</a>
                        @if($u->id !== auth()->id())
                        <button wire:click="delete({{ $u->id }})" wire:confirm="{{ __('users.delete_confirm') }}" class="btn-danger">{{ __('general.delete') }}</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 3rem; color: var(--crm-text-muted);">{{ __('users.no_users') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div style="margin-top: 0.75rem;">
        {{ $users->links() }}
    </div>
    @endif
</div>
