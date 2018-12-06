<?php use Illuminate\Support\Facades\DB; ?>
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
    $scores = DB::table('challenge_user_tt')->where('challenge_id',$id)->get();
    ?>
    <table id="challengeTable" class="table  table-bordered" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Player</th>
            <th scope="col">Score</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($scores as $score) { ?>
        <tr>
            <th scope="row"><?= $score->beatmap_id ?></th>
            <td><?= $score->beatmap_name ?></td>
            <td><?= $score->user_id ?></td>
            <td><?= $score->score ?></td>
        </tr>
        <?php
        }
        ?>
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