const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("fileInput");
const selectBtn = document.getElementById("selectBtn");
const uploadBtn = document.getElementById("uploadBtn");
const fileList = document.getElementById("fileList");
const status = document.getElementById("status");

let selectedFiles = [];

selectBtn.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", () => {
  selectedFiles = fileInput.files;
  showFiles();
});

dropZone.addEventListener("dragover", (e) => {
  e.preventDefault();
});

dropZone.addEventListener("drop", (e) => {
  e.preventDefault();
  selectedFiles = e.dataTransfer.files;
  showFiles();
});

uploadBtn.addEventListener("click", () => {
  if (selectedFiles.length === 0) {
    status.innerText = "Geen files geselecteerd";
    return;
  }

  const formData = new FormData();

  for (let i = 0; i < selectedFiles.length; i++) {
    formData.append("files[]", selectedFiles[i]);
  }

  fetch("upload.php", {
      method: "POST",
      body: formData
  })
  .then(res => res.text())
  .then(data => {
      window.location.href = "index.php";
  });
});

function isValidPDF(file) {
  return file.type === "application/pdf";
}

function showFiles() {
  fileList.innerHTML = "";

  for (let file of selectedFiles) {
    fileList.innerHTML += `<p>${file.name}</p>`;
  }
}


// code for document.php en niet upload.php
fetch('get_files.php')
    .then(res => res.json())
    .then(files => {
        const list = document.getElementById('docList');
        files.forEach(file => {
            list.innerHTML += `<li class="nav-item">
                <a href="#" class="nav-link text-white" onclick="loadPDF('${file.path}'); return false;">
                    ${file.filename}
                </a>
            </li>`;
        });
    });

function loadPDF(path) {
    document.getElementById('pdfViewer').src = path;
}