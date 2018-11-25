@extends('layouts.default')
@section('head')
    <style>
        .hoverable tr:hover{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <?php
    $challenges = App\Challenge::all();
    ?>
    <table id="challengeTable" class="table  table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Challenge</th>
            <th>Players</th>
        </tr>
        </thead>
        <tbody class="hoverable">
        <?php foreach ($challenges as $challenge) { ?>
        <tr class='clickable-row' data-href='/view_challenge.php?id=<?= $challenge->ID   ?>'>
            <td><?= $challenge->name ?></td>
            <td><?= $challenge->user_ids ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
@endsection
@section('scripts')
    <script>
        $(document).ready(function()
        {
            $("tr").css({
                "background-color": "deeppink",
                "color": "white"});
            $("tr:odd").css({
                "background-color": "white",
                "color": "deeppink"});
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
        // $(document).ready( function () {
        //     $('#challengeTable').DataTable();
        // } );
    </script>
@endsection