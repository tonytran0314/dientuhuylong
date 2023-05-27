<div style="
    background-color: #ebebeb;
    max-width: 800px;
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

        <h3>Kính gửi khách hàng: {{ $name }}</h3>

        <p>Chúng tôi đã nhận được đơn hàng của bạn, chúng tôi sẽ liên lạc với bạn sớm nhất có thể để xác nhận đơn hàng</p>

        <h4>Thông tin đơn hàng</h4>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prodsInCart as $product)
                    <tr style="text-align: center;">
                        <td style="padding: 10px;">{{ $product->name }}</td>
                        <td style="padding: 10px;">{{ number_format($product->price) }}</td>
                        <td style="padding: 10px;">{{ $product->pivot->quantity }}</td>
                        <td style="padding: 10px;">{{ number_format($product->price * $product->pivot->quantity) }}</td>
                    </tr>
                @endforeach
                <tr style="text-align: center;">
                    <td colspan="3">Tổng cộng</td>
                    <td><strong>{{ number_format($total) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <h4>Thông tin khách hàng</h4>
        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ giao hàng</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align:center">
                    <td>{{ $name }}</td>
                    <td>{{ $phone_number }}</td>
                    <td>{{ $address }}</td>
                    <td>{{ $notes }}</td>
                </tr>
            </tbody>
        </table>

        <hr>

        <p>
            Mọi thắc mắc quý khách vui lòng liên hệ với cửa hàng thông qua số điện thoại để biết thêm chi tiết
            <br>
            Xin cám ơn quý khách đã chọn mua sắm ở điện tử Huy Long, chúng tôi hi vọng bạn đã có trải nghiệm mua sắm tuyệt vời với cửa hàng.<br> 
            Xin cảm ơn quý khách.
        </p>

        <div style="width: 100%; text-align:center;">
            <a 
                href="{{ route('home') }}" 
                style="
                    text-decoration: none;
                    background-color: #2F4C39;
                    color: white;
                    padding: 20px;
                    border-radius: 10px;
                    margin: 20px auto;
                    display: inline-block;
                    font-weight:bold;
                    font-size: 1.3em;">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>