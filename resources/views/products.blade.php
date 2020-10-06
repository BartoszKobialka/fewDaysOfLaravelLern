@extends('layouts.main')

@section('content')
@foreach ($products as $item)
<tr>
    <td>{{$item['name']}}</td>
    <td>{{$item['cost']}}</td>
    <td>{{$item['description']}}</td>
<td><button onclick="send('{{'add/'.$item['id']}}')" class="send btn btn-success" value="{{$item['id']}}">Dodaj do koszyka</button></td>
    
</tr>
@endforeach
@endsection