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
    $scores = DB::table('challenge_user_tt')->where('challenge_id',$id)->orderBy('score', 'desc')->orderBy('beatmap_id', 'asc')->get();
    ?>
    <table id="challengeTable" class="table  table-bordered" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Player</th>
            <th scope="col">Score</th>
        </tr>
        </thead>
        <tbody class="hoverable">
        <?php
        foreach ($scores as $score) { ?>
        <tr>
            <td class='clickable-row' data-href='https://osu.ppy.sh/b/<?= $score->beatmap_id   ?>'><?= $score->beatmap_name ?></td>
            <td class='clickable-row' data-href='https://osu.ppy.sh/u/<?= $score->user_id   ?>'><?= $score->user_id ?></td>
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
            $(".clickable-row").click(function(e) {
                if (e.ctrlKey || e.which == 2 || e.button == 4) {
                    window.open($(this).data("href"));
                }
                else {
                    window.location = $(this).data("href");
                }
            });
            $(".clickable-row").mousedown(function(e) {
                if( e.which == 2 ) {
                    window.open($(this).data("href"));
                }
            });
        });
        // $(document).ready( function () {
        //     $('#challengeTable').DataTable();
        // } );
    </script>
@endsection