<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Exam</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            width: 70%;
            margin: auto;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h2 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: brown;
        }
        .question {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .question-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .options {
            flex: 1;
        }
        .question-image {
            flex: 0.4;
            max-width: 250px;
            height: auto;
            border-radius: 5px;
            margin-left: 20px;
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
        <h3>{{ $cbtExam->exam_title }}</h3>
        <hr> <br>

        <form id="examForm">
            @csrf

            @foreach($questions as $key => $question)
                <div class="question">
                    {{ $key + 1 }}. {{ $question->question }}
                </div>

                <div class="question-wrapper">
                    <div class="options">
                        @foreach(['a', 'b', 'c', 'd', 'e'] as $option)
                            @if(!empty($question->{'option_' . $option}))
                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" data-question-id="{{ $question->id }}">
                                    ({{ strtoupper($option) }}) {{ $question->{'option_' . $option} }}
                                </label>
                            @endif
                        @endforeach
                    </div>

                    @if(!empty($question->image))
                        <img src="{{ asset('upload/question_images/' . $question->image) }}" alt="Question Image" class="question-image">
                    @endif
                </div>

                <br> <hr> <br><br>
            @endforeach

            <button type="button" class="submit-btn">SUBMIT</button>
        </form>
    </div>


    <script>

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                let questionId = this.dataset.questionId;
                let selectedOption = this.value;

                fetch("{{ route('cbt.save_response') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ question_id: questionId, selected_option: selectedOption })
                }).then(response => response.json())
                .then(data => console.log(data.message))
                .catch(error => console.error("Error:", error));
            });
        });

        document.querySelector('.submit-btn').addEventListener('click', function () {
            fetch("{{ route('cbt.submit_exam') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ cbt_exam_id: "{{ $cbtExam->id }}" })
            }).then(response => response.json())
            .then(data => alert(`Exam submitted! Total Correct Answers: ${data.total_correct}`))
            .catch(error => console.error("Error:", error));
        });


    </script>

   

</body>
</html>
