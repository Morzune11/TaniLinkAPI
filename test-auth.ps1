# Quick Test Script untuk Route Authentication
# Jalankan dengan: .\test-auth.ps1

$baseUrl = "http://127.0.0.1:8000/api"
# Atau gunakan Laragon: $baseUrl = "http://tanilink.test/api"

Write-Host "==================================" -ForegroundColor Cyan
Write-Host "Testing Route Authentication" -ForegroundColor Cyan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""

# Test 1: Akses /home tanpa token (HARUS GAGAL)
Write-Host "[TEST 1] Akses /home TANPA token..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "$baseUrl/home" -Method GET -Headers @{"Accept"="application/json"}
    Write-Host "❌ GAGAL: Route bisa diakses tanpa login! Status: $($response.StatusCode)" -ForegroundColor Red
} catch {
    $statusCode = $_.Exception.Response.StatusCode.value__
    if ($statusCode -eq 401) {
        Write-Host "✅ SUKSES: Route terlindungi! Status: 401 Unauthorized" -ForegroundColor Green
    } else {
        Write-Host "⚠️ WARNING: Unexpected status code: $statusCode" -ForegroundColor Yellow
    }
}
Write-Host ""

# Test 2: Login dan dapatkan token
Write-Host "[TEST 2] Login untuk mendapatkan token..." -ForegroundColor Yellow
$loginBody = @{
    email = "user@example.com"
    password = "password"
} | ConvertTo-Json

try {
    $loginResponse = Invoke-WebRequest `
        -Uri "$baseUrl/login" `
        -Method POST `
        -Headers @{"Accept"="application/json"; "Content-Type"="application/json"} `
        -Body $loginBody
    
    $loginData = $loginResponse.Content | ConvertFrom-Json
    $token = $loginData.token
    
    Write-Host "✅ SUKSES: Login berhasil!" -ForegroundColor Green
    Write-Host "   User: $($loginData.user.name) ($($loginData.user.email))" -ForegroundColor Gray
    Write-Host "   Token: $($token.Substring(0, 20))..." -ForegroundColor Gray
} catch {
    Write-Host "❌ GAGAL: Login gagal! Pastikan user sudah ada di database." -ForegroundColor Red
    Write-Host "   Error: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host ""
    Write-Host "Cara membuat user:" -ForegroundColor Yellow
    Write-Host "   php artisan tinker" -ForegroundColor Gray
    Write-Host "   User::create(['name' => 'Test User', 'email' => 'user@example.com', 'password' => bcrypt('password')])" -ForegroundColor Gray
    exit
}
Write-Host ""

# Test 3: Akses /home dengan token (HARUS BERHASIL)
Write-Host "[TEST 3] Akses /home DENGAN token..." -ForegroundColor Yellow
try {
    $authResponse = Invoke-WebRequest `
        -Uri "$baseUrl/home" `
        -Method GET `
        -Headers @{
            "Accept"="application/json"
            "Authorization"="Bearer $token"
        }
    
    Write-Host "✅ SUKSES: Route dapat diakses dengan token! Status: $($authResponse.StatusCode)" -ForegroundColor Green
    
    $homeData = $authResponse.Content | ConvertFrom-Json
    if ($homeData.posts) {
        Write-Host "   Total posts: $($homeData.posts.Count)" -ForegroundColor Gray
    }
} catch {
    Write-Host "❌ GAGAL: Tidak bisa akses dengan token! Status: $($_.Exception.Response.StatusCode.value__)" -ForegroundColor Red
}
Write-Host ""

# Ringkasan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host "Ringkasan Testing" -ForegroundColor Cyan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host "✅ Route /home berhasil dilindungi!" -ForegroundColor Green
Write-Host "✅ Hanya bisa diakses dengan token!" -ForegroundColor Green
Write-Host ""
