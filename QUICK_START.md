# 🔒 Route Authentication - Quick Start Guide

## 📁 File-file yang Telah Dibuat

Saya telah membuat beberapa file untuk membantu Anda testing:

1. **README_TESTING_AUTH.md** - Dokumentasi lengkap cara testing
2. **test-auth.ps1** - Script otomatis testing (PowerShell)
3. **test-auth.sh** - Script otomatis testing (Bash/Git Bash)
4. **create-test-user.ps1** - Script untuk membuat user test

## 🚀 Langkah Cepat Testing

### Langkah 1: Buat Test User (Jika Belum Ada)

```powershell
.\create-test-user.ps1
```

Atau manual via artisan tinker:
```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Test User',
    'email' => 'user@example.com',
    'password' => bcrypt('password'),
    'avatar' => 'default-avatar.png'
]);
```

### Langkah 2: Clear Cache

```bash
php artisan config:clear
php artisan route:clear
```

### Langkah 3: Jalankan Testing

**Opsi A: Menggunakan Script Otomatis (PowerShell)**
```powershell
.\test-auth.ps1
```

**Opsi B: Menggunakan Script Otomatis (Bash/Git Bash)**
```bash
bash test-auth.sh
```

**Opsi C: Manual Testing dengan Postman (Lihat README_TESTING_AUTH.md)**

## ✅ Hasil yang Diharapkan

Setelah testing, Anda akan melihat:

```
[TEST 1] Akses /home TANPA token...
✅ SUKSES: Route terlindungi! Status: 401 Unauthorized

[TEST 2] Login untuk mendapatkan token...
✅ SUKSES: Login berhasil!
   User: Test User (user@example.com)
   Token: 1|abcdefghijklmn...

[TEST 3] Akses /home DENGAN token...
✅ SUKSES: Route dapat diakses dengan token! Status: 200
```

## 🔧 Perubahan yang Telah Dilakukan

### 1. Route api.php
```php
// SEBELUM (bisa diakses tanpa login)
Route::get('/home', [HomeController::class, 'index']);

// SESUDAH (harus login)
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth:sanctum');
```

### 2. Bootstrap app.php
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->api(prepend: [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        \App\Http\Middleware\ForceJsonResponse::class,
    ]);
})
```

### 3. Config sanctum.php
```php
// Stateful domains dikosongkan untuk force token-based auth
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', '')),
```

## 📊 Endpoint yang Dilindungi

Sekarang endpoint berikut **TIDAK DAPAT DIAKSES** tanpa login:

- ✅ `GET /api/home` - Get all posts
- ✅ `POST /api/posts` - Create post  
- ✅ `GET /api/posts/{id}` - Get single post
- ✅ `PUT /api/posts/{id}` - Update post
- ✅ `DELETE /api/posts/{id}` - Delete post
- ✅ `POST /api/comments` - Create comment
- ✅ `POST /api/likes/toggle` - Toggle like
- ✅ `GET /api/friends` - Get friends
- ✅ `POST /api/messages` - Send message
- Dan semua endpoint protected lainnya...

## 🔓 Endpoint yang Tetap Bisa Diakses Tanpa Login

- `POST /api/register` - Register user baru
- `POST /api/login` - Login
- `GET /api/ping` - Health check

## 📖 Dokumentasi Lengkap

Untuk dokumentasi lengkap dengan berbagai cara testing (Browser, Postman, curl, PowerShell), lihat:

👉 **[README_TESTING_AUTH.md](./README_TESTING_AUTH.md)**

---

## 🎯 Selamat! Route /home Sekarang Aman! 🎉

Route `/home` dan semua protected routes lainnya sekarang **HANYA BISA DIAKSES** setelah user melakukan login dan menyertakan Bearer token.
