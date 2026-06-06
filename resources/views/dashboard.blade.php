<x-app-layout>
    <div class="crm-container" style="font-family: 'Inter', system-ui, sans-serif; background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%); min-height: calc(100vh - 4rem); padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2.5rem; color: var(--crm-text); margin: 0; font-weight: 800; letter-spacing: -1px;">Dashboard</h1>
        </div>

        <div class="max-w-7xl mx-auto">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.5rem;">
                @foreach($stats as $stat)
                <a href="{{ route($stat['route']) }}" wire:navigate style="text-decoration: none;">
                    <div style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid var(--crm-panel-border); padding: 1.5rem; box-shadow: 0 10px 15px -3px var(--crm-panel-shadow); transition: transform 0.2s, box-shadow 0.2s; display: flex; align-items: center; gap: 1rem;"
                         onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 15px 25px -5px rgba(0,0,0,0.1)'"
                         onmouseout="this.style.transform='';this.style.boxShadow=''">
                        <div style="font-size: 2.5rem; line-height: 1;">{{ $stat['icon'] }}</div>
                        <div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--crm-text); line-height: 1.2;">{{ $stat['count'] }}</div>
                            <div style="color: var(--crm-text-muted); font-size: 0.875rem; font-weight: 500;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
