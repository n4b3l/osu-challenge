@extends('layouts.default')
@section('content')
    <?php
    $challenges = App\Challenge::all();
    ?>
    <table id="challengeTable" class="table table-dark table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Challenge</th>
            <th>Players</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($challenges as $challenge) { ?>
        <tr>
            <td><?= $challenge->name ?></td>
            <td><?= $challenge->user_ids ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
@endsection