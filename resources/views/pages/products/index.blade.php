@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">
    <h2 class="text-xl font-bold">Products</h2>
    <a href="{{ route('products.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
       Add Product
    </a>
</div>

@if(session('success'))
    <div class="mb-4 text-green-600">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2">Name</th>
            <th class="p-2">Description</th>
            <th class="p-2">Price</th>
            <th class="p-2">Stock</th>
            <th class="p-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="border-t">
            <td class="p-2">{{ $product->name }}</td>
            <td class="p-2">{{ $product->description }}</td>
            <td class="p-2">{{ $product->price }}</td>
            <td class="p-2">{{ $product->stock }}</td>
            <td class="p-2 flex gap-2">
                <a href="{{ route('products.edit', $product->id) }}"
                   class="text-blue-600">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
