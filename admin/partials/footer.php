    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
  <script>
    // Topnav avatar dropdown
    const admAvBtn  = document.getElementById('admAvBtn');
    const admAvMenu = document.getElementById('admAvMenu');
    if (admAvBtn && admAvMenu) {
      admAvBtn.addEventListener('click', e => {
        e.stopPropagation();
        admAvMenu.classList.toggle('show');
      });
      document.addEventListener('click', () => admAvMenu.classList.remove('show'));
    }
  </script>
</body>
</html>
