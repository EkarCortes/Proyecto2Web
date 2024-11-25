const toggleButton = document.getElementById('toggleButton');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

toggleButton.addEventListener('click', () => {
  sidebar.classList.toggle('active');  // Cambia la clase 'active' del sidebar
  content.classList.toggle('shifted'); // Ajusta el contenido según el sidebar
});
