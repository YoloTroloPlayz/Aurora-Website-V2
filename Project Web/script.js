$(document).ready(function(){
    console.log("DOM volledig geladen...");

    $("#discord-btn").click(function() {
      window.open("https://discord.gg/JxUmW5kc", "_blank");
    });
});

let documents = [];

// Load JSON één keer
fetch('docs.json')
  .then(res => res.json())
  .then(data => {
    documents = data;
    init(); // start alles pas NA laden
  });

// Similarity
function getSimilarityScore(query, target) {
  query = query.toLowerCase();
  target = target.toLowerCase();

  if (target.includes(query)) return 1;

  let score = 0;
  for (let i = 0; i < query.length; i++) {
    if (target.includes(query[i])) score++;
  }
  return score / target.length;
}

function init() {
  const searchInput = document.getElementById('searchInput');
  const resultsList = document.getElementById('searchResults');
  const titleEl = document.getElementById('doc-title');
  const contentEl = document.getElementById('doc-content');

  // 🔎 SEARCH (alleen als input bestaat)
  if (searchInput && resultsList) {
    searchInput.addEventListener('input', function () {
      const query = this.value.trim().toLowerCase();
      resultsList.innerHTML = '';

      if (!query || query.length < 2) return;

      const matches = documents
        .map(doc => {
          const score = Math.max(
            getSimilarityScore(query, doc.title),
            getSimilarityScore(query, doc.id)
          );
          return { ...doc, score };
        })
        .filter(doc => doc.score > 0)
        .sort((a, b) => b.score - a.score)
        .slice(0, 5);

      matches.forEach(doc => {
        const li = document.createElement('li');
        li.className = 'list-group-item list-group-item-dark';
        li.textContent = `${doc.id} – ${doc.title}`;
        li.style.cursor = 'pointer';

        li.addEventListener('click', () => {
          window.location.href = `document.html?id=${doc.id}`;
        });

        resultsList.appendChild(li);
      });
    });
  }

  // 📄 DOCUMENT LADEN (alleen als elementen bestaan)
  if (titleEl && contentEl) {
    const params = new URLSearchParams(window.location.search);
    const docId = params.get('id');

    if (!docId) {
      titleEl.textContent = "Enter a search query to begin";
      return;
    }

    const doc = documents.find(d => d.id === docId);

    if (!doc) {
      titleEl.textContent = "Document not found";
      contentEl.innerHTML = "<p>We couldn’t find the document you're looking for.</p>";
      return;
    }

    titleEl.textContent = `${doc.id} – ${doc.title}`;
    contentEl.innerHTML = `
      <iframe 
        src="${doc.pdf}" 
        width="100%" 
        height="800px"
        style="border:none; border-radius:12px;">
      </iframe>
    `;
  }
}