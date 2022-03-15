@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <div class="row">
            <h1 style="margin-bottom: 1%">Daftar Pengumuman</h1>
            <br>
            <button type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;">Buat Pengumuman</button>

            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/ava.png" width="100" height="100">
                        </div>
                        <div class="col-9">
                            <h3>Judul Pengumuman</h3>
                            <h5>by Author - Day, DD MM YYYY, AA.BB AM/PM </h5>
                        </div>
                        <div class="col-1">
                            <h4 style="font-weight: normal">Ubah</h4>
                        </div>
                        <div class="col-1">
                            <h4 style="font-weight: normal">Hapus</h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h5 style="font-weight: normal">Contrary to popular belief, Lorem Ipsum is not simply random text.
                            It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                            Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of
                            the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the
                            cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes
                            from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and
                            Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular
                            during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
                            from a line in section 1.10.32.
                            <br>
                            <br>
                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                            Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced
                            in their exact original form, accompanied by English versions from the 1914 translation by H.
                            Rackham.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
