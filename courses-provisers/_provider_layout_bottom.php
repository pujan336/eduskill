            </main>
            <footer class="provider-footer">
                &copy; <?php echo date('Y'); ?> EduSkill · Provider console
            </footer>
        </div>
    </div>
    <div class="provider-toast<?php echo !empty($provider_toast_error) ? ' provider-toast--error' : ''; ?><?php echo !empty($provider_toast_success) ? ' provider-toast--success' : ''; ?>" id="providerToast" role="status" aria-live="polite" hidden></div>
    <?php if (!empty($provider_toast)) : ?>
        <script>
            window.__PROVIDER_TOAST__ = <?php echo json_encode((string) $provider_toast, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        </script>
    <?php endif; ?>
    <script src="../assets/js/provider.js"></script>
</body>

</html>
