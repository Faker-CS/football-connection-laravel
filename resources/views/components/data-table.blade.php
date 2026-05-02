@props(['headers' => [], 'empty' => 'Aucune donnée disponible'])
<div class="card">
    @if(isset($title))
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        @if(isset($action))
            {{ $action }}
        @endif
    </div>
    @endif
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
