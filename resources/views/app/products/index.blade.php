@extends('layouts.app', ['name' => 'Joe Doe'])

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between mt-3">
                <div class="heading-title">
                    <h1>{{ $data['title'] }}</h1>
                </div>
                <div class="text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Добавить</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body card-content">
                <div class="row">
                    <div class="col-12">
                        @if($data['products']->isEmpty())
                            <div class="text-center mt-5">
                                <strong>Нет товаров</strong>
                            </div>

                        @else
                            @if( session()->has('message'))
                                <div class="alert alert-success">
                                    <b>{{ session()->get('message') }}</b>
                                </div>
                            @endif
                            <table class="main-table table table-hover">
                                <thead>
                                <tr>
                                    <td>Категория</td>
                                    <td>Родительская категория</td>
                                    <td>Порядок сортировки</td>
                                    <td class="text-right">Действия</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['products'] as $product)
                                    <tr>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td>{{ $product['category_id'] }}</td>
                                        <td>{{ $product['sort_order'] }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a class="btn btn-success"
                                                   href="{{ route('products.edit',$product->id) }}"><i class="fas fa-eye"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endempty
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        {{ $data['products']->links('assets.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
