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

    <div id="fullscreenOverlay" style="
                    position: fixed;
                    inset: 0;
                    background-color: rgba(0,0,0,0.9);
                    color: white;
                    font-size: 24px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 10000;
                    cursor: pointer;
                ">
        Click anywhere to begin the exam in fullscreen mode
    </div>

    <div id="warningOverlay" style="
                    position: fixed;
                    inset: 0;
                    background-color: rgba(255,0,0,0.9);
                    color: white;
                    font-size: 24px;
                    display: none;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    z-index: 10001;
                    padding: 20px;
                ">
        <div>
            <strong>You exited fullscreen mode.</strong><br><br>
            The exam will now be submitted automatically for security reasons.
        </div>
    </div>


    <div class="exam-container">
        <div id="floating-timer" style="
                        position: fixed;
                        top: 20px;
                        right: 30px;
                        font-size: 20px;
                        background-color: white;
                        color: black;
                        padding: 10px 15px;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
                        z-index: 9999;
                    ">
            Timer: <span id="timer" style="font-weight: bold;"></span>
        </div>

        <h2>{{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }}</h2>
        <h3>{{ $cbtExam->exam_title }}</h3>
        <hr><br>

        <form id="examForm">
            @csrf
            <input type="hidden" id="attemptId" value="{{ $cbtAttempt->id }}">
            <input type="hidden" id="studentId" value="{{ $getStudent->id }}">

            @foreach($questions as $key => $question)
                <div class="question">
                    {{ $key + 1 }}. {!! $question->question !!}
                </div>

                <div class="question-wrapper">
                    <div class="options">
                        @foreach(['a', 'b', 'c', 'd', 'e'] as $option)
                            @if(!empty($question->{'option_' . $option}))
                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ strtoupper($option) }}"
                                        data-question-id="{{ $question->id }}" @if(isset($responses[$question->id]) && $responses[$question->id] === strtoupper($option)) checked @endif>
                                    ({!! strtoupper($option) !!}) {!! $question->{'option_' . $option} !!}
                                </label>
                            @endif
                        @endforeach
                    </div>

                    @if(!empty($question->image))
                        <img src="{{ asset('upload/question_images/' . $question->image) }}" alt="Question Image"
                            class="question-image">
                    @endif
                </div>

                <br>
                <hr> <br><br>
            @endforeach

            <button type="button" class="submit-btn">SUBMIT</button>
        </form>
    </div>

    <script>
        const durationMinutes = {{ $cbtExam->duration }};
        const totalSeconds = durationMinutes * 60;
        const timerElement = document.getElementById('timer');
        const attemptId = document.getElementById('attemptId').value;
        const studentId = document.getElementById('studentId').value;
        const submitBtn = document.querySelector('.submit-btn');

        let timerInterval;
        let examInProgress = true;
        let submitted = false;
        let timerStarted = false;

        function updateTimerDisplay(secondsLeft) {
            const minutes = Math.floor(secondsLeft / 60);
            const seconds = secondsLeft % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            timerElement.style.color = secondsLeft <= 120 ? 'red' : 'black';
        }

        function startTimer() {
            if (timerStarted) return;
            timerStarted = true;

            let startedAt = localStorage.getItem(`cbt_start_time_${attemptId}`);
            if (!startedAt) {
                startedAt = Date.now();
                localStorage.setItem(`cbt_start_time_${attemptId}`, startedAt);
            }

            function tick() {
                const now = Date.now();
                const elapsedSeconds = Math.floor((now - startedAt) / 1000);
                const secondsLeft = totalSeconds - elapsedSeconds;

                if (secondsLeft <= 0) {
                    clearInterval(timerInterval);
                    updateTimerDisplay(0);
                    if (!submitted) autoSubmitExam();
                } else {
                    updateTimerDisplay(secondsLeft);
                }
            }

            tick();
            timerInterval = setInterval(tick, 1000);
        }

        function autoSubmitExam() {
            examInProgress = false;
            submitBtn.disabled = true;
            document.querySelectorAll('input[type="radio"]').forEach(r => r.disabled = true);
            fetch("{{ route('student.cbt.submit_exam') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    cbt_exam_id: "{{ $cbtExam->id }}",
                    attempt_id: attemptId
                })
            })
                .then(response => response.json())
                .then(data => {
                    releaseLock();
                    localStorage.removeItem(`cbt_start_time_${attemptId}`);
                    window.location.href = `/student/cbt/result/${data.attempt_id}`;
                })
                .catch(error => {
                    console.error("Auto-submit failed:", error);
                });
        }

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const questionId = this.dataset.questionId;
                const selectedOption = this.value;

                const radiosForThisQuestion = document.querySelectorAll(`input[name="answers[${questionId}]"]`);
                radiosForThisQuestion.forEach(r => r.disabled = true);

                fetch("{{ route('student.cbt.save_response') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        attempt_id: attemptId,
                        student_id: studentId,
                        question_id: questionId,
                        selected_option: selectedOption
                    })
                })
                    .then(response => response.json())
                    .catch(error => {
                        console.error("Error saving response:", error);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            radiosForThisQuestion.forEach(r => r.disabled = false);
                        }, 3000);
                    });
            });
        });

        document.querySelector('.submit-btn').addEventListener('click', function () {
            if (submitted) return;
            submitted = true;

            fetch("{{ route('student.cbt.submit_exam') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    cbt_exam_id: "{{ $cbtExam->id }}",
                    attempt_id: attemptId
                })
            })
                .then(response => response.json())
                .then(data => {
                    releaseLock();
                    localStorage.removeItem(`cbt_start_time_${attemptId}`);
                    window.location.href = `/student/cbt/result/${data.attempt_id}`;
                })
                .catch(error => console.error("Error:", error));
        });

        function releaseLock() {
            examInProgress = false;
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            function launchFullScreen() {
                const elem = document.documentElement;

                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                }

                const overlay = document.getElementById("fullscreenOverlay");
                if (overlay) overlay.remove();

                startTimer();
                document.removeEventListener('click', launchFullScreen);
            }

            document.addEventListener('click', launchFullScreen);
        });

        document.addEventListener("keydown", function (e) {
            if (!examInProgress) return;
            if (e.key === "F11" || e.key === "Escape") {
                e.preventDefault();
            }
        });

        document.addEventListener("contextmenu", function (e) {
            if (examInProgress) e.preventDefault();
        });

        function checkFullscreen() {
            const isFull = document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
            if (!isFull && examInProgress) {
                // Show warning overlay
                const warningOverlay = document.getElementById("warningOverlay");
                warningOverlay.style.display = "flex";

                // Prevent further interactions
                document.querySelectorAll('input[type="radio"]').forEach(r => r.disabled = true);
                submitBtn.disabled = true;

                // Submit after a short delay
                setTimeout(() => {
                    if (!submitted) {
                        submitted = true;
                        autoSubmitExam();
                    }
                }, 3000); // 3-second delay before submitting
            }
        }


        document.addEventListener("fullscreenchange", checkFullscreen);
        document.addEventListener("webkitfullscreenchange", checkFullscreen);
        document.addEventListener("msfullscreenchange", checkFullscreen);
    </script>
</body>

</html>