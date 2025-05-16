@extends('layouts.app')

<style>
    label[for^="file-upload-"] {
        cursor: pointer;
        font-size: 12px;
        padding: 3px 5px;
        border-radius: 5px;
        background-color: #109789;
        color: white;
    }

    label[for^="file-upload-"]:hover {
        background-color: #109789;
    }

</style>

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
                        <form method="POST" action="{{ route('cbt.questions.store', ['id' => $getCbtTitle->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div id="questions-container" style="overflow-x: auto; display: block; width: 100%;">
                                    <table class="table table-bordered" style="min-width: 1200px; table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th style="width: 400px;">Question</th>
                                                <th style="width: 100px;">Image</th>
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
                                                    'image' => '',
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
                                                    {{-- Display existing image if available --}}
                                                    @if (!empty($question['image']))
                                                        <img src="{{ asset('upload/question_images/' . $question['image']) }}" alt="Existing Image" style="max-width: 40px; max-height: 40px; margin-bottom: 4px;">
                                                    @endif

                                                    {{-- Hidden file input --}}
                                                    <input type="file" class="form-control-file d-none" name="questions[{{ $key }}][image]" accept="image/*" id="file-upload-{{ $key }}">

                                                    {{-- Custom upload button with arrow icon --}}
                                                    <label for="file-upload-{{ $key }}" class="btn btn-primary">
                                                        <i class="fas fa-arrow-up"></i> <small>Upload</small>
                                                    </label>

                                                    <div style="color: red;">{{ $errors->first("questions.$key.image") }}</div>
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

@endsection


@section('script')

{{-- FOR SUMMER NOTE --}}
<script src="https://cdn.jsdelivr.net/npm/select2@latest/dist/js/select2.min.js"></script>



<script>
    //THIS JS IS WORKING 
    // document.addEventListener('DOMContentLoaded', function () {
    //     let questionIndex = {{ count(old('questions', $questions)) }};

    //     document.querySelector('#questions-container tbody').addEventListener('click', function (e) {
    //         if (e.target.closest('.add-row')) {
    //             e.preventDefault();
    //             const newRow = document.querySelector('.question-row').cloneNode(true);

    //             newRow.querySelectorAll('textarea, input, select').forEach(input => {
    //                 input.name = input.name.replace(/\[\d+\]/, `[${questionIndex}]`);
    //                 input.value = input.type === 'hidden' ? '' : null;
    //             });

    //             document.querySelector('#questions-container tbody').appendChild(newRow);
    //             questionIndex++;
    //         }

    //         if (e.target.closest('.remove-row')) {
    //             e.preventDefault();
    //             const row = e.target.closest('.question-row');
    //             row.remove();
    //         }
    //     });
    // });




document.addEventListener('DOMContentLoaded', function () {
    let questionIndex = {{ count(old('questions', $questions)) }};  // Get current number of questions

    document.querySelector('#questions-container tbody').addEventListener('click', function (e) {
        if (e.target.closest('.add-row')) {
            e.preventDefault();
            const newRow = document.querySelector('.question-row').cloneNode(true);

            // Update names and ids for all inputs in the new row
            newRow.querySelectorAll('textarea, input, select').forEach(input => {
                // Update name attribute to reflect new question index
                input.name = input.name.replace(/\[\d+\]/, `[${questionIndex}]`);
                input.value = '';  // Clear values for the new row

                // Reset the file input ID and name to be unique
                if (input.type === 'file') {
                    const fileInputId = `file-upload-${questionIndex}`;
                    input.id = fileInputId;
                    input.name = `questions[${questionIndex}][image]`;
                    newRow.querySelector(`label[for^="file-upload-"]`).setAttribute('for', fileInputId);
                }
            });

            // Clear the image preview for the new row
            const imagePreview = newRow.querySelector('img');
            if (imagePreview) {
                imagePreview.remove();
            }

            // Append the new row to the table body
            document.querySelector('#questions-container tbody').appendChild(newRow);
            questionIndex++;
        }

        if (e.target.closest('.remove-row')) {
            e.preventDefault();
            const row = e.target.closest('.question-row');
            row.remove();
        }
    });
});

   

</script>

@endsection

