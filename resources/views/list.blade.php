<!DOCTYPE html>
<html>

<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Live Search</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Products info </h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" class="form-controller" id="search" name="search"></input>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th colspan="2">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products)
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td> <img width="100px" src="{{$product->thumbnail_url}}"></td>
                                @if($product->status == 0)
                                <td>
                                    <a href="{{route('product.updateStatus',['id'=>$product->id,'status'=>1])}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                </td>
                                @else
                                <td>
                                    <a href="{{route('product.updateStatus',['id'=>$product->id,'status'=>0])}}" class="btn btn-warning"><i class="fa-solid fa-eye-slash"></i></a>
                                </td>
                                @endif
                                <td>
                                    <a class="btn btn-success" href="{{route('product.edit',['product' => $product->id])}}">
                                        Edit
                                    </a>
                                    <a href="{{route('product.delete',['product' => $product->id])}}" class="btn btn-danger btnDelete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <form action="" method="POST" id="form-delete">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
        {{$products->links()}}
    </div>
    <script type="text/javascript">
        $('.btnDelete').click(function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            $('#form-delete').attr('action', href);
            if (confirm('Are you sure?')) {
                $('#form-delete').submit();
            }
        })
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/product/search',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
</body>

</html>