# Secure Coding Exam Lab (PHP)

Project ini merupakan **lab tugas Secure Programming** untuk menganalisis, mengeksploitasi, dan memperbaiki kerentanan keamanan pada aplikasi web berbasis PHP.  
Repositori ini berisi kode awal yang rentan serta perbaikan yang dilakukan sesuai rekomendasi keamanan standar (OWASP Top 10).

---

## 📌 Kode Awal (Vulnerable)

Pada versi awal aplikasi, terdapat berbagai kerentanan keamanan serius, antara lain:
- **SQL Injection** pada `login.php`, `wiki.php`, `profile.php`
- **Command Injection** pada `ping.php`
- **Insecure Deserialization** melalui cookie `profile`
- **Stored XSS** pada `comment.php`
- **Reflected XSS & DoS** pada `crash.php`
- **Plaintext password** di database (`init.php`)
- **Tanpa CSRF token** pada form penting

Contoh tampilan (kode sebelum perbaikan):

<img width="1919" height="871" alt="image" src="https://github.com/user-attachments/assets/c9aef585-b4fa-4230-b505-5ac37a4fd503" />

---

## 🔧 Setelah Perbaikan

Perbaikan dilakukan dengan pendekatan **secure coding best practices**:
- Mengganti query langsung dengan **Prepared Statements**
- Melakukan **validasi input** & **output sanitization**
- Menghapus penggunaan `serialize/unserialize` → ganti dengan **session server-side**
- Menggunakan **`htmlspecialchars`** untuk mencegah XSS
- Menambahkan **CSRF Token** untuk form penting
- Menggunakan **`escapeshellarg`** + validasi IP/hostname pada `ping.php`
- Hashing password dengan **`password_hash`** dan verifikasi dengan **`password_verify`**
- Menambahkan proteksi session (`httponly`, `samesite`)

Contoh tampilan setelah perbaikan:

<img width="1919" height="785" alt="image" src="https://github.com/user-attachments/assets/ff332d37-3ae6-4c0d-8c8f-879a38c4c719" />

---

## ✅ Hasil

Setelah perbaikan:
- Eksploitasi kerentanan (SQLi, XSS, Command Injection, Object Injection) **tidak lagi berhasil**.
- Password user sudah aman dengan hashing.
- SonarCloud Analysis menunjukkan **penurunan jumlah issue** dan peningkatan kualitas kode.
- Quality Gate gagal **hanya karena coverage (0%)**, bukan karena vulnerability blocker.

Hasil uji SonarCloud:

<img width="1919" height="885" alt="image" src="https://github.com/user-attachments/assets/f14e8cfd-842c-4d7d-a07a-a55d04758424" />

Detail coverage report:

<img width="1812" height="625" alt="image" src="https://github.com/user-attachments/assets/413708b1-af81-40a9-ae72-43aae025c9d4" />

---
