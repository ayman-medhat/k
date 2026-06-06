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
            --crm-input-focus-ring: rgba(99,102,241,0.3);
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
            gap: 0.75rem;
            align-items: center;
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
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
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
        .form-modal {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
        }
        .form-content {
            background: var(--crm-panel-bg);
            border-radius: 1rem;
            padding: 2rem;
            width: 100%;
            max-width: 560px;
            box-shadow: 0 25px 50px -12px var(--crm-panel-shadow);
            animation: slideUp 0.3s ease-out;
            max-height: 90vh;
            overflow-y: auto;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: flex-end;
        }
        .filter-bar .form-group {
            margin-bottom: 0;
            min-width: 250px;
        }
        .section-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }
        .grade-name {
            font-weight: 600;
            color: var(--crm-input-focus-border, #4f46e5);
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
    </style>

    <div class="header">
        <h1>Classes</h1>
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
            <button wire:click="openGenerate" class="btn-success">+ Generate Classes</button>
            <a href="{{ route('sections.create') }}" wire:navigate class="btn-primary">+ Add Single</a>
        </div>
    </div>

    <div class="filter-bar">
        <div class="form-group">
            <label>Filter by Grade</label>
            <select wire:model.live="filterGradeId">
                <option value="">All Grades</option>
                @foreach($this->grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }} ({{ $grade->name_ar }})</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($viewMode === 'list')
    <div class="glass-panel">
        <table>
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Grade</th>
                    <th>Arabic</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                <tr>
                    <td><span class="section-badge">{{ $section->name }}</span></td>
                    <td><span class="grade-name">{{ $section->grade->name }}</span></td>
                    <td>{{ $section->name_ar }}</td>
                    <td>
                        <a href="{{ route('sections.edit', $section) }}" wire:navigate class="btn-icon">Edit</a>
                        <button wire:click="delete({{ $section->id }})" wire:confirm="Delete this class?" class="btn-icon" style="color: #ef4444; margin-left: 0.5rem;">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">
                        <p>No classes defined yet.</p>
                        <p style="font-size: 0.875rem;">Use "Generate Classes" to auto-create them for a grade.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @else
    <div class="cards-grid">
        @forelse($sections as $section)
        <div class="card">
            <div class="card-header">
                <div>
                    <span class="section-badge" style="margin-bottom: 0.5rem; display: inline-flex;">{{ $section->name }}</span>
                    <div class="card-title" style="margin-top: 0.5rem;">{{ $section->grade->name }}</div>
                    <div class="card-subtitle">{{ $section->name_ar }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-row">
                    <span class="card-label">Grade</span>
                    <span class="card-value grade-name">{{ $section->grade->name }}</span>
                </div>
            </div>
            <div class="card-actions">
                <button wire:click="edit({{ $section->id }})" class="btn-icon">Edit</button>
                <button wire:click="delete({{ $section->id }})" wire:confirm="Delete this class?" class="btn-icon" style="color: #ef4444;">Delete</button>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--crm-text-muted); background: var(--crm-empty-bg, rgba(255,255,255,0.7)); border-radius: 1rem;">
            No classes defined yet.
        </div>
        @endforelse
    </div>
    @endif

    {{-- BULK GENERATE FORM --}}
    @if($showGenerateForm)
    <div class="form-modal">
        <div class="form-content">
            <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 700; color: var(--crm-text);">
                Generate Classes
            </h2>

            <form wire:submit.prevent="generate">
                <div class="form-group">
                    <label>Grade</label>
                    <select wire:model="generateGradeId">
                        <option value="">-- Select Grade --</option>
                        @foreach($this->grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }} ({{ $grade->name_ar }})</option>
                        @endforeach
                    </select>
                    @error('generateGradeId') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Number of Classes</label>
                    <input type="number" wire:model="generateCount" min="1" max="26" placeholder="3">
                    @error('generateCount') <span class="error">{{ $message }}</span> @enderror
                    <small style="color: var(--crm-text-muted); font-size: 0.75rem;">Letters A–Z will be assigned automatically, skipping existing ones.</small>
                </div>

                <div class="actions">
                    <button type="button" wire:click="$set('showGenerateForm', false)" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-success">Generate</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
