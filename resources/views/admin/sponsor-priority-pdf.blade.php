<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            text-align: left;
        }
        .table th, .table td {
            padding: 10px;
            vertical-align: middle;
        }
        .date-header {
            font-size: 18px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">Meeting Schedule</h2>

    @php
        $groupedMeetings = $priorities->groupBy(function($priority) {
            return \Carbon\Carbon::parse($priority->start_time)->format('d-M-Y (l)');
        });
    @endphp

  
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedMeetings as $date => $meetings)
                @foreach($meetings as $priority)
                    <tr>
                        <td> 
                            <span>{{ $date }}</span> <br>
                            {{ \Carbon\Carbon::parse($priority->start_time)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($priority->end_time)->format('h:i A') }}
                        </td>
                    
                        <td>
                            <strong>{{ $priority->delegate->name }}</strong> <br>
                            {{ $priority->delegate->job_title }} <br>
                            <span class="text-muted">({{ $priority->delegate->company_name }})</span>
                        </td>
                    </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
