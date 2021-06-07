<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
</head>
<body>

<div class="container">
	@include('pages.elements.header')
	<div class="cms-content">
        <div class="page-about">
            <div class="f-img" style="float: left">
                <img src="{{URL::to('/public/frontend/images/thongtin1.jpg')}}" alt="anh" width="580px" height="400px" style="margin-bottom: 20px">
                
            </div>
            <div class="f-content" style="float: right" >
                <h2 style="color: mediumorchid">About Our Food</h2>
                <address style="font-size: large">
                        Pasta là một loại thực phẩm truyền thống của nước Ý, 
                   <br> Pasta có hơn 310 loại với 1300 tên gọi, hương vị <br>và hình dạng khác nhau. 
                   đã có từ năm 1154.<br> Từ cọng dài, hình ống cho tới xoắn ốc, nơ, bướm, vỏ sò… 
                   <br>Mặc dù con số này là vô cùng lớn nhưng các loại <br> Pasta có chung thành phần
                   <br> chính là bột mì loại Semolina và nước
                </address>
            </div>
            <div class="clearfix"></div>
            <div class="f-img" style="float: right" >
                <img src="{{URL::to('/public/frontend/images/thongtin2.jpg')}}" alt="anh" width="550px" style="margin-bottom: 20px">
                
            </div>
            <div class="f-content" style="float: left" >
                <h2 style="color: mediumorchid"> Mini Deli Company</h2>
                <address style="font-size: large">
                    <strong>Địa chỉ:</strong>
                    Tòa nhà E-town
                    <br>
                    06 Cầu Cammelte, Quận 4, Thành phố Hồ Chí Minh
                    <br>
                    <strong>Tel:</strong>
                    (84-8) 5416 1072~79
                    <br>
                    <strong>Fax:</strong>
                    (84-8) 5416 1080~81
                    <br>
                    <strong>Email:</strong>
                    saranghae@gmail.com
                </address>
            </div>
        </div>
    </div>
</div>
@include('pages.elements.footer')
@include('pages.elements.script')
</body>
</html>