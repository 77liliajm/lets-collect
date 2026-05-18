document.addEventListener('DOMContentLoaded', function () {

    // ── COMPTEUR + et - ──────────────────────────────────────────────
    document.querySelectorAll('.btn-plus, .btn-minus').forEach(btn => {
        btn.addEventListener('click', function () {
            const id     = this.dataset.id;
            const action = this.classList.contains('btn-plus') ? 'increment' : 'decrement';
            const countEl = document.getElementById('count-' + id);

            fetch('/collection/update/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=' + action
            })
            .then(r => r.json())
            .then(data => {
                if (countEl) {
                    countEl.textContent = data.quantite;
                }

                // Badge doublon
                const card = btn.closest('.photocard');
                if (card) {
                    let badge = card.querySelector('.badge-doublon');
                    if (data.quantite > 1) {
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'badge-doublon';
                            card.querySelector('.photocard-body').prepend(badge);
                        }
                        badge.textContent = '×' + data.quantite;
                    } else if (badge) {
                        badge.remove();
                    }

                    // Si quantite = 0 on masque la carte
                    if (data.quantite === 0) {
                        card.style.opacity = '0.3';
                    } else {
                        card.style.opacity = '1';
                    }
                }
            })
            .catch(err => console.error('Erreur compteur:', err));
        });
    });

    // ── COEUR WISHLIST ────────────────────────────────────────────────
    document.querySelectorAll('.heart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch('/wishlist/toggle/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            })
            .then(r => r.json())
            .then(data => {
                if (data.wishlisted) {
                    this.textContent = '♥';
                    this.classList.add('active');
                } else {
                    this.textContent = '♡';
                    this.classList.remove('active');
                }
            })
            .catch(err => console.error('Erreur wishlist:', err));
        });
    });

});