@extends('layouts.main')


@section('content')
@foreach ($products as $item)
    <tr>
        <td>{{$item['name']}}</td>
        <td>{{$item['cost']}}</td>
        <td>{{$item['description']}}</td>
        <td><button onclick="send('{{'remove/'.$item['id']}}')" class="send btn btn-danger" value="{{$item['id']}}">Usuń z koszyka</button></td>                   
    </tr>
@endforeach


@endsection