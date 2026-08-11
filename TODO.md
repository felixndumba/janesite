# Task: Fix YouTube Player when IFrame API fails (ERR_TOO_MANY_REDIRECTS)

## Steps
- [x] 1. Harden the `__ytApiPromise` loader with `onerror` + safety timeout in `resources/views/master-class.blade.php`
- [x] 2. Add `mountFallbackPlayer(videoId)` method injecting a direct `youtube-nocookie.com/embed` iframe
- [x] 3. Route `openPlayer` through the fallback when `YT` is unavailable
- [x] 4. Update `destroyPlayer()` to clear the container so the fallback iframe is removed cleanly
- [x] 5. Verify the master-class page player works (inline Blade JS — no asset rebuild needed)

## Follow-up: YouTube IFrame API postMessage origin-mismatch warning
- [x] 6. Pin Vite dev server + HMR to `127.0.0.1` in `vite.config.js` so the HMR origin matches
- [x] 7. Add `host: 'https://www.youtube-nocookie.com'` + `origin: window.location.origin` to the `YT.Player` config in `resources/views/master-class.blade.php` so the widget API posts messages back to the correct origin (kills the `www-widgetapi.js` postMessage mismatch warning)
- [x] 8. Harden `__ytApiPromise` with `tag.onerror` and add a `!YT` guard in `mountPlayer` so the player fails gracefully if the API script is blocked
- [ ] 9. Restart `npm run dev`, reload the master-class page, and confirm the `postMessage` origin warnings are gone
