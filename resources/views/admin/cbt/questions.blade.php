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
                        <form method="POST" action="{{ route('teacher.cbt.questions.store', ['id' => $getCbtTitle->id]) }}" enctype="multipart/form-data">
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
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][question]">{{ old("questions.$key.question", $question['question']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.question") }}</div>
                                                </td>
                                                <td>
                                                    @if (!empty($question['image']))
                                                        <img src="{{ asset('upload/question_images/' . $question['image']) }}" alt="Existing Image" style="max-width: 40px; max-height: 40px; margin-bottom: 4px;">
                                                    @endif
                                                    <input type="file" class="form-control-file d-none" name="questions[{{ $key }}][image]" accept="image/*" id="file-upload-{{ $key }}">
                                                    <label for="file-upload-{{ $key }}" class="btn btn-primary">
                                                        <i class="fas fa-arrow-up"></i> <small>Upload</small>
                                                    </label>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.image") }}</div>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="questions[{{ $key }}][id]" value="{{ old("questions.$key.id", $question['id'] ?? '') }}">
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][option_a]">{{ old("questions.$key.option_a", $question['option_a']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_a") }}</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][option_b]">{{ old("questions.$key.option_b", $question['option_b']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_b") }}</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][option_c]">{{ old("questions.$key.option_c", $question['option_c']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_c") }}</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][option_d]">{{ old("questions.$key.option_d", $question['option_d']) }}</textarea>
                                                    <div style="color: red;">{{ $errors->first("questions.$key.option_d") }}</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control summernote" name="questions[{{ $key }}][option_e]">{{ old("questions.$key.option_e", $question['option_e']) }}</textarea>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">

<script>
    function initializeSummernote(context) {
        $(context).find('.summernote').summernote({
            height: 60,
            toolbar: false
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        let questionIndex = {{ count(old('questions', $questions)) }};

        // Create a clean clone of the first row to use as a template
        const templateRow = document.querySelector('.question-row').cloneNode(true);
        // Remove summernote instances, values, and image from the template
        templateRow.querySelectorAll('.summernote').forEach(el => {
            $(el).summernote('destroy');
            el.value = '';
        });
        templateRow.querySelectorAll('input, select').forEach(el => {
            if (el.type === 'file') {
                el.value = '';
            } else {
                el.value = '';
            }
        });
        const imagePreview = templateRow.querySelector('img');
        if (imagePreview) {
            imagePreview.remove();
        }

        // Add event delegation
        document.querySelector('#questions-container tbody').addEventListener('click', function (e) {
            if (e.target.closest('.add-row')) {
                e.preventDefault();
                const newRow = templateRow.cloneNode(true);

                // Update all input names and IDs
                newRow.querySelectorAll('[name], [id], label[for]').forEach(el => {
                    if (el.name) {
                        el.name = el.name.replace(/\[\d+\]/, `[${questionIndex}]`);
                    }
                    if (el.id && el.id.includes('file-upload-')) {
                        const newId = `file-upload-${questionIndex}`;
                        el.id = newId;
                        const label = newRow.querySelector(`label[for^="file-upload-"]`);
                        if (label) {
                            label.setAttribute('for', newId);
                        }
                    }
                });

                // Reset correct option select
                const correctOptionSelect = newRow.querySelector('select[name$="[correct_option]"]');
                if (correctOptionSelect) {
                    correctOptionSelect.value = '';
                }

                document.querySelector('#questions-container tbody').appendChild(newRow);
                initializeSummernote(newRow);
                questionIndex++;
            }

            if (e.target.closest('.remove-row')) {
                e.preventDefault();
                const allRows = document.querySelectorAll('.question-row');
                if (allRows.length > 1) {
                    e.target.closest('.question-row').remove();
                }
            }
        });

        // Initialize existing editors on load
        initializeSummernote(document);
    });
</script>

@endsection