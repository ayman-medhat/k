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
        --crm-tree-line: #d1d5db;
        --crm-branch-bg: rgba(0,0,0,0.02);
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
        --crm-tree-line: #475569;
        --crm-branch-bg: rgba(255,255,255,0.02);
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
        padding: 2rem;
        box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        overflow-x: auto;
    }
    @media (max-width: 640px) {
        .glass-panel { padding: 1rem; }
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
        margin-bottom: 1.25rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--crm-text-muted);
        font-size: 0.875rem;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg);
        color: var(--crm-text);
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        background: var(--crm-panel-bg);
    }
    .error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: block;
    }
    .actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--crm-text-muted);
    }
    .empty-state p {
        margin: 0.5rem 0;
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

    /* Tree styles */
    .tree-root {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .tree-root li {
        list-style: none;
    }
    .tree-node {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--crm-border);
    }
    .tree-node.root-node {
        background: var(--crm-branch-bg);
        font-weight: 600;
    }
    .tree-node.root-node:last-child {
        border-bottom: 1px solid var(--crm-border);
    }
    .tree-node.branch-node {
        padding-left: 4.5rem;
        position: relative;
    }
    .tree-node.branch-node::before {
        content: '└─';
        position: absolute;
        left: 2.5rem;
        color: var(--crm-tree-line);
        font-size: 1rem;
    }
    .tree-node .node-info {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .tree-node .node-actions {
        white-space: nowrap;
        flex-shrink: 0;
    }
    .branch-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 0.25rem;
        background: var(--crm-input-bg);
        color: var(--crm-text-muted);
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
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

    /* Cards grid */
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
    .branch-list {
        margin-top: 1rem;
        padding-top: 0.75rem;
        border-top: 1px dashed var(--crm-divider-dashed);
    }
    .branch-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.4rem 0.75rem;
        margin-bottom: 0.25rem;
        border-radius: 0.5rem;
        background: var(--crm-branch-bg);
        font-size: 0.85rem;
    }
    .branch-item .branch-name {
        color: var(--crm-text);
        font-weight: 500;
    }
    .branch-item .branch-ar {
        color: var(--crm-text-muted);
        font-size: 0.8rem;
        margin-left: 0.5rem;
    }
</style>

    <div class="header">
        <h1>Subjects</h1>
        <div style="display: flex; align-items: center;">
            <div class="toggle-group">
                <button wire:click="$set('viewMode', 'list')" class="toggle-btn {{ $viewMode === 'list' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Tree
                </button>
                <button wire:click="$set('viewMode', 'cards')" class="toggle-btn {{ $viewMode === 'cards' ? 'active' : '' }}">
                    <svg style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Cards
                </button>
            </div>
            <a href="{{ route('subjects.create') }}" wire:navigate class="btn-primary">+ Add Subject</a>
        </div>
    </div>

    @php
        $rootSubjects = $subjects->whereNull('parent_id');
    @endphp

    @if($viewMode === 'list')
    <div class="glass-panel">
        <ul class="tree-root">
            @forelse($rootSubjects as $root)
                <li>
                    <div class="tree-node root-node">
                        <div class="node-info">
                            @if($root->children->count())
                                <span class="branch-toggle">◉</span>
                            @else
                                <span class="branch-toggle" style="opacity: 0.3;">○</span>
                            @endif
                            <div>
                                <div style="font-weight: 700; color: var(--crm-text);">{{ $root->name }}</div>
                                <div style="font-size: 0.75rem; color: var(--crm-text-muted);">{{ $root->name_ar }}</div>
                            </div>
                            @if($root->is_religion_based)
                                <span class="badge-religion">Religion</span>
                            @elseif($root->is_main)
                                <span class="badge-main">Main</span>
                            @else
                                <span class="badge-optional">Optional</span>
                            @endif
                            @if($root->description)
                                <span style="font-size: 0.75rem; color: var(--crm-text-muted); font-style: italic;">{{ $root->description }}</span>
                            @endif
                        </div>
                        <div class="node-actions">
                            @if($root->children->count())
                                <span class="badge-" style="padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; background: #f3e8ff; color: #7c3aed; margin-right: 0.75rem;">{{ $root->children->count() }}</span>
                            @endif
                            <a href="{{ route('subjects.edit', $root) }}" wire:navigate class="btn-icon" style="font-size: 0.8rem;">Edit</a>
                            <button wire:click="delete({{ $root->id }})" wire:confirm="Delete this subject and all its branches?" class="btn-icon" style="color: #ef4444; font-size: 0.8rem;">Delete</button>
                        </div>
                    </div>
                    @if($root->children->count())
                        <ul class="tree-root">
                            @foreach($root->children as $child)
                            <li>
                                <div class="tree-node branch-node">
                                    <div class="node-info">
                                        <div>
                                            <div style="font-weight: 500; color: var(--crm-text);">{{ $child->name }}</div>
                                            <div style="font-size: 0.75rem; color: var(--crm-text-muted);">{{ $child->name_ar }}</div>
                                        </div>
                                        @if($child->religion)
                                            <span class="badge-religion">{{ $child->religion }}</span>
                                        @elseif($child->is_main)
                                            <span class="badge-main">Main</span>
                                        @else
                                            <span class="badge-optional">Optional</span>
                                        @endif
                                    </div>
                                    <div class="node-actions">
                                        <a href="{{ route('subjects.edit', $child) }}" wire:navigate class="btn-icon" style="font-size: 0.8rem;">Edit</a>
                                        <button wire:click="delete({{ $child->id }})" wire:confirm="Delete this branch?" class="btn-icon" style="color: #ef4444; font-size: 0.8rem;">Delete</button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @empty
                <li>
                    <div class="tree-node" style="justify-content: center; padding: 2rem; color: var(--crm-text-muted);">
                        No subjects defined yet.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
    @else
    <div class="cards-grid">
        @forelse($rootSubjects as $root)
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">{{ $root->name }}</div>
                    <div class="card-subtitle">{{ $root->name_ar }}</div>
                </div>
                @if($root->is_religion_based)
                    <span class="badge-religion">Religion</span>
                @elseif($root->is_main)
                    <span class="badge-main">Main</span>
                @else
                    <span class="badge-optional">Optional</span>
                @endif
            </div>
            <div class="card-body">
                <div class="card-row">
                    <span class="card-label">Description</span>
                    <span class="card-value">{{ $root->description ?? '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Religion</span>
                    <span class="card-value">{{ $root->religion ?? '—' }}</span>
                </div>
                @if($root->children->count())
                <div class="branch-list">
                    @foreach($root->children as $child)
                    <div class="branch-item">
                        <div>
                            <span class="branch-name">{{ $child->name }}</span>
                            <span class="branch-ar">{{ $child->name_ar }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            @if($child->religion)
                                <span class="badge-religion">{{ $child->religion }}</span>
                            @elseif($child->is_main)
                                <span class="badge-main">Main</span>
                            @else
                                <span class="badge-optional">Opt</span>
                            @endif
                            <a href="{{ route('subjects.edit', $child) }}" wire:navigate class="btn-icon" style="font-size: 0.75rem;">Edit</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="card-actions">
                <a href="{{ route('subjects.edit', $root) }}" wire:navigate class="btn-icon">Edit</a>
                <button wire:click="delete({{ $root->id }})" wire:confirm="Delete this subject and all its branches?" class="btn-icon" style="color: #ef4444;">Delete</button>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--crm-text-muted); background: var(--crm-empty-bg, rgba(255,255,255,0.7)); border-radius: 1rem;">
            No subjects defined yet.
        </div>
        @endforelse
    </div>
    @endif
</div>
