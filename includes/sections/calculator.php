<section id="calculator" class="py-5 bg-ivory">
    <div class="container">
        <div class="text-center mb-5 section-title">
            <span class="text-gold d-block mb-2 text-uppercase fw-semibold"
                style="letter-spacing: 3px; font-size: 0.85rem">Simulateur de Budget</span>
            <h2 class="serif text-terracotta fs-2 fw-semibold">Estimez Votre Projet</h2>
        </div>
        <div class="card w-100 shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <form id="estimation-form">
                    <div class="row g-5">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-4">
                                <label class="form-label d-block text-terracotta fw-semibold mb-3">Type
                                    d'Événement</label>
                                <div class="d-flex flex-wrap gap-2" id="event-type-container">
                                    <span class="text-muted small">Chargement des prestations…</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label d-block text-terracotta fw-semibold mb-3">Lieu de
                                    Réception</label>
                                <div class="d-flex flex-wrap gap-2" id="location-container">
                                    <span class="text-muted small">Chargement des lieux…</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="guests-range" class="form-label d-block text-terracotta fw-semibold mb-2">
                                    Nombre d'Invités : <span id="guests-count" class="text-gold fw-bold">100</span>
                                </label>
                                <input type="range" class="form-range w-100" min="10" max="500" value="100"
                                    id="guests-range">
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-block text-terracotta fw-semibold mb-3">Options
                                    Additionnelles</label>
                                <div class="row g-2" id="options-container">
                                    <span class="text-muted small">Chargement des options…</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-between">
                            <div class="p-4 rounded-3 border d-flex flex-column justify-content-between h-100"
                                style="background-color: rgba(74, 44, 42, 0.02); border-color: rgba(212, 175, 55, 0.25) !important;">
                                <div>
                                    <h4 class="serif text-terracotta mb-4 fw-bold">Résumé de l'Estimation</h4>
                                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                                        <span class="text-secondary">Prestation</span>
                                        <span id="summary-event"
                                            class="fw-semibold text-terracotta text-capitalize">Mariage</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                                        <span class="text-secondary">Lieu de réception</span>
                                        <span id="summary-location"
                                            class="fw-semibold text-terracotta text-capitalize">En plein air</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                                        <span class="text-secondary">Nombre de convives</span>
                                        <span id="summary-guests" class="fw-semibold text-terracotta">100 invités</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                                        <span class="text-secondary">Options sélectionnées</span>
                                        <span id="summary-options" class="fw-semibold text-terracotta text-end"
                                            style="font-size: 0.9rem;">Aucune</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                                        <span class="fw-bold text-dark fs-5">Budget Estimé</span>
                                        <span id="summary-total" class="fw-bold text-gold fs-3">900 000 FCFA</span>
                                    </div>
                                </div>

                                <button type="button" id="btn-whatsapp"
                                    class="btn btn-gold w-100 py-3 mt-4 text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <i class="ri-whatsapp-line fs-5" aria-hidden="true"></i>
                                    <span class="whatsapp-button-label">Envoyer sur WhatsApp</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>