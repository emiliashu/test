const STORAGE_KEY = 'my_note';

// ========== РАБОТА С ЗАМЕТКАМИ ==========

function updateSavedNoteDisplay() {
    const savedNote = localStorage.getItem(STORAGE_KEY);
    const savedNoteDiv = document.getElementById('savedNote');
    if (savedNote && savedNote.trim() !== '') {
        savedNoteDiv.textContent = savedNote;
    } else {
        savedNoteDiv.textContent = '';
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const savedNote = localStorage.getItem(STORAGE_KEY);
    const textarea = document.getElementById('noteContent');
    const statusDiv = document.getElementById('status');
    
    if (savedNote !== null) {
        textarea.value = savedNote;
        statusDiv.textContent = 'заметка восстановлена';
    } else {
        statusDiv.textContent = 'нет сохранённой заметки';
    }
    
    updateSavedNoteDisplay();
});

document.getElementById('saveBtn').addEventListener('click', () => {
    const textarea = document.getElementById('noteContent');
    const noteText = textarea.value;
    const statusDiv = document.getElementById('status');
    
    localStorage.setItem(STORAGE_KEY, noteText);
    statusDiv.textContent = 'сохранено!';
    updateSavedNoteDisplay();
    
    setTimeout(() => {
        if (statusDiv.textContent === 'сохранено!') {
            statusDiv.textContent = 'заметка сохранена';
        }
    }, 1500);
});

document.getElementById('clearBtn').addEventListener('click', () => {
    const textarea = document.getElementById('noteContent');
    const statusDiv = document.getElementById('status');
    
    localStorage.removeItem(STORAGE_KEY);
    textarea.value = '';
    statusDiv.textContent = 'заметка удалена, поле очищено';
    updateSavedNoteDisplay();
});

// ========== PWA: SERVICE WORKER ==========

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('Service Worker зарегистрирован:', registration.scope);
                const statusDiv = document.getElementById('status');
                if (statusDiv) {
                    statusDiv.textContent = '✓ Service Worker работает | ' + statusDiv.textContent;
                }
            })
            .catch(error => {
                console.error('Ошибка регистрации SW:', error);
            });
    });
}

// ========== PWA: КНОПКА УСТАНОВКИ ==========

let deferredPrompt;
const installBtn = document.getElementById('installBtn');

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    if (installBtn) installBtn.style.display = 'block';
    
    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            installBtn.style.display = 'none';
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                const statusDiv = document.getElementById('status');
                if (statusDiv) statusDiv.textContent = '✓ Приложение установлено | ' + statusDiv.textContent;
            }
            deferredPrompt = null;
        });
    }
});