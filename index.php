<!DOCTYPE html>
<html>
<head>
    <title>App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .column {
            height: 100vh;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-4 column">
                <h4>Input</h4>
                <textarea id="inputText" class="form-control h-75"></textarea>
            </div>
            <div class="col-2 column">
                <div class="btn-container">
                    <button class="btn btn-primary" data-function="timestampToDatetime">Timestamp to Datetime</button>
                </div>
            </div>
            <div class="col-4 column">
                <h4>Output</h4>
                <textarea id="outputText" class="form-control h-75" readonly></textarea>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button').click(function() {
                var input = $('#inputText').val();
                var output = window[this.dataset.function](input);
                $('#outputText').val(output);
            });
        });

        function timestampToDatetime(input) {
            var lines = input.split('\n');
            var output = [];
            for (var i = 0; i < lines.length; i++) {
                var line = lines[i];
                var timestamp = line.match(/(\b\d{10}\b)/g); // 10 digit unix timestamp
                if (timestamp) {
                    var date = new Date(timestamp[0] * 1000);
                    var formattedDate = date.toISOString().slice(0,19).replace('T', ' ');
                    output.push(line.replace(timestamp[0], formattedDate));
                } else {
                    output.push(line); // line remains unchanged if no timestamp is found
                }
            }
            return output.join('\n');
        }
        
    </script>
</body>
</html>

