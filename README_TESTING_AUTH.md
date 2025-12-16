# Testing Route Authentication - TaniLink Backend API

## 📋 Deskripsi
Dokumen ini berisi langkah-langkah untuk menguji bahwa route `/home` **TIDAK DAPAT DIAKSES** tanpa login terlebih dahulu.

## 🔧 Persiapan

### 1. Pastikan Database Sudah Setup
```bash
# Jalankan migration
php artisan migrate

# (Opsional) Jalankan seeder untuk data testing
php artisan db:seed
```

### 2. Clear Cache (PENTING!)
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### 3. Jalankan Server
Pilih salah satu:

**Opsi A: Menggunakan Laragon**
- Pastikan Laragon sudah running
- URL: `http://tanilink.test/api` atau `http://localhost/TaniLink/Backend/public/api`

**Opsi B: Menggunakan PHP Artisan Serve**
```bash
php artisan serve
```
- URL: `http://127.0.0.1:8000/api`

---

## 🧪 Skenario Testing

### Test 1: Akses `/home` TANPA Login (Harus GAGAL ❌)

#### Menggunakan Browser
1. Buka browser
2. Akses URL: `http://127.0.0.1:8000/api/home` (sesuaikan dengan server Anda)
3. **Hasil yang diharapkan**: 
   - Status: `401 Unauthorized`
   - Response JSON:
   ```json
   {
       "message": "Unauthenticated."
   }
   ```

#### Menggunakan Postman
1. Buka Postman
2. Buat request baru:
   - Method: `GET`
   - URL: `http://127.0.0.1:8000/api/home`
   - Headers: 
     - `Accept`: `application/json`
3. Klik **Send**
4. **Hasil yang diharapkan**: Status `401 Unauthorized`

#### Menggunakan PowerShell
```powershell
# Test dan tampilkan status code
try { 
    Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/home" -Method GET -Headers @{"Accept"="application/json"} 
} catch { 
    Write-Host "Status Code: $($_.Exception.Response.StatusCode.value__)"
    Write-Host "Message: Tidak dapat akses tanpa login!"
}
```

#### Menggunakan Git Bash / WSL (curl)
```bash
curl -X GET http://127.0.0.1:8000/api/home \
  -H "Accept: application/json" \
  -v
```

**Hasil yang diharapkan**: 
```
< HTTP/1.1 401 Unauthorized
{"message":"Unauthenticated."}
```

---

### Test 2: Login dan Dapatkan Token ✅

#### Menggunakan Postman
1. Buat request baru:
   - Method: `POST`
   - URL: `http://127.0.0.1:8000/api/login`
   - Headers:
     - `Accept`: `application/json`
     - `Content-Type`: `application/json`
   - Body (raw JSON):
   ```json
   {
       "email": "user@example.com",
       "password": "password"
   }
   ```
2. Klik **Send**
3. **Copy token** dari response

**Response yang diharapkan:**
```json
{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "User Name",
        "email": "user@example.com"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz1234567890"
}
```

#### Menggunakan PowerShell
```powershell
$body = @{
    email = "user@example.com"
    password = "password"
} | ConvertTo-Json

$response = Invoke-WebRequest `
  -Uri "http://127.0.0.1:8000/api/login" `
  -Method POST `
  -Headers @{"Accept"="application/json"; "Content-Type"="application/json"} `
  -Body $body

$responseData = $response.Content | ConvertFrom-Json
$token = $responseData.token
Write-Host "Token: $token"
```

#### Menggunakan Git Bash / WSL (curl)
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "password"
  }'
```

---

### Test 3: Akses `/home` DENGAN Token (Harus BERHASIL ✅)

#### Menggunakan Postman
1. Buat request baru:
   - Method: `GET`
   - URL: `http://127.0.0.1:8000/api/home`
   - Headers:
     - `Accept`: `application/json`
     - `Authorization`: `Bearer {TOKEN_DARI_LOGIN}`
2. Klik **Send**
3. **Hasil yang diharapkan**: Status `200 OK` dengan data posts

**Response yang diharapkan:**
```json
{
    "success": true,
    "posts": [...]
}
```

#### Menggunakan PowerShell
```powershell
# Ganti {TOKEN} dengan token yang didapat dari login
$token = "1|abcdefghijklmnopqrstuvwxyz1234567890"

$response = Invoke-WebRequest `
  -Uri "http://127.0.0.1:8000/api/home" `
  -Method GET `
  -Headers @{
    "Accept"="application/json"
    "Authorization"="Bearer $token"
  }

$response.Content
```

#### Menggunakan Git Bash / WSL (curl)
```bash
# Ganti {TOKEN} dengan token yang didapat dari login
TOKEN="1|abcdefghijklmnopqrstuvwxyz1234567890"

curl -X GET http://127.0.0.1:8000/api/home \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -v
```

**Hasil yang diharapkan:**
```
< HTTP/1.1 200 OK
{"success":true,"posts":[...]}
```

---

## 📊 Ringkasan Testing

| Test Case | Endpoint | Auth | Expected Result |
|-----------|----------|------|-----------------|
| 1 | `GET /api/home` | ❌ Tanpa Token | `401 Unauthorized` |
| 2 | `POST /api/login` | ❌ Email + Password | `200 OK` + Token |
| 3 | `GET /api/home` | ✅ Dengan Token | `200 OK` + Data Posts |

---

## 🔐 Catatan Keamanan

1. **Token Storage**: Di production, token harus disimpan dengan aman (misalnya di localStorage atau secure cookie)
2. **Token Expiration**: Token bisa diatur expiration time di `config/sanctum.php`
3. **HTTPS**: Di production, gunakan HTTPS untuk melindungi token saat transfer

---

## ❓ Troubleshooting

### Error: "Route [login] not defined"
- Pastikan route `/api/login` sudah terdaftar di `routes/api.php`
- Jalankan `php artisan route:clear`

### Error: 404 Not Found
- Pastikan URL sudah benar (termasuk prefix `/api`)
- Cek `php artisan route:list` untuk melihat route yang terdaftar

### Error: Token tidak bekerja
- Pastikan format header: `Authorization: Bearer {token}`
- Pastikan ada spasi setelah "Bearer"
- Pastikan token di-copy dengan benar (tidak ada spasi di awal/akhir)

### Error: CORS
- Jalankan: `php artisan config:clear`
- Pastikan middleware `ForceJsonResponse` sudah terpasang

---

## 🎯 Endpoint Lain yang Dilindungi

Selain `/home`, endpoint berikut juga memerlukan autentikasi:

- `POST /api/posts` - Create post
- `GET /api/posts/{id}` - Get single post
- `PUT /api/posts/{id}` - Update post
- `DELETE /api/posts/{id}` - Delete post
- `GET /api/posts/{postId}/comments` - Get comments
- `POST /api/comments` - Create comment
- `DELETE /api/comments/{id}` - Delete comment
- `POST /api/likes/toggle` - Toggle like
- `GET /api/posts/{postId}/likes` - Get likes
- `PUT /api/profile` - Update profile
- `GET /api/friends` - Get friends
- `POST /api/friends/request` - Send friend request
- `GET /api/conversations` - Get conversations
- `POST /api/messages` - Send message

Semua endpoint di atas **HARUS** menggunakan `Authorization: Bearer {token}` header!

---

## ✅ Verifikasi Sukses

Jika testing berhasil, Anda akan melihat:
1. ❌ Akses `/home` tanpa token → **401 Unauthorized**
2. ✅ Login → **200 OK** dengan token
3. ✅ Akses `/home` dengan token → **200 OK** dengan data

**Route `/home` sekarang AMAN dan hanya bisa diakses setelah login!** 🎉
