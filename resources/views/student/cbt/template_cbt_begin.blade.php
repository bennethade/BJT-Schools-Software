<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Exam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4a90e2, #9013fe);
            padding: 20px;
            color: #fff;
            text-align: left;
        }
        .exam-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            margin: auto;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h2 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 20px;
        }
        .question {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .options label {
            display: block;
            background: #f4f4f4;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .options input[type="radio"] {
            margin-right: 10px;
        }
        .options label:hover {
            background: #dcdcdc;
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background: #357abd;
        }
    </style>
</head>
<body>

    <div class="exam-container">
        <h2>{{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</h2>
        <h3 style="text-align: center">Computer-Based Test</h3>

        <form action="#" method="POST">
            @csrf
            
            <div class="question">1. What is the capital of France?</div>
            <div class="options">
                <label><input type="radio" name="answers[1]" value="a"> (a) Berlin</label>
                <label><input type="radio" name="answers[1]" value="b"> (b) Madrid</label>
                <label><input type="radio" name="answers[1]" value="c"> (c) Rome</label>
                <label><input type="radio" name="answers[1]" value="d"> (d) Paris</label>
                <label><input type="radio" name="answers[1]" value="e"> (e) London</label>
            </div>

            <div class="question">2. Which planet is known as the Red Planet?</div>
            <div class="options">
                <label><input type="radio" name="answers[2]" value="a"> (a) Venus</label>
                <label><input type="radio" name="answers[2]" value="b"> (b) Mars</label>
                <label><input type="radio" name="answers[2]" value="c"> (c) Jupiter</label>
                <label><input type="radio" name="answers[2]" value="d"> (d) Saturn</label>
                <label><input type="radio" name="answers[2]" value="e"> (e) Neptune</label>
            </div>

            <div class="question">3. Who wrote "Hamlet"?</div>
            <div class="options">
                <label><input type="radio" name="answers[3]" value="a"> (a) Charles Dickens</label>
                <label><input type="radio" name="answers[3]" value="b"> (b) William Shakespeare</label>
                <label><input type="radio" name="answers[3]" value="c"> (c) Jane Austen</label>
                <label><input type="radio" name="answers[3]" value="d"> (d) Mark Twain</label>
                <label><input type="radio" name="answers[3]" value="e"> (e) George Orwell</label>
            </div>

            <div class="question">4. What is the chemical symbol for water?</div>
            <div class="options">
                <label><input type="radio" name="answers[4]" value="a"> a) H2O</label>
                <label><input type="radio" name="answers[4]" value="b"> b) CO2</label>
                <label><input type="radio" name="answers[4]" value="c"> c) O2</label>
                <label><input type="radio" name="answers[4]" value="d"> d) N2</label>
                <label><input type="radio" name="answers[4]" value="e"> e) CH4</label>
            </div>

            <div class="question">5. What is the largest ocean on Earth?</div>
            <div class="options">
                <label><input type="radio" name="answers[5]" value="a"> a) Atlantic Ocean</label>
                <label><input type="radio" name="answers[5]" value="b"> b) Indian Ocean</label>
                <label><input type="radio" name="answers[5]" value="c"> c) Arctic Ocean</label>
                <label><input type="radio" name="answers[5]" value="d"> d) Southern Ocean</label>
                <label><input type="radio" name="answers[5]" value="e"> e) Pacific Ocean</label>
            </div>

            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>

</body>
</html>
