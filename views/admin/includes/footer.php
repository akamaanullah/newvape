      </main>

    </div>
  </div>

  <!-- Global Admin Core Script -->
  <script src="<?= asset('admin/js/admin-core.js') ?>"></script>

  <!-- Page-Specific Script -->
  <?php if (!empty($page_script)): ?>
    <script src="<?= asset('admin/js/' . $page_script) ?>"></script>
  <?php endif; ?>

</body>
</html>
