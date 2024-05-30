@if($data->duration_left > 360)
    @php
        $duration = intval($data->duration_left / 360);
    @endphp
    <td><strong>Duration Left:</strong><br>{{$duration}} year left</td>

    @elseif($data->duration_left > 30)
        @php
            $duration = intval($data->duration_left / 30);
        @endphp
    <td><strong>Duration Left:</strong><br>{{$duration}} month left</td>

    @elseif($data->duration_left > 0)
    <td><strong>Duration Left:</strong><br>{{$data -> duration_left}} days left</td>

@endif