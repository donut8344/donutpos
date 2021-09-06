@extends('verify-user-status.master')
@section('contents')
    <div class="card card-primary m-2">
        <div class="card-header">
            <h3 class="card-title">ผลิตภัณฑ์ของเรา</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h1>ทดลองใช้ฟรี 3 เดือน</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis vero distinctio neque eaque fuga maiores illum a dicta earum odio dolor quia fugit ad voluptas voluptate corporis id, debitis quos omnis rem praesentium hic aliquid magnam consequuntur? Neque, animi voluptas.</p>
                    <ul>
                        <li>Coffee</li>
                        <li>Tea</li>
                        <li>Milk</li>
                    </ul>
                </div>
                <div class="col-4">
                    <h1>สั่งซื้อ 1 ปี (250 บาท/เดือน)</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium autem incidunt aspernatur modi, tenetur debitis esse saepe qui excepturi quas quidem voluptatibus eos ea beatae illum non, rem accusamus officiis doloribus est! Soluta quaerat dolore ducimus eligendi, magnam nobis?</p>
                    <ul>
                        <li>Coffee</li>
                        <li>Tea</li>
                        <li>Milk</li>
                    </ul>
                </div>
                <div class="col-4">
                    <h1>สั่งซื้อ 2 ปี (240 บาท/เดือน)</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus laudantium autem incidunt aspernatur modi, tenetur debitis esse saepe qui excepturi quas quidem voluptatibus eos ea beatae illum non, rem accusamus officiis doloribus est! Soluta quaerat dolore ducimus eligendi, magnam nobis?</p>
                    <ul>
                        <li>Coffee</li>
                        <li>Tea</li>
                        <li>Milk</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-4">
                    <form action="{{url('/')}}/get-demo-system" method="post">
                        @csrf
                        <input type="hidden" name="demo" value="demo">
                        <button type="submit" class="btn btn-primary">ทดลองใช้ฟรี</button>
                    </form>
                </div>
                <div class="col-4">
                    <a href="{{url('/')}}/payment-system" class="btn btn-primary">สั่งซื้อ 3,000 บาท</a>
                </div>
                <div class="col-4">
                    <a href="{{url('/')}}/payment-system" class="btn btn-primary">สั่งซื้อ 5,760</a>
                </div>
            </div>
        </div>
    </div>
@endsection()