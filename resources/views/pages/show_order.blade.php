@extends('layout')
@section('content')   

<section id="cart_items">
		<div class="container clearfix">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Đơn hàng của bạn</li>
				</ol>
			</div>
            <?php
				use Illuminate\Support\Facades\Session;
				$message = Session::get('message');
				if ($message) {
					echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
					Session::put('message', null);
				}
			?>
		<div class="col-sm-10 clearfix">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td>STT</td>
							<td class="description">Mã đơn hàng</td>
							<td class="price">Ngày đặt hàng</td>
							<td class="quantity">Tình trạng đơn hàng</td>
							<td class="total"></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach($order as $key => $ord)
                    <?php
                    $i++;
                    ?>
                    <tr>
                        <td><i>{{$i}}</i></td>
                        <td>{{ $ord->order_code }}</td>
                        <td>{{ $ord->created_at }}</td>
                        <td>
                            <?php
                                if ($ord->order_status == 1) {
                                    echo 'Đang chờ xác nhận';
                                } elseif ($ord->order_status == 2) {
                                    echo 'Đã xác nhận';
                                } elseif ($ord->order_status == 3) {
                                    echo 'Đã chế biến xong';
                                } elseif ($ord->order_status == 4) {
                                    echo 'Đã hoàn thành';
                                } elseif ($ord->order_status == 0) {
                                    echo 'Đã hủy';
                                }
                            ?>
                        </td>
                        <td>
                        @if($ord->order_status == 1 || $ord->order_status == 2)
                        <form role="form" action="{{URL::to('/del-order/'.$ord->order_code)}}" method="post">
                        {{ csrf_field() }}
                            <input type="hidden" name="order_status" value="0"/>
                            <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" type="submit" name="del-order" class="btn btn-danger">Hủy đơn</button>
                        </form>
                        @elseif($ord->order_status == 0)
                            Đơn hàng đã hủy
                        @else
                            Đơn hàng không thể hủy
                        @endif
                        </td>
                    </tr>
                    @endforeach
					</tbody>
				</table>
			</div>
		</div>
		</div>
</section> <!--/#cart_items-->

@endsection
