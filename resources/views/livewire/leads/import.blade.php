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
        --crm-btn-secondary-bg: #f3f4f6;
        --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151;
        --crm-divider: #e5e7eb;
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
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-btn-secondary-bg: #334155;
        --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0;
        --crm-divider: #334155;
        --crm-divider-dashed: rgba(255,255,255,0.05);
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; height: 2.25rem; }
    .header h1 { font-size: 1.2rem; color: var(--crm-text); margin: 0; font-weight: 700; letter-spacing: -0.5px; }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
    }
    @media (max-width: 640px) { .glass-panel { padding: 1rem; } }
    .drop-zone {
        border: 2px dashed var(--crm-input-border);
        border-radius: 1rem; padding: 3rem 2rem;
        text-align: center; cursor: pointer;
        transition: all 0.2s ease;
        background: var(--crm-input-bg);
    }
    .drop-zone:hover, .drop-zone.dragover {
        border-color: var(--crm-input-focus-border);
        background: var(--crm-panel-bg);
    }
    .drop-zone.has-file {
        border-color: #10b981;
        background: rgba(16,185,129,0.05);
    }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
    .btn-secondary {
        background: var(--crm-btn-secondary-bg);
        color: var(--crm-btn-secondary-text);
        padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-secondary:hover { background: var(--crm-btn-secondary-hover); }
    .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem; margin-bottom: 0.75rem; }
    .stat-card {
        background: var(--crm-panel-bg);
        border-radius: 0.75rem; padding: 1rem;
        text-align: center;
        border: 1px solid var(--crm-panel-border);
    }
    .stat-value { font-size: 1.5rem; font-weight: 800; color: var(--crm-text); }
    .stat-label { font-size: 0.75rem; color: var(--crm-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.75rem; }
    .stat-card.success .stat-value { color: #10b981; }
    .stat-card.warning .stat-value { color: #f59e0b; }
    .stat-card.danger .stat-value { color: #ef4444; }
    .error-list { margin-top: 0.75rem; }
    .error-item {
        padding: 0.5rem 0.75rem; border-radius: 0.5rem;
        font-size: 0.8rem; color: #ef4444;
        background: rgba(239,68,68,0.1);
        margin-bottom: 0.75rem;
    }
    .file-info { display: flex; align-items: center; gap: 0.75rem; margin-top: 0.75rem; }
    .hint { font-size: 0.8rem; color: var(--crm-text-muted); margin-top: 0.75rem; }
    .hint code { background: var(--crm-btn-secondary-bg); padding: 0.15rem 0.4rem; border-radius: 0.25rem; font-size: 0.75rem; }
    .spinner { animation: spin 1s linear infinite; width: 1.25rem; height: 1.25rem; border: 2px solid var(--crm-text-muted); border-top-color: transparent; border-radius: 50%; display: inline-block; vertical-align: middle; }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

    <div class="header">
        <h1>{{ __('leads.import_title') }}</h1>
        <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">{{ __('leads.back_to_leads') }}</a>
    </div>

    <div class="glass-panel" style="max-width: 42rem; margin: 0 auto;">
        @if($results)
            <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--crm-text); margin-bottom: 0.75rem;">{{ __('leads.import_complete') }}</h2>

            <div class="stat-grid">
                <div class="stat-card success">
                    <div class="stat-value">{{ $results['imported'] }}</div>
                    <div class="stat-label">{{ __('leads.imported') }}</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-value">{{ $results['updated'] }}</div>
                    <div class="stat-label">{{ __('leads.updated') }}</div>
                </div>
                <div class="stat-card {{ $results['skipped'] > 0 ? 'warning' : 'success' }}">
                    <div class="stat-value">{{ $results['skipped'] }}</div>
                    <div class="stat-label">{{ __('leads.skipped') }}</div>
                </div>
            </div>

            @if(count($results['errors']) > 0)
                <div class="error-list">
                    <h3 style="font-size: 0.9rem; font-weight: 600; color: #ef4444; margin-bottom: 0.75rem;">{{ __('leads.errors') }} ({{ count($results['errors']) }})</h3>
                    @foreach($results['errors'] as $error)
                        <div class="error-item">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div style="margin-top: 0.75rem; display: flex; gap: 0.75rem;">
                <button wire:click="$set('results', null)" class="btn-primary">{{ __('leads.import_another') }}</button>
                <a href="{{ route('leads') }}" wire:navigate class="btn-secondary">{{ __('leads.view_leads') }}</a>
            </div>
        @else
            <form wire:submit="import">
                <div class="drop-zone {{ $file ? 'has-file' : '' }}"
                     x-data="{ dragging: false }"
                     x-on:dragover.prevent="dragging = true"
                     x-on:dragleave.prevent="dragging = false"
                     x-on:drop.prevent="dragging = false; $wire.upload('file', $event.dataTransfer.files[0])"
                     :class="{ 'dragover': dragging }"
                     @click="$refs.fileInput.click()">
                    <div style="font-size: 3rem; color: var(--crm-text-muted); margin-bottom: 0.75rem;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto;"><path d="M12 16V4m0 0L8 8m4-4l4 4"/><path d="M20 16v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2"/></svg>
                    </div>
                    @if($file)
                        <div style="font-weight: 600; color: var(--crm-text);">{{ $file->getClientOriginalName() }}</div>
                        <div style="font-size: 0.8rem; color: var(--crm-text-muted);">{{ number_format($file->getSize() / 1024, 1) }} KB</div>
                    @else
                        <div style="font-weight: 600; color: var(--crm-text);">{{ __('leads.drop_file') }}</div>
                        <div style="font-size: 0.8rem; color: var(--crm-text-muted); margin-top: 0.75rem;">{{ __('leads.file_support') }}</div>
                    @endif
                    <input x-ref="fileInput" type="file" wire:model="file" accept=".xlsx,.xls,.csv" style="display: none;">
                </div>

                @error('file') <div style="color: #ef4444; font-size: 0.8rem; margin-top: 0.75rem;">{{ $message }}</div> @enderror

                <div class="hint">
                    <strong>{{ __('leads.expected_columns') }}</strong>
                    <code>nameEn</code> <code>nameAr</code> <code>email</code> <code>phone</code>
                    <code>national_id</code> <code>categories</code> <code>grade_id</code>
                    — <a href="{{ route('leads.import.template') }}" style="color: var(--crm-input-focus-border);">{{ __('leads.download_template') }}</a>
                </div>

                <div style="margin-top: 0.75rem; text-align: right;">
                    <button type="submit" class="btn-primary" wire:loading.attr="disabled" wire:target="file">
                        <span wire:loading.remove wire:target="import">{{ __('leads.import_title') }}</span>
                        <span wire:loading wire:target="import"><span class="spinner"></span> {{ __('leads.importing') }}</span>
                    </button>
                </div>
            </form>
        @endif
    </div>

    @if($showDuplicateModal)
    <div class="modal-overlay" wire:ignore.self x-data x-init="$el.style.display='flex'">
        <div class="modal-box" style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border); padding: 2rem; max-width: 500px; width: 100%; margin: 2rem auto; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--crm-text); margin: 0 0 0.5rem;">{{ __('leads.duplicate_records') }}</h3>
            <p style="color: var(--crm-text-muted); font-size: 0.9rem; margin-bottom: 0.75rem;">
                {{ count($duplicates) }} {{ __('leads.records_exist') }}
            </p>
            <div style="max-height: 200px; overflow-y: auto; margin-bottom: 0.75rem; border: 1px solid var(--crm-divider); border-radius: 0.5rem; padding: 0.5rem;">
                @foreach($duplicates as $dup)
                <div style="display: flex; justify-content: space-between; padding: 0.35rem 0; border-bottom: 1px solid var(--crm-divider-dashed); font-size: 0.85rem; color: var(--crm-text);">
                    <span>{{ $dup['existing']['nameEn'] ?? __('general.na') }}</span>
                    <span style="color: var(--crm-text-muted);">{{ __('leads.id') }} {{ $dup['existing']['national_id'] ?? __('general.na') }}</span>
                </div>
                @endforeach
            </div>
            <p style="color: var(--crm-text-muted); font-size: 0.85rem; margin-bottom: 0.75rem;">{{ __('general.what_to_do') }}</p>
            <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                <button wire:click="cancelImport" class="btn-secondary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">{{ __('leads.cancel_import') }}</button>
                <button wire:click="confirmImport('skip')" class="btn-primary" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 4px 6px -1px rgba(245,158,11,0.4); padding: 0.6rem 1.2rem; font-size: 0.85rem;">{{ __('leads.skip_duplicates') }}</button>
                <button wire:click="confirmImport('update')" class="btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">{{ __('general.update_existing') }}</button>
            </div>
        </div>
    </div>
    <style>
        .modal-overlay {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            align-items: center; justify-content: center; padding: 1rem;
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
    @endif
</div>
