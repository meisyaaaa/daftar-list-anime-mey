// --- 1. VARIABEL & TIPE DATA ---
// Menggunakan const karena referensi elemen tidak berubah
const formPendaftaran = document.querySelector('form');
const inputNama = document.getElementById('nama');
const inputEmail = document.getElementById('email');
const footerText = document.querySelector('footer p');

// --- 2. OUTPUT DASAR & MANIPULASI DOM ---
// Mengubah teks footer saat halaman dimuat
console.log("Sistem Web Teknik Informatika UMMI Aktif");

// --- 3. FUNGSI (FUNCTION) ---
// Fungsi untuk menyapa user (Menggunakan Arrow Function)
const sapaUser = (nama) => {
    return "Selamat datang, " + nama + " di Teknik Informatika UMMI!";
};

// --- 4. LOGIKA & EVENT HANDLER ---
// Menangani pengiriman formulir
formPendaftaran.addEventListener('submit', (event) => {
    // Mencegah halaman refresh saat submit
    event.preventDefault();

    // Mengambil nilai dari input (Tipe Data String)
    const nama = inputNama.value;
    const email = inputEmail.value;

    // Percabangan (If...Else) untuk validasi sederhana
    if (nama === "" || email === "") {
        alert("Mohon lengkapi data Anda!");
    } else {
        // Menampilkan output interaktif
        alert(sapaUser(nama));
        console.log("Data Terkirim: ", { nama, email });
        
        // Mengubah konten HTML secara dinamis
        footerText.innerHTML = "Terima kasih telah mendaftar, <b>" + nama + "</b>!";
    }
});

// --- 5. PERULANGAN (LOOP) ---
// Contoh penggunaan loop: Menghitung jumlah mata kuliah di tabel
const barisTabel = document.querySelectorAll('tbody tr');
for (let i = 0; i < barisTabel.length; i++) {
    console.log("Mata Kuliah ke-" + (i + 1) + " terdeteksi di sistem.");
}