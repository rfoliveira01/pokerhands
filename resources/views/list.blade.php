<!DOCTYPE html>
<html>
<head>
    <title>Pokerhands</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<br/>
<div class="container box">
    <div class="alert alert-success success-block">
        <strong>Welcome {{ Auth::user()->email }}</strong>
        <br/>
        <a href="/hands/form" class="btn btn-primary"> click here to upload a file</a>
        <a  class="btn btn-danger pull-right" href="{{ url('/logout') }}">Logout</a>
    </div>
    @if(count($list) > 0)
        <div>
            Player 1 has won {{$total[1]}} times
        </div>
        <div>
            Player 2 has won {{$total[2]}} times
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Player 1 Hand (result)</th>
                <th>Player 2 Hand (result)</th>
                <th>Who won?</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $round)
                <tr>
                    <td>
                        {{ $round[1]['hand'] . " (" . $round[1]['score'] . ")" }}
                    </td>
                    <td>
                        {{ $round[2]['hand']. " (" . $round[2]['score'] . ")"  }}
                    </td>
                    <td>
                        {{ $round['winner'] }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

<br/>
</div>
</body>
</html>
