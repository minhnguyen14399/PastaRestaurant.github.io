<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
    <style>
           .location{
             width: 50%;
             float: left;
             padding: auto;
             font-size: large;
             margin-bottom: 20px;
           } 
           .line{
             width: 100%;
             height: 20px;
             background-color: #ff9933;
           }
    </style>
    <script>
      
    </script>
</head>
<body>

<div class="container">
	@include('pages.elements.header')
    <div class="section">
      <div class="line"></div>
      <h1 style="text-align: center">Hệ thống cửa hàng</h1>
      <div class="location">
        <h3 style="color: #ff9933" >Quận 1</h3>
        <strong>Cửa hàng:</strong> Đinh Tiên Hoàng
        <br>
        <strong>Địa chỉ:</strong> 52 Đinh Tiên Hoàng, ĐA Kao, Q.1
        <br>
        <strong>Điện thoại:</strong>  0901822569
        <br>
        <a href="https://www.google.com/maps" style="text-decoration: none" target="blanke"> Xem bản đồ</a>
      </div>
      <div class="location">
        <h3 style="color: #ff9933">Quận 3</h3>
        <strong>Cửa hàng:</strong>Nguyễn Thị Minh Khai
        <br>
        <strong>Địa chỉ:</strong> 538 Nguyễn Thị Minh Khai, P.2, Q.3
        <br>
        <strong>Điện thoại:</strong> 0901833569
        <br>
        <a href="https://www.google.com/maps" style="text-decoration: none" target="blanke"> Xem bản đồ</a>
      </div>
      <div class="location">
        <h3 style="color: #ff9933">Quận 5</h3>
        <strong>Cửa hàng:</strong> An Dương Vương
        <br>
        <strong>Địa chỉ:</strong> 301B An Dương Vương, P.3, Q.5
        <br>
        <strong>Điện thoại:</strong> 0901829569
        <br>
        <a href="https://www.google.com/maps" style="text-decoration: none" target="blanke"> Xem bản đồ</a>
      </div>
      <div class="location">
        <h3 style="color: #ff9933">Quận 7</h3>
        <strong>Cửa hàng:</strong> 524 Nguyễn Thị Thập
        <br>
        <strong>Địa chỉ:</strong> 524 Nguyễn Thị Thập, Phường Tân Hưng, Quận 7
        <br>
        <strong>Điện thoại:</strong> 0901259569
        <br>
        <a href="https://www.google.com/maps" style="text-decoration: none" target="blanke"> Xem bản đồ</a>
        <br>
        <strong>Cửa hàng:</strong> 223 Nguyễn Thị Thập
        <br>
        <strong>Địa chỉ:</strong> 223 Nguyễn Thị Thập, Phường Tân Phú, Quận 7
        <br>
        <strong>Điện thoại:</strong> 0909225223 
        <br>
        <a href="https://www.google.com/maps" style="text-decoration: none" target="blanke"> Xem bản đồ</a>
      </div>


    </div>
</div>
@include('pages.elements.footer')
@include('pages.elements.script')
</body>
</html>