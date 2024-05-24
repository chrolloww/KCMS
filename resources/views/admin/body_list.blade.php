<!DOCTYPE html>
<html>
<head>
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            width: 300px;
            background-color: #fff;
        }
        .card-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .card-content {
            font-size: 1em;
            margin-bottom: 10px;
        }
        .card-footer {
            text-align: right;
        }
    </style>
</head>
<body>
    @foreach ($datas as $data)
        <div class="card">
            <div class="card-title">{{ $data->s_name }}</div>
            <div class="card-content">
                Position: {{ $data->c_name }}<br>
                Email: {{ $data->s_phone_number }}
            </div>
            
        </div>
    @endforeach
</body>
</html>
