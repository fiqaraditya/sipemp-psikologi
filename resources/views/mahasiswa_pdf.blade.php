<!DOCTYPE html>
<html>
<head>
	<title>List Calon Mahasiswa SIPeMP Psikologi UI</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Nomor Pendaftaran</th>
				<th>Profesi Peminatan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($calonmahasiswa as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->name}}</td>
				<td>{{$p->email}}</td>
				<td>{{$p->no_pendaftaran}}</td>
				<td>{{$p->profesi}}</td>
				<td>{{$p->status_penerimaan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>