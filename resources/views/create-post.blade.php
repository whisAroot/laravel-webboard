<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตั้งกระทู้</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet"> 
    <style>
        body, th, td{
            font-family: 'Itim', cursive;
            font-size:20px
        }
    </style>
    <!-- font end -->
    <!--tinycme-->
    <script src="https://cdn.tiny.cloud/1/4r7d8dodkqax7a64a16l2pz8buqk9wrtv6w1ors3z4m0w3ig/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    @include('components.navbar')
        <div class="container" style="padding-top: 20px">
            <div class="row">
                <div class="col-md-12">
                    @if (Auth::user()->role == 'ADM')
                        <form action="{{route('admin.storepost')}}" method="POST">
                    @else
                        <form action="{{route('user.storepost')}}" method="POST">
                    @endif
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>ตั้งกระทู้</strong>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @if (Auth::user()->role == 'ADM')
                                        <a href="{{route('admin.index')}}"><button type="button" class="btn btn-primary">กลับหน้าแรก</button></a>
                                        @else
                                        <a href="{{route('user.index')}}"><button type="button" class="btn btn-primary">กลับหน้าแรก</button></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="my-input">หัวเรื่อง</label>
                                    <input id="my-input" class="form-control" type="text" name="title">
                                    @error('title')
                                        <span class="text-danger">{{$messsage}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="my-input">รายละเอียด</label>
                                    <textarea name="detail" id="" rows="6" class="form-control"></textarea>
                                    @error('detail')
                                        <span class="text-danger">{{$messsage}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">ตั้งกระทู้</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            tinymce.init({
              selector: 'textarea',
              plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
              toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
              toolbar_mode: 'floating',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
           });
        </script>
</body>
</html>