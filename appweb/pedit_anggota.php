<?php
	require_once 'dbconnect.php';
	
	// buat prepared statements
	$stmt = $con->prepare("UPDATE list_anggota SET nama=?, jurusan=?, email=? WHERE id_anggota=?");

	// hubungkan "data" dengan prepared statements
	$stmt->bind_param("sssi",$nama,$jurusan,$email,$id_anggota);

	//reciever
	if (isset($_POST['id_anggota']) AND isset($_POST['nama'])) {
		
		$id_anggota=$_POST['id_anggota'];
		$nama=$_POST['nama'];
		$jurusan=$_POST['jurusan'];
		$email=$_POST['email'];
		$nama=htmlspecialchars($nama);
		$jurusan=htmlspecialchars($jurusan);
		$email=strip_tags($email);
	
	} else {
		
		?>
			<script>
				alert ("Maaf, variabel belum di set");
				window.location.href="view_anggota.php";
			</script>
			<?php
	
	} if(empty($id_anggota)) {
		
		?>
			<script>
				alert ("Maaf, ID Anggota belum diisi");
				window.location.href="view_anggota.php";
			</script>
		<?php
		die();

	} else if(empty($nama)) {

		?>
			<script>
				alert ("Maaf, nama belum diisi");
				window.location.href="view_anggota.php";
			</script>
		<?php
		die();

	} else if (empty($jurusan)) {
		
		?>
			<script>
				alert ("Maaf, jurusan belum diisi");
				window.location.href="view_anggota.php";
			</script>
		<?php
		die();

	} else if(empty($email)) {

		?>
			<script>
				alert ("Maaf, email belum diisi");
				window.location.href="view_anggota.php";
			</script>
		<?php
		die();

	} else {
		
		if (is_numeric($nama)) {
			?>
				<script>
					alert ("Maaf, nama harus berupa huruf");
					window.location.href="view_anggota.php";
				</script>
			<?php
			die();
		
		} else if(is_numeric($jurusan)) {
			
			?>
				<script>
					alert ("Maaf, jurusan harus berupa huruf");
					window.location.href="view_anggota.php";
				</script>
			<?php
			die();

		}
	}

	// jalankan query 1
	$stmt->execute();
	
	/*//koneksi tabel
	$result=$con->query("UPDATE list_anggota SET nama='$nama',jurusan='$jurusan',email='$email' WHERE id_anggota='$id_anggota'");*/

	// cek query 1
	if (!$stmt) {
		?>
		<script>
			alert ("Data Tidak Berhasil Diedit");
			window.location.href="view_anggota.php";
		</script>
		<?php
	} else {
		?>
		<script>
			alert ("Data Berhasil Diedit");
			window.location.href="view_anggota.php";
		</script>
		<?php
	}
?>