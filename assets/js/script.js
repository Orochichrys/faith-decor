document.addEventListener('DOMContentLoaded', async () => {
  const eventContainer = document.getElementById('event-type-container');
  const locationContainer = document.getElementById('location-container');
  const optionsContainer = document.getElementById('options-container');
  const guestsRange = document.getElementById('guests-range');
  const guestsCountEl = document.getElementById('guests-count');
  const summaryEventEl = document.getElementById('summary-event');
  const summaryLocationEl = document.getElementById('summary-location');
  const summaryGuestsEl = document.getElementById('summary-guests');
  const summaryOptionsEl = document.getElementById('summary-options');
  const summaryTotalEl = document.getElementById('summary-total');
  const btnWhatsapp = document.getElementById('btn-whatsapp');

  if (!eventContainer || !locationContainer || !optionsContainer || !btnWhatsapp) return;

  let config;
  let selectedEvent;
  let selectedLocation;
  let selectedOptions = [];
  let guestCount = Number(guestsRange?.value || 100);

  const escapeHtml = (value) => String(value).replace(/[&<>'"]/g, character => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' })[character]);
  const formatPrice = (price) => `${Number(price).toLocaleString('fr-FR')} FCFA`;

  function renderChoices() {
    selectedEvent = config.events[0];
    selectedLocation = config.locations[0];
    eventContainer.innerHTML = config.events.map((item, index) => `<button type="button" class="btn btn-select-option ${index === 0 ? 'active' : ''}" data-id="${item.id}">${escapeHtml(item.label)}</button>`).join('');
    locationContainer.innerHTML = config.locations.map((item, index) => `<button type="button" class="btn btn-select-option ${index === 0 ? 'active' : ''}" data-id="${item.id}">${escapeHtml(item.label)}</button>`).join('');
    optionsContainer.innerHTML = config.options.map(item => `<div class="col-6"><div class="form-check custom-option-check p-3 rounded border"><input class="form-check-input ms-0 me-2" type="checkbox" value="${item.id}" id="option-${item.id}"><label class="form-check-label fw-medium text-dark" for="option-${item.id}">${escapeHtml(item.label)} <small class="text-muted d-block">${formatPrice(item.price)}</small></label></div></div>`).join('') || '<p class="text-muted mb-0">Aucune option disponible.</p>';

    eventContainer.querySelectorAll('button').forEach(button => button.addEventListener('click', () => {
      eventContainer.querySelectorAll('button').forEach(item => item.classList.remove('active'));
      button.classList.add('active');
      selectedEvent = config.events.find(item => item.id === Number(button.dataset.id));
      calculateBudget();
    }));
    locationContainer.querySelectorAll('button').forEach(button => button.addEventListener('click', () => {
      locationContainer.querySelectorAll('button').forEach(item => item.classList.remove('active'));
      button.classList.add('active');
      selectedLocation = config.locations.find(item => item.id === Number(button.dataset.id));
      calculateBudget();
    }));
    optionsContainer.querySelectorAll('input[type="checkbox"]').forEach(input => input.addEventListener('change', () => {
      selectedOptions = [...optionsContainer.querySelectorAll('input:checked')].map(box => config.options.find(item => item.id === Number(box.value)));
      calculateBudget();
    }));
  }

  function calculateBudget() {
    if (!selectedEvent || !selectedLocation) return 0;
    const total = selectedEvent.price + selectedLocation.price + guestCount * config.guest_price + selectedOptions.reduce((sum, option) => sum + option.price, 0);
    summaryEventEl.textContent = selectedEvent.label;
    summaryLocationEl.textContent = selectedLocation.label;
    summaryGuestsEl.textContent = `${guestCount} invités`;
    summaryOptionsEl.textContent = selectedOptions.length ? selectedOptions.map(option => option.label).join(', ') : 'Aucune';
    summaryTotalEl.textContent = formatPrice(total);
    return total;
  }

  if (guestsRange) guestsRange.addEventListener('input', event => {
    guestCount = Number(event.target.value);
    guestsCountEl.textContent = guestCount;
    calculateBudget();
  });

  try {
    const response = await fetch('api/get_estimation_config.php');
    const payload = await response.json();
    if (!response.ok || !payload.success || !payload.config.events.length || !payload.config.locations.length) throw new Error();
    config = payload.config;
    renderChoices();
    calculateBudget();
  } catch {
    eventContainer.innerHTML = '<span class="text-danger small">Les prestations sont momentanément indisponibles.</span>';
    locationContainer.innerHTML = '';
    optionsContainer.innerHTML = '';
    btnWhatsapp.disabled = true;
    return;
  }

  btnWhatsapp.addEventListener('click', async () => {
    const optionsText = selectedOptions.length ? selectedOptions.map(option => option.label).join(', ') : 'Aucune';
    const message = `Bonjour Faith Décor, je souhaite obtenir un devis pour mon projet :\n\n💍 Événement : ${selectedEvent.label}\n📍 Lieu : ${selectedLocation.label}\n👥 Invités : ${guestCount}\n✨ Options : ${optionsText}\n\n💰 Budget estimé : ${formatPrice(calculateBudget())}`;
    window.location.href = `https://wa.me/2250102797828?text=${encodeURIComponent(message)}`;
  });
});
