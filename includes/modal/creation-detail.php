<!-- CREATION DETAIL MODAL -->
<div class="modal fade" id="creationDetailModal" tabindex="-1" aria-labelledby="creationModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title serif text-gold fw-bold" id="creationModalTitle">Détails de la Réalisation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-4 align-items-center">
          <div class="col-md-6">
            <div class="rounded-3 overflow-hidden shadow-sm" style="height: 350px;">
              <img id="creationModalImage" src="" alt="" class="w-100 h-100 object-fit-cover">
            </div>
          </div>
          <div class="col-md-6">
            <span id="creationModalCategory" class="badge bg-gold text-terracotta mb-2 px-3 py-1 rounded-pill uppercase fw-semibold"></span>
            <h4 id="creationModalTitleHeading" class="text-terracotta serif fw-bold mb-3 fs-3"></h4>
            <p id="creationModalDescription" class="text-dark mb-3"></p>
            
            <!-- Event Attributes (Budget, Lieu, Invités, Options) -->
            <div class="mb-4 p-3 rounded-3 bg-light border border-gold-subtle">
              <h6 class="serif text-terracotta fw-bold mb-3" style="font-size: 0.95rem; letter-spacing: 1px;">CARACTÉRISTIQUES DE L'ÉVÉNEMENT</h6>
              <div class="row g-2 text-dark" style="font-size: 0.9rem;">
                <div class="col-6 fw-semibold">Budget Approximatif :</div>
                <div class="col-6" id="creationModalBudget"></div>
                
                <div class="col-6 fw-semibold">Lieu de réalisation :</div>
                <div class="col-6" id="creationModalLocation"></div>
                
                <div class="col-6 fw-semibold">Nombre d'invités :</div>
                <div class="col-6" id="creationModalGuestCount"></div>

                <div class="col-6 fw-semibold">Options incluses :</div>
                <div class="col-6" id="creationModalOptions"></div>
              </div>
            </div>

            <a id="creationModalBtnWhatsApp" href="#" target="_blank" class="btn btn-gold w-100 py-3 text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
              <i class="ri-whatsapp-line fs-5" aria-hidden="true"></i>
              Discuter de ce projet sur WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
