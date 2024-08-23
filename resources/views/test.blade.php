<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test View</title>

    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .text-quest{
            text-align: left;
        }

        button {
            display: block;
            width: 10%;
            padding: 10px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-submit {
            margin: 1% auto;
            margin-top: 10px;
            align-items: center;
            align-self: center;
        }

        .btn-open {
            margin: 0 auto;
        }

        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            margin-top: 2%;
            /* 15% from the top and centered */
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            /* Could be more or less depending on screen size */
            max-width: 900px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
            align-content: end;
            margin: 0;
        }

        /* Loading spinner styles */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            /* Semi-transparent white background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            display: none;
            /* Hidden by default */
        }

        .spinner {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #007bff;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            /* Blue background for header */
            color: #fff;
            /* White text color for header */
        }

        td {
            background-color: #fafafa;
            /* Light gray background for cells */
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
            /* Slightly darker gray for even rows */
        }

        .question-cell {
            width: 50%;
            text-align: center;
        }

        .options-cell {
            padding: 0;
        }

        .options-cell input[type="radio"] {
            margin: 0 5px;
        }
    </style>

</head>

<body>
    <h1>Test Questions</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Strongly Disagree <br> 1</th>
                <th>Disagree <br>2</th>
                <th>Neutral <br>3</th>
                <th>Agree <br>4</th>
                <th>Strongly Agree br 5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $index => $question)
            <tr>
                <td class="text-quest">{{ $question->text }}</td>
                <td><input type="radio" name="answers[{{ $index }}][answer_value]" value="1" required></td>
                <td><input type="radio" name="answers[{{ $index }}][answer_value]" value="2" required></td>
                <td><input type="radio" name="answers[{{ $index }}][answer_value]" value="3" required></td>
                <td><input type="radio" name="answers[{{ $index }}][answer_value]" value="4" required></td>
                <td><input type="radio" name="answers[{{ $index }}][answer_value]" value="5" required></td>
                <input type="hidden" name="answers[{{ $index }}][question_id]" value="{{ $question->id }}">
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>