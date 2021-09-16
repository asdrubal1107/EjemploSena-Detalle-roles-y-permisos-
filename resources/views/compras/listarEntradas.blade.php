@extends('layouts.plantilla')

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h1>Lista entradas - compra {{ $compra->nombreCompra }}</h1>
            <a href="{{ url('/compras') }}" style="height: 50%;" class="btn btn-secondary">Regresar</a>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
                <div class="card">
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                </div>    
            @endif
            @if ($errors->any())
                <div class="card">
                    @foreach ($errors->all() as $value)
                        <div class="alert alert-danger" role="alert">
                            {{ $value }}
                        </div>
                    @endforeach
                </div> 
            @endif
            <div class="table-responsive">
                <table id="listarEntradas" style="width: 100%" class="table table-hover display">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre producto</th>
                            <th>Cantidad ingresada</th>
                            <th>Fecha de entrada</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let idCompra = {{ $compra->id }}
        $(document).ready(function(){
            $('#listarEntradas').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/compras/entradas/listar/'+idCompra,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nombreProducto', name: 'nombreProducto'},
                    {data: 'cantidadIngresada', name: 'cantidadIngresada'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        });
    </script>
@endsection