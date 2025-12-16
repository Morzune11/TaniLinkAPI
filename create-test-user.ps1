# Script untuk membuat user test
# Jalankan dengan: .\create-test-user.ps1

Write-Host "==================================" -ForegroundColor Cyan
Write-Host "Membuat Test User" -ForegroundColor Cyan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""

# Buat script PHP untuk dijalankan via artisan tinker
$phpScript = @"
`$user = \App\Models\User::where('email', 'user@example.com')->first();
if (`$user) {
    echo "User sudah ada:\n";
    echo "  Name: " . `$user->name . "\n";
    echo "  Email: " . `$user->email . "\n";
} else {
    `$newUser = \App\Models\User::create([
        'name' => 'Test User',
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
        'avatar' => 'default-avatar.png',
        'bio' => 'Test user for authentication testing'
    ]);
    echo "User berhasil dibuat:\n";
    echo "  Name: " . `$newUser->name . "\n";
    echo "  Email: " . `$newUser->email . "\n";
    echo "  Password: password\n";
}
"@

# Simpan ke file temporary
$tempFile = [System.IO.Path]::GetTempFileName() + ".php"
$phpScript | Out-File -FilePath $tempFile -Encoding UTF8

Write-Host "Membuat test user..." -ForegroundColor Yellow
Write-Host ""

# Jalankan via artisan tinker
php artisan tinker < $tempFile

# Hapus file temporary
Remove-Item $tempFile

Write-Host ""
Write-Host "==================================" -ForegroundColor Cyan
Write-Host "Selesai!" -ForegroundColor Green
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Credentials untuk testing:" -ForegroundColor Yellow
Write-Host "  Email: user@example.com" -ForegroundColor White
Write-Host "  Password: password" -ForegroundColor White
Write-Host ""
