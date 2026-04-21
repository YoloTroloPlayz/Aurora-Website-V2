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
    status.innerHTML = data;
  });
});

function isValidPDF(file) {
  return file.type === "application/pdf";
}

uploadBtn.addEventListener("click", () => {
  if (selectedFiles.length === 0) {
    status.innerText = "Geen files geselecteerd";
    return;
  }

  for (let file of selectedFiles) {
    if (!isValidPDF(file)) {
      status.innerText = "Alleen PDF bestanden toegestaan!";
      return;
    }
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
    status.innerHTML = data;
  });
});

function showFiles() {
  fileList.innerHTML = "";

  for (let file of selectedFiles) {
    fileList.innerHTML += `<p>${file.name}</p>`;
  }
}