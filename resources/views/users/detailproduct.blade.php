@extends('users.layouts.default')

@push('styles')
    <style>
        .main-image {
            width: 100%;
            max-height: 500px; /* Đặt chiều cao tối đa nếu cần */
            object-fit: cover;
        }
        .second-image {
            width: 100px; /* Đặt kích thước phù hợp */
            height: 100px;
            object-fit: cover;
            cursor: pointer; /* Thay đổi con trỏ khi hover để chỉ rõ rằng ảnh có thể được nhấp */
        }
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endpush

@section('content')
    <div class="mb-n10 mb-10 z-index-2">
        <div class="container mb-10">
            <div class="text-center mb-17">
                <h3 class="fs-2hx text-gray-900 mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
                    Thông tin sản phẩm
                </h3>
            </div>
            <div class="row w-100 gy-10 mb-md-20 d-flex">
                <div class="col-xl-2 p-4">
                    <img id="mainImage" src="{{ asset($product->images[0]->image_url) }}" alt="Main Image" class="main-image">
                    <hr>
                    <div class="image-gallery">
                        @foreach($product->images as $value)
                            <img src="{{ asset($value->image_url) }}" alt="Thumbnail" class="second-image" onclick="changeImage('{{ asset($value->image_url) }}')">
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-9">
                    <p>Tên sản phẩm: {{ $product->name }}</p>
                    <p>Giá sản phẩm: {{ number_format($product->price) }} VNĐ</p>
                    <p>Mô tả sản phẩm: {{ $product->description }}</p>
                    <p>Danh mục: {{ $product->category->name }}</p>

                    <form action="{{ route('users.addToCart') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2"> <!-- Thêm class để điều chỉnh kiểu -->
                        <button class="btn btn-success">Mua hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function changeImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>
@endpush
