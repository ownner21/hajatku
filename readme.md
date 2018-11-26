<h5> Hajatku </h5>

Diajukan untuk memenuhi tugas akhir semester Pertama PJJ Ak 2018


<p>Cara Clone</p>
<ol>
	<li>git clone https://github.com/ownner21/hajatku.git</li>
	<li>cd hajatku</li>
	<li>composer install</li>
	<li>"copy semua sintax .env.example dengan nama file baru bernama .env "</li>
	<li>"Buat database baru"</li>
	<li>"lakukan konfigurasi koneksi di .env (mengatur koneksi database)"</li>
	<li>php artisan key:generate</li>
	<li>php artisan migrate</li>
</ol>
<br>
<p>Cara membuat akun admin</p>

Masuk CMD pada folder aplikasi hajatku. <br>

ketik "php artisan tinker" <br>

ketik :<br>

App\Models\Admin::create(['email'=>'admin@admin.com', 'password'=>bcrypt(121212)]) <br>

Atau <br>

App\Models\Admin::create(['email'=>'admin@admin.com', 'password'=>bcrypt("passwordString")])

