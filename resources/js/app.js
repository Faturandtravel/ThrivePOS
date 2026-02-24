import './bootstrap';

import { initializeApp } from "firebase/app";
import { getAuth, signInWithPopup, GoogleAuthProvider, signOut } from "firebase/auth";

const firebaseConfig = {
    apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
    authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
    projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
    storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
    messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
    appId: import.meta.env.VITE_FIREBASE_APP_ID
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

console.log("Firebase Client Berjalan!", app.name);

const btnLoginGoogle = document.getElementById('btn-login-google');
const pesanEl = document.getElementById('pesan-login');

if (btnLoginGoogle) {
    btnLoginGoogle.addEventListener('click', async () => {
        pesanEl.classList.add('hidden');
        const originalText = btnLoginGoogle.innerHTML;
        btnLoginGoogle.innerHTML = 'Memproses...';
        btnLoginGoogle.disabled = true;

        try {
            const result = await signInWithPopup(auth, provider);
            
            const idToken = await result.user.getIdToken();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

            if (response.ok) {
                window.location.href = '/dashboard';
            } else {
                pesanEl.innerText = data.message || 'Akses ditolak.';
                pesanEl.classList.remove('hidden');
                await signOut(auth); 
            }

        } catch (error) {
            console.error("Error saat Login Google:", error);
            
            if (error.code === 'auth/popup-closed-by-user') {
                pesanEl.innerText = "Login dibatalkan.";
            } else {
                pesanEl.innerText = "Terjadi kesalahan saat memproses login.";
            }
            pesanEl.classList.remove('hidden');
        } finally {
            btnLoginGoogle.innerHTML = originalText;
            btnLoginGoogle.disabled = false;
        }
    });
}