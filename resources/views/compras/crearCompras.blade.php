@extends('layouts.plantilla')

@section('contenido')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Comprar productos</h1>
        </div>
        <div class="card-body">
            <div class="card">
                <form action="{{ route('guardarCompra') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <div class="form group">
                            <label for="nombreCompra">Nombre de la compra: </label>
                            <input type="text" class="form-control" name="nombreCompra" id="nombreCommpra" placeholder="Nombre de la compra...">
                        </div>
                    </div>
                    <div class="card-header">
                            <div class="form-group">
                                <label for="idProducto">Producto: </label>
                                <select class="form-control" name="idProducto" id="idProducto">
                                    <option value="">Seleccione el producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombreProducto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad: </label>
                                <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad...">
                            </div>
                            <hr>
                            <button type="button" id="agregarProducto" class="btn btn-secondary col-md-12">Agregar</button>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre producto</th>
                                    <th>Cantidad</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="cajaDetalle">

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark col-md-12">Guardar compra</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            let arrayIdProductos = [];
            let arrayCantidad = [];
            $('#agregarProducto').click(function(){
                let idProducto = parseInt($('#idProducto option:selected').val());
                let producto = $('#idProducto option:selected').text();
                let cantidad = parseInt($('#cantidad').val());

                if(arrayIdProductos.includes(idProducto)){
                    $('#tr-'+idProducto).remove();
                    let indice = arrayIdProductos.indexOf(idProducto);
                    cantidad += arrayCantidad[indice];
                    arrayCantidad.splice(1, indice);
                    arrayIdProductos.splice(1, indice);
                    arrayIdProductos.push(idProducto);
                    arrayCantidad.push(cantidad);
                }else{
                    arrayIdProductos.push(idProducto);
                    arrayCantidad.push(cantidad);
                }
                $('#cajaDetalle').append(`
                    <tr id="tr-${idProducto}">
                        <input type="hidden" name="idProducto[]" value="${idProducto}">
                        <input type="hidden" name="cantidad[]" value="${cantidad}">
                        <td>${producto}</td>
                        <td>${cantidad}</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminarProducto(${idProducto})">X</button>
                        </td>
                    </tr>
                `);
            });
        });

        function eliminarProducto(idProducto){
            $('#tr-'+idProducto).remove();
            let indice = arrayIdProductos.indexOf(idProducto);
            arrayCantidad.splice(1, indice);
            arrayIdProductos.splice(1, indice);
        }
    </script>
@endsection