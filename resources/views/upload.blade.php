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
    <h3 align="center">Pokerhands</h3><br/>
    <form action="/hands/upload" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <div class="alert alert-success success-block">
            <strong>Welcome {{ Auth::user()->email }}</strong>
            <br/>
            <a href="{{ url('/logout') }}">Logout</a>
        </div>
        <div>
            <label>
                Upload the hands file:
                <input type="file" name="file"/>
            </label>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>

<br/>
</div>
</body>
</html>
