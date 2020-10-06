@component('mail::message')
<h1>Twoje zamówienie</h1>
<table class="table table-dark mt-5">
    <thead>
      <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>
        <th scope="col">Opis</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
        <tr>
            <td>{{$item['name']}}</td>
            <td>{{$item['cost']}}</td>
            <td>{{$item['description']}}</td>                
        </tr>
        @endforeach
    </tbody>
  </table>
@endcomponent

