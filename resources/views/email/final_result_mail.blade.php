<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <div style="margin-top:3%; margin-bottom:5%">
        <div style="margin-top:2%">
        <div style="width:1200px;font-family: 'Helvetica';">
            {{-- <div href="#" style="margin-left: 50px"> <img src="img/logo.png" alt=5 width="205px" height="82px"> </div> --}}
            <div style="padding:50px">
                <p> Yth Saudara/i, {{$details['name']}}</p> <br>
                <p style="width:1000px;">
                    <br>
                    Nama Lengkap : {{$details['name']}} <br>
                    Nomor Pendaftaran : {{$details['no_pendaftaran']}} <br>
                    Status : {{$details['status']}} <br><br>
                </p>
                <hr>

                <p> Dear Sirs/Madams,</p> <br>
                <p style="width:1000px;">
                    Student Name :  {{$details['name']}} <br>
                    Registration ID : {{$details['no_pendaftaran']}} <br>
                    Status : {{$details['status']}} <br><br>
            </div>
        </div>
    </div>
</body>

</html>
