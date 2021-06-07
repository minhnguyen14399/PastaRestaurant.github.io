<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
    <style>
        .main{
            font-size: large;
            margin-bottom: 20px;
        }
    
        
    </style>
</head>
<body>

<div class="container">
	@include('pages.elements.header')
    <div class="main">
        <strong><h1> Hướng dẫn đặt phần ăn </h1> </strong><br>

Để order thức ăn khách hàng có thể order trực tiếp trên website <a href="http://localhost/PastaRestaurant/"> http://minideli.vn </a>, hoặc vui lòng gọi điện thoại đến tổng đài: 1900 6552:
<br>
- Khách hàng liên hệ đến tổng đài để được các tổng đài viên hỗ trợ.<br>
- Khách hàng gọi tên phần ăn được cung cấp trên website, tờ rơi hoặc các catalogue giới thiệu phần ăn của Mini Deli để nhân viên tổng đài tiếp nhận, tiếp đó Khách hàng sẽ được tổng đài viên yêu 
cầu cung cấp các thông tin giao hàng bao gồm: Họ và tên, địa chỉ, tỉnh/ thành phố, số điện thoại, email, các yêu cầu giao hàng khác (nếu có).<br>
- Nhân viên của Mini Deli tiếp nhận đơn hàng, xác nhận đơn đặt hàng và giao hàng trong vòng 30 phút trở lên kể từ thời điểm tiếp nhận đơn hàng.
<br> <br>
<strong>* Lưu ý</strong>: Khi đặt hàng tại Hotline của Mini Deli, Khách hàng hiểu và chấp nhận các điều kiện/ lưu ý sau:<br>
 - Mini Deli chỉ tiếp nhận đơn hàng từ 09:00 sáng đến 20:00 tối.<br>
 - Mini Deli chỉ tiếp nhận đơn hàng trong bán kính 2km<br>
 - Khách hàng chỉ được hủy đơn khi món ăn chưa được hoàn thành hoặc hủy trước thời gian muốn nhận hàng là 30 phút <br>
-   Miễn phí giao hàng với hóa đơn từ 100.000đ. Đơn hàng dưới 100.000d phụ thu phí giao hàng 10.000đ/đơn

    </div>
</div>
@include('pages.elements.footer')
@include('pages.elements.script')
</body>
</html>