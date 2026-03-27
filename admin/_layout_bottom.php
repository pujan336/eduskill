            </main>
        </div>
    </div>
    <div class="admin-toast<?php echo !empty($admin_toast_error) ? ' admin-toast--error' : ''; ?><?php echo !empty($admin_toast_success) ? ' admin-toast--success' : ''; ?>" id="adminToast" role="status" aria-live="polite" hidden></div>
    <?php if (!empty($admin_toast)) : ?>
        <script>
            window.__ADMIN_TOAST__ = <?php echo json_encode((string) $admin_toast, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        </script>
    <?php endif; ?>
    <script src="../assets/js/admin.js"></script>
</body>

</html>
