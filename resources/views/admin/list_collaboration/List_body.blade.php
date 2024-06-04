<h2>{{ $data->c_name }}</h2>
<p>Focal Person: {{ $data->c_focal_person }}<span class="space-me">({{ $data->s_email }})</span></p>

@if($data->duration_left > 360)
    @php
        $duration = intval($data->duration_left / 360);
    @endphp
    <p>Duration: {{ $duration }} years</p>

@elseif($data->duration_left > 30)
    @php
        $duration = intval($data->duration_left / 30);
    @endphp
    <p>Duration: {{ $duration }} months</p>

@else($data->duration_left > 0)
    <p>Duration: {{ $data->duration_left }} days</p>

@endif