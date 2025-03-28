@extends('layout')
@section('title', 'Students')
@section('content')
<h2>Students</h2>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search student by name" id="search">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="search-btn">Search</button>
    </div>
</div>
<div class="input-group mb-3">
    <input type="number" class="form-control" placeholder="Min Age" id="min-age" min="0">
    <input type="number" class="form-control" placeholder="Max Age" id="max-age" min="0">
</div>
<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody id="student-table">
        @include('partials.table')
    </tbody>
</table>

<script>
    $(document).ready(function() {
        // Trigger search on button click
        $('#search-btn').click(function() {
            filterStudents();
        });

        // Trigger search on pressing Enter key
        $('#search').keypress(function(e) {
            if (e.which == 13) { // Enter key pressed
                filterStudents();
            }
        });

        // Trigger filtering when age range is changed
        $('#min-age, #max-age').change(function() {
            filterStudents();
        });

        function filterStudents() {
            var search = $('#search').val();
            var minAge = $('#min-age').val();
            var maxAge = $('#max-age').val();

            $.get('/students/filter', {search: search, min_age: minAge, max_age: maxAge}, function(data) {
                $('#student-table').html(data);
            });
        }
    });
</script>
@endsection
