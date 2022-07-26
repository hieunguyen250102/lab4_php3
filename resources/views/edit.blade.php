<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <form action="{{route('product.update',$product->id)}}" method="POST">
        @csrf()
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input value="{{$product->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input value="{{$product->price}}" type="number" name="price" class="form-control" id="exampleInputPassword1" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input value="{{$product->thumbnail_url}}" type="text" name="thumbnail_url" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <div class="form-check form-check-inline">
                <input <?php echo ($product->status === 0) ? 'checked' : '' ?> name="status" class="form-check-input" type="radio" id="inlineCheckbox1" value="0">
                <label class="form-check-label" for="inlineCheckbox1">Show</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php echo ($product->status === 1) ? 'checked' : '' ?> name="status" class="form-check-input" type="radio" id="inlineCheckbox2" value="1">
                <label class="form-check-label" for="inlineCheckbox2">Off</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>