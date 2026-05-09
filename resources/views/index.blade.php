@extends('layout')

@section('content')
<h1 class="text-xl font-bold mb-4">Daftar Restoran</h1>

<a href="?sort=rating" class="bg-blue-500 text-white px-3 py-1">Sort Rating</a>

<table class="table-auto w-full mt-4 bg-white">
<tr class="bg-gray-200">
    <th>Nama</th>
    <th>Kota</th>
    <th>Rating</th>
</tr>

@foreach($restoran as $r)
<tr>
    <td><a href="/restoran/{{ $r['id'] }}">{{ $r['nama'] }}</a></td>
    <td>{{ $r['kota'] }}</td>
    <td>{{ $r['rating'] }}</td>
</tr>
@endforeach

</table>
@endsection