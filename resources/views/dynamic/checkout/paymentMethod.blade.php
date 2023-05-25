@extends('layouts.master')

@section('title', 'Phương thức thanh toán')

@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <h3>Payment methods</h3>
            <form action="{{ route('payment.cod') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Thanh toán khi nhận hàng</button>
            </form>
            <br>
            <br>
            <form action="{{ route('payment.vnpay') }}" method="POST">
                @csrf
                <button name="" class="btn btn-primary">Thanh toán VNPay</button>
            </form>
        </div>
    </div>
</div>
@stop