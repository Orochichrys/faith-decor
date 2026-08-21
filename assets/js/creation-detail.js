document.addEventListener('DOMContentLoaded', function() {
  const creationModal = document.getElementById('creationDetailModal');
  if (creationModal) {
    creationModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const title = button.getAttribute('data-title');
      const category = button.getAttribute('data-category');
      const image = button.getAttribute('data-image');
      const description = button.getAttribute('data-description');
      const budget = button.getAttribute('data-budget');
      const location = button.getAttribute('data-location');
      const guestCount = button.getAttribute('data-guest-count');
      const options = button.getAttribute('data-options');

      document.getElementById('creationModalTitleHeading').textContent = title;
      document.getElementById('creationModalCategory').textContent = category;
      document.getElementById('creationModalImage').src = image;
      document.getElementById('creationModalImage').alt = title;
      document.getElementById('creationModalDescription').textContent = description;
      document.getElementById('creationModalBudget').textContent = budget;
      document.getElementById('creationModalLocation').textContent = location;
      document.getElementById('creationModalGuestCount').textContent = guestCount;
      document.getElementById('creationModalOptions').textContent = options;

      const whatsappUrl = "https://wa.me/+2250102797828?text=" + encodeURIComponent("Bonjour FAITH DECOR, je souhaiterais avoir plus d'informations concernant votre réalisation : " + title + " (" + category + ")");
      document.getElementById('creationModalBtnWhatsApp').href = whatsappUrl;
    });
  }
});
