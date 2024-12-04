<!DOCTYPE html>
<html lang="@lang('admin.lang')" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @lang('admin.home') | {{ config('admin.Admin_Title') }} </title> 

    
    <!---Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!---- Jquery dosyası çekme--->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="{{asset('/js')}}/table.js"></script>

    <!---- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/bootstrap')}}/css/bootstrap.min.css" />

    <!---- Bootstrap Js -->
    <script src="{{asset('/bootstrap')}}/js/bootstrap.bundle.min.js"></script> 
    <script src="{{asset('/bootstrap')}}/js/bootstrap.min.js"></script> 
    <script src="{{asset('/bootstrap')}}/js/bootstrap-select.min.js"></script> 
    <script src="{{asset('/bootstrap')}}/js/bootstrap.js"></script> 


</head>
<body>

    <div class="container">
        <h1> Müşteri Bilgileri</h1>

        <p> Email: {{$yildirimdev_email}}  </p>
        <hr>

        
        @if(session('status_import') == "succes")
            <div class="alert alert-success " role="alert"> {{session('msg')}}  </div>
        @elseif(session('status_import') == "error")
            <div class="alert alert-danger " role="alert"> {{session('msg')}}  </div>
        @endif

        <div  style="display: flex;justify-content: space-between;" >

            @if($yildirimdev_roleID == "1")
            <div style="display: flex;gap: 10px;" >
                <button class="btn btn-success">Ekle</button>
                
                <div style="border: 1px solid;padding: 10px;">
                    <p>Excel Veri Okuma</p>
                    <form action="{{route('import.post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="file">
                        <button class="btn btn-info" type="submit">Excel Veri Ekle</button>
                    </form>
                </div>

            </div>
            @endif
          
            <a href="/@lang('admin.lang')/login"> <button class="btn btn-danger" >Cıkış Yap</button></a>
        </div>

        <br><hr>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Adı</th>
                    <th>Soyadı</th>
                    <th>Email</th>
                    <th>Firma</th>
                    <th>Oluşturma Tarihi</th>
                </tr>
            </thead>
            <tbody>

                @for ($i = 0; $i < count($dbCustomer); $i++)
                <tr>
                    <td>{{$dbCustomer[$i]->name}}</td>
                    <td>{{$dbCustomer[$i]->surname}}</td>
                    <td>{{$dbCustomer[$i]->email}}</td>
                    <td>{{$dbCustomer[$i]->company}}</td>
                    <td>{{$dbCustomer[$i]->created_at}}</td>
                </tr>
                @endfor
              
            </tbody>
            <tfoot>
                <tr>
                    <th>Adı</th>
                    <th>Soyadı</th>
                    <th>Email</th>
                    <th>Firma</th>
                </tr>
            </tfoot>
        </table>
    </div>

    
</body>
</html>