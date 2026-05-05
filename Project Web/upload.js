// DOM elementen ophalen
const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("fileInput");
const selectBtn = document.getElementById("selectBtn");
const uploadBtn = document.getElementById("uploadBtn");
const fileList = document.getElementById("fileList");
const status = document.getElementById("status");
const searchInput = document.getElementById('searchInput');

let selectedFiles = [];

// Knop om file dialog te openen
if (selectBtn) selectBtn.addEventListener("click", () => fileInput.click());

// Files bijhouden als gebruiker iets selecteert
if (fileInput) fileInput.addEventListener("change", () => {
  selectedFiles = fileInput.files;
  showFiles();
});

// Drag & drop
if (dropZone) {
  dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
  });

  dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    selectedFiles = e.dataTransfer.files;
    showFiles();
  });
}

// Upload knop
if (uploadBtn) uploadBtn.addEventListener("click", () => {
  if (selectedFiles.length === 0) {
    status.innerText = "Geen files geselecteerd";
    return;
  }

  const formData = new FormData();
  for (let i = 0; i < selectedFiles.length; i++) {
    formData.append("files[]", selectedFiles[i]);
  }

  // Verstuur files naar upload.php
  fetch("upload.php", {
      method: "POST",
      body: formData
  })
  .then(res => res.text())
  .then(() => {
      window.location.href = "index.php";
  });
});

// Checkt of file een PDF is
function isValidPDF(file) {
  return file.type === "application/pdf";
}

// Toont geselecteerde files in de lijst
function showFiles() {
  fileList.innerHTML = "";
  for (let file of selectedFiles) {
    fileList.innerHTML += `<p>${file.name}</p>`;
  }
}

// document pagina functies
// Vult de sidebar met documenten
function renderDocList(files) {
    const list = document.getElementById('docList');
    if (!list) return;
    list.innerHTML = '';
    files.forEach(file => {
        list.innerHTML += `<li class="nav-item">
            <a href="#" class="nav-link text-white" onclick="loadPDF('${file.path}'); return false;">
                ${file.filename}
            </a>
        </li>`;
    });
}

// Haalt files op uit de database via get_files.php
function loadFiles(query = '') {
    fetch('get_files.php?q=' + encodeURIComponent(query))
        .then(res => res.json())
        .then(files => renderDocList(files));
}

// Laadt PDF in de iframe
function loadPDF(path) {
    document.getElementById('pdfViewer').src = path;
}

//belangerijk: domcontentloaded om kijken als alles geladen is (anders werkt et nie)
document.addEventListener('DOMContentLoaded', () => {
    // Kijkt of er een zoekterm in de URL zit (van index.php)
    const urlParams = new URLSearchParams(window.location.search);
    const q = urlParams.get('q');
    if (q && searchInput) {
        searchInput.value = q;
        loadFiles(q);
    } else {
        loadFiles();
    }

    // Live zoeken met debounce zodat niet elke toetsaanslag een request stuurt
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => loadFiles(searchInput.value), 300);
        });
    }
});