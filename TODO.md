# TODO

- [x] Update `resources/views/reviews/index.blade.php`:
  - [x] Replace grid with horizontal carousel (3-per-view desktop, 1-per-view mobile) using scroll-snap.
  - [x] Add arrow controls (prev/next) that scroll/snaps by one card.
  - [x] Add mobile swipe support (native swipe via scroll-snap + drag-to-scroll).
  - [x] Add initials avatar for each review (derived from reviewer name).
  - [x] Update modal submit JS to insert new review items into the carousel container correctly.
- [x] Verify styling and spacing; ensure no layout breaks with different number of reviews.

- [ ] Manually test `/reviews` page:
  - [ ] Desktop: 3 cards visible, snapping works.
  - [ ] Mobile: swipe/drag works, 1 card visible.
  - [ ] Submitting a review inserts the new card and it becomes visible on carousel.



