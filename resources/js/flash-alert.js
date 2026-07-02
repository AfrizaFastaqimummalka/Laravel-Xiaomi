// flash-alert.js
// Auto-dismiss untuk flash alert Bootstrap (success/error dari session Laravel).
// Alert yang punya atribut data-flash="true" akan otomatis hilang setelah 4 detik.
// Pakai Bootstrap Alert API supaya animasi fade-nya tetap jalan normal.

// Berapa lama (ms) alert ditampilkan sebelum ditutup
const FLASH_ALERT_DISMISS_DELAY = 4000;

function initFlashAlertAutoDismiss() {
    // Cari semua flash alert — hanya yang punya data-flash="true",
    // biar alert validasi form tidak ikut kena
    const flashAlerts = document.querySelectorAll('[data-flash="true"]');

    if (flashAlerts.length === 0) return;

    flashAlerts.forEach(function (alertElement) {
        setTimeout(function () {
            // Kalau user sudah nutup sendiri sebelum timeout, skip
            if (!document.contains(alertElement)) return;

            if (typeof window.bootstrap !== 'undefined' && window.bootstrap.Alert) {
                // Pakai Bootstrap Alert API supaya animasi fade jalan
                window.bootstrap.Alert.getOrCreateInstance(alertElement).close();
            } else {
                // Fallback kalau Bootstrap JS belum dimuat
                alertElement.remove();
            }
        }, FLASH_ALERT_DISMISS_DELAY);
    });
}

// Tunggu DOM siap dulu baru jalankan
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFlashAlertAutoDismiss);
} else {
    initFlashAlertAutoDismiss();
}

export { initFlashAlertAutoDismiss };
