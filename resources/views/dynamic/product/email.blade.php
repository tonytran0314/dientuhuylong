<div style="
    background-color: #ebebeb;
    max-width: 600px;
    margin:auto;">

    {{-- header --}}
    <div style="
        background-color: #2F4C39;
        text-align: center;
        color: white;
        padding: 10px;">
        <h1>ĐIỆN TỬ HUY LONG</h1>
    </div>

    {{-- body --}}
    <div style="
        padding: 30px 60px;">

        <h3>Kính gửi: {{ $name }}</h3>

        <p>Chúng tôi đã nhận được đơn hàng của bạn, chúng tôi sẽ liên lạc với bạn sớm nhất có thể để xác nhận đơn hàng. Quý khách có thể thanh toán khi nhận được hàng. Đơn hàng sẽ được giao tại địa chỉ: </p>

        <h3>
            {{ $nr }}
            <br>
            {{ $px->name }}
            <br>
            {{ $qh->name }}
            <br>
            {{ $ttp->name }}
        </h3>

        <p>Xin cám ơn quý khách đã chọn mua sắm ở điện tử Huy Long, chúng tôi hi vọng bạn đã có trải nghiệm mua sắm tuyệt vời với cửa hàng.<br> Xin cảm ơn quý khách.</p>

        <div style="width: 100%; text-align:center;">
            <a style="
            text-decoration: none;
            background-color: #2F4C39;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            display: inline-block;
            font-weight:bold;
            font-size: 1.3em;
                " href="{{ route('home') }}">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>