<div class="crm-container">
<style>
    :root {
        --crm-bg-from: #f3f4f6; --crm-bg-to: #e5e7eb;
        --crm-text: #1f2937; --crm-text-muted: #6b7280;
        --crm-panel-bg: rgba(255,255,255,0.7);
        --crm-panel-border: rgba(255,255,255,0.5);
        --crm-panel-shadow: rgba(0,0,0,0.05);
        --crm-input-bg: #f9fafb; --crm-input-border: #d1d5db;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.2);
        --crm-btn-secondary-bg: #f3f4f6; --crm-btn-secondary-hover: #e5e7eb;
        --crm-btn-secondary-text: #374151; --crm-divider: #e5e7eb;
    }
    .dark {
        --crm-bg-from: #0f172a; --crm-bg-to: #1e293b;
        --crm-text: #f1f5f9; --crm-text-muted: #94a3b8;
        --crm-panel-bg: rgba(30,41,59,0.7);
        --crm-panel-border: rgba(255,255,255,0.1);
        --crm-panel-shadow: rgba(0,0,0,0.3);
        --crm-input-bg: #1e293b; --crm-input-border: #475569;
        --crm-input-focus-border: #6366f1; --crm-input-focus-ring: rgba(99,102,241,0.3);
        --crm-btn-secondary-bg: #334155; --crm-btn-secondary-hover: #475569;
        --crm-btn-secondary-text: #e2e8f0; --crm-divider: #334155;
    }
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh; padding: 0.75rem 2rem;
    }
    .header {
        margin-bottom: 0.75rem;
        height: 2.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header h1 {
        font-size: 1.2rem; color: var(--crm-text);
        margin: 0; font-weight: 700; letter-spacing: -0.5px;
    }
    .form-card {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        border-radius: 1rem; border: 1px solid var(--crm-panel-border);
        padding: 0.75rem 2rem; box-shadow: 0 20px 25px -5px var(--crm-panel-shadow);
        max-width: 900px; margin: 0 auto;
    }
    .form-group { margin-bottom: 0.75rem; }
    .form-group label {
        display: block; margin-bottom: 0.75rem;
        font-weight: 500; color: var(--crm-text-muted); font-size: 0.875rem;
    }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%; padding: 0.75rem; border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border);
        background: var(--crm-input-bg); color: var(--crm-text);
        transition: all 0.2s; box-sizing: border-box;
        font-family: inherit;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        outline: none; border-color: var(--crm-input-focus-border);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring);
        background: var(--crm-panel-bg);
    }
    .form-group textarea { min-height: 80px; resize: vertical; }
    .error { color: #ef4444; font-size: 0.75rem; margin-top: 0.75rem; display: block; }
    .btn-primary {
        background: var(--crm-btn-primary-bg);
        color: white; padding: 0.75rem 1.5rem; border-radius: 9999px;
        font-weight: 600; border: none; cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(99,102,241,0.4);
        transition: all 0.2s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    .divider { border: none; border-top: 1px solid var(--crm-divider); margin: 1.5rem 0; }
    .section-title {
        font-weight: 700; font-size: 1rem; color: var(--crm-text);
        margin-bottom: 0.75rem; margin-top: 0.75rem;
    }
    .flash {
        background: #059669; color: white; padding: 0.75rem 1rem;
        border-radius: 0.5rem; margin-bottom: 0.75rem;
        font-weight: 600; font-size: 0.875rem;
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
        <h1>{{ __('schools.page_title') }}</h1>
    </div>

    @if(session('message'))
    <div class="flash">{{ session('message') }}</div>
    @endif

    <div class="form-card">
        <form wire:submit.prevent="save">
            <div class="section-title">🏫 School Name</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('general.name_en') }}</label>
                    <input type="text" wire:model.blur="nameEn" placeholder="International School of ...">
                    @error('nameEn') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('general.name_ar') }}</label>
                    <input type="text" wire:model.blur="nameAr" placeholder="المدرسة ..." dir="rtl">
                    @error('nameAr') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="divider">
            <div class="section-title">📍 Contact & Address</div>
            <div class="form-group">
                <label>{{ __('schools.address') }}</label>
                <input type="text" wire:model.blur="address" placeholder="Full address">
                @error('address') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="grid-3">
                <div class="form-group">
                    <label>{{ __('schools.phone') }}</label>
                    <input type="text" wire:model.blur="phone" placeholder="+20 ...">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('schools.email') }}</label>
                    <input type="email" wire:model.blur="email" placeholder="info@school.com">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('schools.website') }}</label>
                    <input type="url" wire:model.blur="website" placeholder="https://...">
                    @error('website') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="divider">
            <div class="section-title">👤 Administration</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('schools.principal') }}</label>
                    <input type="text" wire:model.blur="principal_name" placeholder="Dr. ...">
                    @error('principal_name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Established Year</label>
                    <input type="number" wire:model.blur="established_year" min="1900" max="2099" placeholder="2000">
                    @error('established_year') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('schools.logo') }}</label>
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <input type="text" wire:model.blur="logo" placeholder="/storage/school-logos/..." style="flex: 1;" readonly>
                    <label for="logoUpload" style="background: var(--crm-btn-primary-bg); color: white; padding: 0.6rem 1.25rem; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: pointer; white-space: nowrap; transition: opacity 0.2s; box-shadow: 0 2px 4px rgba(99,102,241,0.3);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">Browse</label>
                    <input type="file" id="logoUpload" wire:model="logoFile" accept="image/jpg,image/jpeg,image/png,image/webp,image/gif" style="display: none;">
                </div>
                @if($logoFile)
                <div style="margin-top: 0.75rem; font-size: 0.8rem; color: #059669;">✓ {{ $logoFile->getClientOriginalName() }} {{ __('general.selected') }}</div>
                @endif
                @error('logoFile') <span class="error">{{ $message }}</span> @enderror
                @error('logo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <hr class="divider">
            <div class="section-title">{{ __('welcome.mission_vision') }}</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>{{ __('welcome.our_mission') }}</label>
                    <textarea wire:model.blur="mission" placeholder="Our mission is..."></textarea>
                    @error('mission') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('welcome.our_vision') }}</label>
                    <textarea wire:model.blur="vision" placeholder="Our vision is..."></textarea>
                    @error('vision') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="divider">
            <div class="section-title">🌐 Social Media</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="url" wire:model.blur="social_facebook" placeholder="https://facebook.com/...">
                    @error('social_facebook') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Twitter / X</label>
                    <input type="url" wire:model.blur="social_twitter" placeholder="https://twitter.com/...">
                    @error('social_twitter') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="url" wire:model.blur="social_instagram" placeholder="https://instagram.com/...">
                    @error('social_instagram') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>LinkedIn</label>
                    <input type="url" wire:model.blur="social_linkedin" placeholder="https://linkedin.com/...">
                    @error('social_linkedin') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 0.75rem;">
                <button type="submit" class="btn-primary">{{ __('schools.save') }}</button>
            </div>
        </form>
    </div>
</div>
