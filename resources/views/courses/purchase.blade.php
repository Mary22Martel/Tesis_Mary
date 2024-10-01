@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Comprar Curso: {{ $course->titulo }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $course->titulo }}</h5>
            <p class="card-text">{{ $course->descripcion }}</p>
            <p><strong>Precio:</strong> ${{ $course->precio }}</p>
            <p><strong>Duración:</strong> {{ $course->duracion }} horas</p>
        </div>
    </div>

    <form action="{{ route('courses.purchase.confirm', $course->id) }}" method="POST">
        @csrf
        <div class="form-group mt-3">
            <label for="payment_method">Método de Pago</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="credit_card">Tarjeta de Crédito</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Confirmar Compra</button>
    </form>
</div>
<br>
<br>
<br>
@endsection
