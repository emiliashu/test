const STORAGE_KEY = 'notes_list';
let notes = [];

function loadNotes() {
    const saved = localStorage.getItem(STORAGE_KEY);
    notes = saved ? JSON.parse(saved) : [];
    renderNotes();
}

function saveNotes() {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(notes));
    renderNotes();
}

function renderNotes() {
    const container = document.getElementById('notesList');
    if (!container) return;
    if (notes.length === 0) {
        container.innerHTML = '<div class="empty-message">нет заметок</div>';
        return;
    }
    container.innerHTML = '';
    notes.forEach((note, i) => {
        const div = document.createElement('div');
        div.className = 'note-item';
        div.innerHTML = `
            <span class="note-text">${escapeHtml(note)}</span>
            <button class="delete-note" data-index="${i}">×</button>
        `;
        container.appendChild(div);
    });
    document.querySelectorAll('.delete-note').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const idx = parseInt(btn.dataset.index);
            notes.splice(idx, 1);
            saveNotes();
            showStatus('заметка удалена');
        });
    });
}

function escapeHtml(str) {
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    }).replace(/[\n\r]/g, '<br>');
}

function addNote() {
    const textarea = document.getElementById('noteInput');
    const text = textarea.value.trim();
    if (text === '') {
        showStatus('пустая заметка не добавлена');
        return;
    }
    notes.push(text);
    saveNotes();
    textarea.value = '';
    showStatus('заметка добавлена');
}

function clearAllNotes() {
    if (notes.length === 0) return;
    notes = [];
    saveNotes();
    showStatus('все заметки удалены');
}

function showStatus(msg) {
    const statusDiv = document.getElementById('status');
    if (!statusDiv) return;
    statusDiv.textContent = msg;
    setTimeout(() => statusDiv.textContent = '', 1500);
}

document.addEventListener('DOMContentLoaded', () => {
    loadNotes();
    document.getElementById('addBtn').addEventListener('click', addNote);
    document.getElementById('clearAllBtn').addEventListener('click', clearAllNotes);
    const textarea = document.getElementById('noteInput');
    if (textarea) {
        textarea.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                addNote();
            }
        });
    }
});

// PWA (Service Worker)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js');
    });
}

// кнопка установки
let deferredPrompt;
const installBtn = document.getElementById('installBtn');
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    installBtn.style.display = 'inline-block';
});
installBtn?.addEventListener('click', async () => {
    if (!deferredPrompt) return;
    installBtn.style.display = 'none';
    deferredPrompt.prompt();
    deferredPrompt = null;
});