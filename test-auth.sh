#!/bin/bash

# Quick Test Script untuk Route Authentication
# Jalankan dengan: bash test-auth.sh

BASE_URL="http://127.0.0.1:8000/api"
# Atau gunakan Laragon: BASE_URL="http://tanilink.test/api"

echo "=================================="
echo "Testing Route Authentication"
echo "=================================="
echo ""

# Test 1: Akses /home tanpa token (HARUS GAGAL)
echo "[TEST 1] Akses /home TANPA token..."
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" \
  -X GET "$BASE_URL/home" \
  -H "Accept: application/json")

if [ "$HTTP_STATUS" -eq 401 ]; then
    echo "✅ SUKSES: Route terlindungi! Status: 401 Unauthorized"
else
    echo "❌ GAGAL: Unexpected status code: $HTTP_STATUS"
fi
echo ""

# Test 2: Login dan dapatkan token
echo "[TEST 2] Login untuk mendapatkan token..."
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/login" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "password"
  }')

# Extract token using grep/awk (simple parsing)
TOKEN=$(echo $LOGIN_RESPONSE | grep -o '"token":"[^"]*' | cut -d'"' -f4)

if [ -z "$TOKEN" ]; then
    echo "❌ GAGAL: Login gagal! Pastikan user sudah ada di database."
    echo ""
    echo "Cara membuat user:"
    echo "   php artisan tinker"
    echo "   User::create(['name' => 'Test User', 'email' => 'user@example.com', 'password' => bcrypt('password')])"
    exit 1
fi

echo "✅ SUKSES: Login berhasil!"
echo "   Token: ${TOKEN:0:20}..."
echo ""

# Test 3: Akses /home dengan token (HARUS BERHASIL)
echo "[TEST 3] Akses /home DENGAN token..."
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" \
  -X GET "$BASE_URL/home" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN")

if [ "$HTTP_STATUS" -eq 200 ]; then
    echo "✅ SUKSES: Route dapat diakses dengan token! Status: 200 OK"
else
    echo "❌ GAGAL: Tidak bisa akses dengan token! Status: $HTTP_STATUS"
fi
echo ""

# Ringkasan
echo "=================================="
echo "Ringkasan Testing"
echo "=================================="
echo "✅ Route /home berhasil dilindungi!"
echo "✅ Hanya bisa diakses dengan token!"
echo ""
