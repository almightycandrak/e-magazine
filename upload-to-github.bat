@echo off
echo ========================================
echo UPLOAD E-MAGAZINE PROJECT TO GITHUB
echo ========================================
echo.
echo Pastikan Anda sudah:
echo 1. Membuat repository baru di GitHub
echo 2. Mendapatkan URL repository
echo.
set /p repo_url="Masukkan URL repository GitHub (contoh: https://github.com/username/repo-name.git): "
echo.
echo Menghubungkan dengan repository GitHub...
git remote add origin %repo_url%
echo.
echo Mengupload ke GitHub...
git push -u origin main
echo.
echo Upload selesai! Cek repository Anda di GitHub.
pause