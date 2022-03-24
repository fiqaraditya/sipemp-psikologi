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
                <p> Yth Bapak/Ibu,</p> <br>
                <p style="width:1000px;">Dimohon untuk mengisi formulir rekomendasi yang diajukan oleh calon mahasiswa
                    <br>
                    Nama Lengkap : {{$details['name']}} <br>
                    Nomor Pendaftaran : {{$details['no_pendaftaran']}} <br> <br>
                    sebagai salah satu persyaratan proses seleksi di Program Studi Psikologi Profesi Fakultas Psikologi Universitas Indonesia. <br><br>
                    Formulir dapat diakses <a href="{{route('page_rekomendasi')}}">disini</a> atau dapat melalui link di bawah.
                    Kami menghargai waktu yang Ibu/Bapak berikan untuk mengisi formulir rekomendasi.<br>
                    Mohon untuk menyadari bahwa batas waktu pengisian rekomendasi online ini adalah pada hari Jumat, 25 Maret 2022<br>
                    pukul 24.00WIB.
                </p>
                <hr>

                <p> Dear Sirs/Madams,</p> <br>
                <p style="width:1000px;">Please fill out the recommendation form filed by <br>
                    Student Name :  {{$details['name']}} <br>
                    Registration ID : {{$details['no_pendaftaran']}} <br> <br>

                    as one of the requirements for the selection process at the Program Studi Psikologi Profesi Fakultas Psikologi Universitas Indonesia. <br><br>
                    The form can be accessed through this <a href="{{route('page_rekomendasi')}}"> link</a> or by clicking the link below.
                    We appreciate your time to fill out the recommendation form. <br>
                    Please be aware that the deadline for filling out this online recommendation is on Jumat, 25 Maret 2022, at 00.00 West Indonesian Time/GMT+7 </p> <br>


                {{-- <div style="
                    background-color:#3772FF;
                    border-radius:50px;
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    align-items: center;
                    padding: 20px 0px;
                    color:white;
                    position: absolute;
                    width: 300px; height: 10px; font-size:16px"> --}}
                <button type="button" style="align-self: center">
                    <a href="{{route('page_rekomendasi')}}">Formulir Rekomendasi / Recommendation Form</a>
                </button>
                {{-- </div> --}}
            </div>
        </div>
        </div>
</body>

</html>
