@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 style="color: brown">{{ $getCbtTitle->exam_title }} <span style="color: black">Questions</span></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')

                    <div class="card card-primary">
                        <form method="POST" action="{{ route('cbt.questions.store', ['id' => $getCbtTitle->id]) }}">
                            @csrf
                            <div class="card-body">
                                <div id="questions-container" style="overflow-x: auto; display: block; width: 100%;">
                                    <table class="table table-bordered" style="min-width: 1200px; table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th style="width: 400px;">Question</th>
                                                <th style="width: 150px;">Option A</th>
                                                <th style="width: 150px;">Option B</th>
                                                <th style="width: 150px;">Option C</th>
                                                <th style="width: 150px;">Option D</th>
                                                <th style="width: 150px;">Option E</th>
                                                <th style="width: 150px;">Correct Option</th>
                                                <th style="width: 100px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $questions = old('questions', $questions ?? [[
                                                    'id' => null,
                                                    'question' => '',
                                                    'option_a' => '',
                                                    'option_b' => '',
                                                    'option_c' => '',
                                                    'option_d' => '',
                                                    'option_e' => '',
                                                    'correct_option' => ''
                                                ]]);
                                            @endphp

                                            @foreach ($questions as $key => $question)
                                            <tr class="question-row">
                                                <td>
                                                    <textarea class="form-control" name="questions[{{ $key }}][question]" placeholder="Enter the question">{{ old("questions.$key.question", $question['question']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.question") }}</div>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="questions[{{ $key }}][id]" value="{{ old("questions.$key.id", $question['id'] ?? '') }}">
                                                    <input type="text" class="form-control" name="questions[{{ $key }}][option_a]" value="{{ old("questions.$key.option_a", $question['option_a']) }}" placeholder="Option A">
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_a") }}</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="questions[{{ $key }}][option_b]" value="{{ old("questions.$key.option_b", $question['option_b']) }}" placeholder="Option B">
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_b") }}</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="questions[{{ $key }}][option_c]" value="{{ old("questions.$key.option_c", $question['option_c']) }}" placeholder="Option C">
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_c") }}</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="questions[{{ $key }}][option_d]" value="{{ old("questions.$key.option_d", $question['option_d']) }}" placeholder="Option D">
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_d") }}</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="questions[{{ $key }}][option_e]" value="{{ old("questions.$key.option_e", $question['option_e']) }}" placeholder="Option E">
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_e") }}</div>
                                                </td>
                                                <td>
                                                    <select required class="form-control" name="questions[{{ $key }}][correct_option]">
                                                        <option value="" disabled {{ old("questions.$key.correct_option", $question['correct_option']) == '' ? 'selected' : '' }}>Select</option>
                                                        <option value="A" {{ old("questions.$key.correct_option", $question['correct_option']) == 'A' ? 'selected' : '' }}>A</option>
                                                        <option value="B" {{ old("questions.$key.correct_option", $question['correct_option']) == 'B' ? 'selected' : '' }}>B</option>
                                                        <option value="C" {{ old("questions.$key.correct_option", $question['correct_option']) == 'C' ? 'selected' : '' }}>C</option>
                                                        <option value="D" {{ old("questions.$key.correct_option", $question['correct_option']) == 'D' ? 'selected' : '' }}>D</option>
                                                        <option value="E" {{ old("questions.$key.correct_option", $question['correct_option']) == 'E' ? 'selected' : '' }}>E</option>
                                                    </select>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.correct_option") }}</div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success add-row"><i class="fas fa-plus"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-minus"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Questions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionIndex = {{ count(old('questions', $questions)) }};

        document.querySelector('#questions-container tbody').addEventListener('click', function (e) {
            if (e.target.closest('.add-row')) {
                e.preventDefault();
                const newRow = document.querySelector('.question-row').cloneNode(true);

                newRow.querySelectorAll('textarea, input, select').forEach(input => {
                    input.value = '';
                    input.name = input.name.replace(/\[\d+\]/, `[${questionIndex}]`);
                    if (input.type === 'hidden') input.value = ''; // Clear hidden ID field
                });

                document.querySelector('#questions-container tbody').appendChild(newRow);
                questionIndex++;
            }

            if (e.target.closest('.remove-row')) {
                e.preventDefault();
                const row = e.target.closest('.question-row');
                const questionId = row.querySelector('input[name$="[id]"]').value;

                if (questionId) {
                    // Mark row for deletion
                    row.remove();
                } else {
                    row.remove();
                }
            }
        });
    });
</script>

@endsection

