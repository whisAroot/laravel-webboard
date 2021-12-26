<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าเว็บบอร์ด</title>
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
</head>
<body>
    @include('components.navbar') 
        <div class="container" style="padding-top:20px">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <strong>{{Session::get('success')}}</strong> 
                        </div>
                        
                        <script>
                          $(".alert").alert();
                        </script>
                        
                    @endif


                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>เว็บบอร์ด</strong>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if (Auth::check())
                                        @if (Auth::user()->role == 'ADM')
                                            <a href="{{route('admin.createpost')}}"><button class="btn btn-primary">ตั้งกระทู้</button></a>
                                        @else
                                            <a href="{{route('user.createpost')}}"><button class="btn btn-primary">ตั้งกระทู้</button></a>
                                        @endif
                                    @else
                                        
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>หัวเรื่อง</th>
                                        <th>คนเข้าชม</th>
                                        <th>จำนวนคำตอบ</th>
                                        <th>ผู้โพสต์</th>
                                        <th></th>
                                        @if (Auth::check())
                                            @if (Auth::user()->role == 'ADM')
                                            <th></th>
                                            @else
                                            <th></th>
                                            @endif
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->view}}</td>
                                        <td>{{$post->ans}}</td>
                                        <td>{{$post->name}}</td>
                                        
                                        @if (Auth::check())
                                            @if (Auth::user()->role == 'ADM')
                                                <td><a href="{{route('admin.viewpost', ['id' => $post->id])}}">เข้าชม</a></td>
                                            @else
                                                <td><a href="{{route('user.viewpost', ['id' => $post->id])}}">เข้าชม</a></td>
                                            @endif
                                        @else
                                            <td><a href="{{route('user.viewpost', ['id' => $post->id])}}">เข้าชม</a></td>
                                        @endif
                                        @if (Auth::check())
                                            @if (Auth::user()->role == 'ADM')
                                                <td><a href="{{route('deletepost', ['id' => $post->id])}}">ลบกระทู้</a></td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="row">

            </div>
        </div>
</body>
</html>