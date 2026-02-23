import './bootstrap';

// 1. Import modul Firebase yang dibutuhkan
import { initializeApp } from "firebase/app";
import { getAuth, signInWithPopup, GoogleAuthProvider, signOut } from "firebase/auth";

// 2. Konfigurasi Firebase Web Client (Mengambil dari file .env via Vite)
const firebaseConfig = {
    apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
    authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
    projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
    storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
    messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
    appId: import.meta.env.VITE_FIREBASE_APP_ID
};

// 3. Inisialisasi Firebase App dan Auth
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// Opsional: Log untuk memastikan Firebase berjalan di browser
console.log("Firebase Client Berjalan!", app.name);

// 4. Logika Event Listener untuk Tombol Login Google
const btnLoginGoogle = document.getElementById('btn-login-google');
const pesanEl = document.getElementById('pesan-login');

// Pastikan tombol ada di halaman sebelum menambahkan event listener
if (btnLoginGoogle) {
    btnLoginGoogle.addEventListener('click', async () => {
        // Sembunyikan pesan error sebelumnya (jika ada) dan ubah teks tombol agar interaktif
        pesanEl.classList.add('hidden');
        const originalText = btnLoginGoogle.innerHTML;
        btnLoginGoogle.innerHTML = 'Memproses...';
        btnLoginGoogle.disabled = true;

        try {
            // A. Munculkan popup Google Sign-In
            const result = await signInWithPopup(auth, provider);
            
            // B. Dapatkan ID Token dari akun Google yang dipilih
            const idToken = await result.user.getIdToken();

            // C. Ambil CSRF Token dari tag <meta> di head HTML (Wajib untuk Laravel)
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // D. Kirim Token ke Backend Laravel (ke Route yang kita buat di web.php)
            const response = await fetch('/auth/google/verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken 
                },
                body: JSON.stringify({ token: idToken })
            });

            const data = await response.json();

            // E. Cek respon dari Laravel
            if (response.ok) {
                // Jika sukses (misal: akun terdaftar), arahkan ke dashboard POS
                window.location.href = '/dashboard';
            } else {
                // Jika gagal (misal: email belum didaftarkan oleh admin)
                pesanEl.innerText = data.message || 'Akses ditolak.';
                pesanEl.classList.remove('hidden');
                await signOut(auth); // Logout user dari memori browser
            }

        } catch (error) {
            console.error("Error saat Login Google:", error);
            
            // Tangani error jika user menutup popup sebelum selesai login
            if (error.code === 'auth/popup-closed-by-user') {
                pesanEl.innerText = "Login dibatalkan.";
            } else {
                pesanEl.innerText = "Terjadi kesalahan saat memproses login.";
            }
            pesanEl.classList.remove('hidden');
        } finally {
            // Kembalikan tombol ke keadaan semula
            btnLoginGoogle.innerHTML = originalText;
            btnLoginGoogle.disabled = false;
        }
    });
}