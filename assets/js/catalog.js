document.addEventListener('DOMContentLoaded', () => {
  let products = [
    {
      id: 1,
      title: "Kaftan de Mariée d'Or",
      category: "tenues",
      categoryLabel: "Tenue Traditionnelle",
      price: 100000,
      image: "https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=800",
      description: "Velours de soie d'exception orné de broderies fines métalliques faites à la main par nos artisans maîtres doreurs.",
      details: "Inclus : Kaftan principal, sur-robe en mousseline fine et ceinture assortie. Tailles disponibles : S, M, L.",
      popular: true
    },
    {
      id: 2,
      title: "Parure de Perles & Or",
      category: "bijoux",
      categoryLabel: "Bijoux & Parures",
      price: 50000,
      image: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=800",
      description: "Collier plastron et boucles d'oreilles pendantes en perles nacrées et laiton doré à l'or fin.",
      details: "Finition hypoallergénique, fermoir sécurisé. Parfait pour sublimer un port de tête royal.",
      popular: true
    },
    {
      id: 3,
      title: "Robe Émeraude Royale",
      category: "tenues",
      categoryLabel: "Robe de Soirée",
      price: 80000,
      image: "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&q=80&w=800",
      description: "Tissu précieux satiné vert émeraude avec finitions haute couture et dentelle dorée aux poignets.",
      details: "Fermeture invisible au dos, coupe sirène ajustée. Tailles disponibles : XS, S, M, L.",
      popular: true
    },
    {
      id: 4,
      title: "Couronne Royale d'Or & Cristaux",
      category: "accessoires",
      categoryLabel: "Accessoire de Tête",
      price: 40000,
      image: "https://images.unsplash.com/photo-1579783902614-a3fb3927b675?auto=format&fit=crop&q=80&w=800",
      description: "Diadème majestueux réhaussé de strass étincelants et de cristal taillé reflet ambre.",
      details: "Peigne de maintien intégré, structure légère et confortable pour de longues cérémonies.",
      popular: false
    },
    {
      id: 5,
      title: "Takchita Blanche & Broderies Argent",
      category: "tenues",
      categoryLabel: "Tenue de Mariée",
      price: 110000,
      image: "https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&q=80&w=800",
      description: "Takchita 2 pièces en soie blanche de haute qualité avec ornements argentés perlés.",
      details: "Broderie sfifa traditionnelle, traîne légère élégante. Tailles disponibles : S, M, XL.",
      popular: true
    },
    {
      id: 6,
      title: "Ceinture Traditionnelle Ciselée",
      category: "accessoires",
      categoryLabel: "Ceintures & Accessoires",
      price: 30000,
      image: "https://images.unsplash.com/photo-1611591475281-8d283326c73f?auto=format&fit=crop&q=80&w=800",
      description: "Ceinture métallique dorée sculptée aux motifs arabesques traditionnels.",
      details: "Système de maillons ajustables (du 36 au 46). S'adapte à tous les kaftans et robes.",
      popular: false
    },
    {
      id: 7,
      title: "Ensemble Jabador Homme Prestige",
      category: "hommes",
      categoryLabel: "Tenue Homme",
      price: 75000,
      image: "https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=800",
      description: "Ensemble 3 pièces comprenant tunique brodée, pantalon assorti et cape en lin noble.",
      details: "Coupe moderne ajustée, finitions faites main. Tailles disponibles : M, L, XL, XXL.",
      popular: false
    },
    {
      id: 8,
      title: "Parure Saphir & Zirconium",
      category: "bijoux",
      categoryLabel: "Bijoux & Parures",
      price: 50000,
      image: "https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&q=80&w=800",
      description: "Ensemble collier, bracelet et boucles ornés de pierres bleu saphir et zircons.",
      details: "Livrées dans leur étui en velours scellé FAITH DECOR.",
      popular: false
    },
    {
      id: 9,
      title: "Voile de Mariée Dentelle de Calais",
      category: "accessoires",
      categoryLabel: "Voiles & Traînes",
      price: 35000,
      image: "https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=800",
      description: "Longueur cathédrale (3 mètres) en tulle de soie bordé de fine dentelle raffinée.",
      details: "Système de fixation transparent par peigne dissimulé.",
      popular: false
    },
    {
      id: 10,
      title: "Caftan Velours Bordeaux Impérial",
      category: "tenues",
      categoryLabel: "Tenue Traditionnelle",
      price: 90000,
      image: "https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=800",
      description: "Velours bordeaux profond avec cartouche de cristal et fil d'or précieux.",
      details: "Boutonnage artisanal 'Aakad' tout le long de la tenue. Tailles disponibles : S, M, L.",
      popular: true
    },
    {
      id: 11,
      title: "Pochette de Fête Sertie de Strass",
      category: "accessoires",
      categoryLabel: "Sacs & Pochettes",
      price: 25000,
      image: "https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?auto=format&fit=crop&q=80&w=800",
      description: "Mini minaudière rigide couverte de paillettes d'or et fermoir bijoux.",
      details: "Chaînette d'épaule amovible incluse.",
      popular: false
    },
    {
      id: 12,
      title: "Diadème & Collier Émeraude",
      category: "bijoux",
      categoryLabel: "Bijoux & Parures",
      price: 60000,
      image: "https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?auto=format&fit=crop&q=80&w=800",
      description: "Duo altière de cérémonie comprenant la couronne et le collier assorti.",
      details: "Pièce maîtresse de notre collection prestige.",
      popular: true
    }
  ];

  const productGrid = document.getElementById('catalog-grid');
  const searchInput = document.getElementById('search-input');
  const filterBadges = document.querySelectorAll('.filter-badge');
  const sortSelect = document.getElementById('sort-select');
  const productCountEl = document.getElementById('product-count');

  let currentCategory = 'all';
  let currentSearch = '';
  let currentSort = 'default';
  const effectivePrice = item => item.promoPrice ?? item.price;

  function renderProducts() {
    if (!productGrid) return;

    let filtered = products.filter(item => {
      const matchesCategory = currentCategory === 'all' || item.category === currentCategory;
      const matchesSearch = item.title.toLowerCase().includes(currentSearch.toLowerCase()) ||
                            item.description.toLowerCase().includes(currentSearch.toLowerCase()) ||
                            item.categoryLabel.toLowerCase().includes(currentSearch.toLowerCase());
      return matchesCategory && matchesSearch;
    });

    if (currentSort === 'price-asc') {
      filtered.sort((a, b) => effectivePrice(a) - effectivePrice(b));
    } else if (currentSort === 'price-desc') {
      filtered.sort((a, b) => effectivePrice(b) - effectivePrice(a));
    } else if (currentSort === 'popular') {
      filtered.sort((a, b) => (b.popular === a.popular ? 0 : b.popular ? 1 : -1));
    }

    if (productCountEl) {
      productCountEl.textContent = `${filtered.length} article${filtered.length > 1 ? 's' : ''} trouvé${filtered.length > 1 ? 's' : ''}`;
    }

    if (filtered.length === 0) {
      productGrid.innerHTML = `
        <div class="col-12 text-center py-5">
          <div class="p-5 bg-white rounded-4 shadow-sm border border-gold" style="max-width: 500px; margin: 0 auto;">
            <i class="ri-search-line text-gold mb-3 d-block" style="font-size: 48px;" aria-hidden="true"></i>
            <h4 class="serif text-terracotta mb-2">Aucun article trouvé</h4>
            <p class="text-muted mb-0">Essayez de modifier votre recherche ou de sélectionner une autre catégorie.</p>
          </div>
        </div>
      `;
      return;
    }

    productGrid.innerHTML = filtered.map(item => `
      <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
        <div class="card product-card h-100 border-0 shadow-sm overflow-hidden">
          <div class="product-card-img-wrapper">
            <img src="${item.image}" alt="${item.title}" class="w-100 h-100 object-fit-cover">
            <span class="product-tag">${item.categoryLabel}</span>
            <span class="product-price-badge">${effectivePrice(item).toLocaleString('fr-FR')} FCFA / jour${item.promoPercentage ? ` (-${item.promoPercentage}%)` : ''}</span>
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between text-center">
            <div>
              <h5 class="card-title mb-2 fs-5 fw-bold">${item.title}</h5>
              <p class="card-text small text-muted mb-4">${item.description}</p>
            </div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-outline-dark btn-sm w-50 py-2 btn-detail" data-id="${item.id}">
                Détails
              </button>
              <button type="button" class="btn btn-gold btn-sm w-50 py-2 text-uppercase fw-semibold btn-reserve" data-id="${item.id}">
                Réserver
              </button>
            </div>
          </div>
        </div>
      </div>
    `).join('');

    // Attach click events
    document.querySelectorAll('.btn-detail').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const id = parseInt(e.currentTarget.getAttribute('data-id'));
        openProductModal(id);
      });
    });

    document.querySelectorAll('.btn-reserve').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const id = parseInt(e.currentTarget.getAttribute('data-id'));
        const item = products.find(p => p.id === id);
        if (item) {
          reserveViaWhatsApp(item.title, effectivePrice(item));
        }
      });
    });
  }

  // Filter badges
  filterBadges.forEach(badge => {
    badge.addEventListener('click', () => {
      filterBadges.forEach(b => b.classList.remove('active'));
      badge.classList.add('active');
      currentCategory = badge.getAttribute('data-category');
      renderProducts();
    });
  });

  // Search input
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      currentSearch = e.target.value;
      renderProducts();
    });
  }

  // Sort select
  if (sortSelect) {
    sortSelect.addEventListener('change', (e) => {
      currentSort = e.target.value;
      renderProducts();
    });
  }

  // WhatsApp reserve helper
  function reserveViaWhatsApp(title, price) {
    const message = `Bonjour FAITH DECOR, je souhaite réserver ou me renseigner sur la tenue / l'accessoire suivant :\n\n` +
                    `✨ Modèle : ${title}\n` +
                    `💰 Tarif location : ${price.toLocaleString('fr-FR')} FCFA / jour\n\n` +
                    `Merci de me contacter pour vérifier les disponibilités.`;
    const encoded = encodeURIComponent(message);
    window.open(`https://wa.me/+2250102797828?text=${encoded}`, '_blank');
  }

  // Open Product Modal
  function openProductModal(id) {
    const item = products.find(p => p.id === id);
    if (!item) return;

    const modalTitle = document.getElementById('productModalTitle');
    const modalImage = document.getElementById('productModalImage');
    const modalCategory = document.getElementById('productModalCategory');
    const modalPrice = document.getElementById('productModalPrice');
    const modalDescription = document.getElementById('productModalDescription');
    const modalDetails = document.getElementById('productModalDetails');
    const modalBtnWhatsApp = document.getElementById('productModalBtnWhatsApp');

    if (modalTitle) modalTitle.textContent = item.title;
    if (modalImage) modalImage.src = item.image;
    if (modalCategory) modalCategory.textContent = item.categoryLabel;
    if (modalPrice) modalPrice.textContent = `${effectivePrice(item).toLocaleString('fr-FR')} FCFA / jour${item.promoPercentage ? ` (promotion -${item.promoPercentage}%)` : ''}`;
    if (modalDescription) modalDescription.textContent = item.description;
    if (modalDetails) modalDetails.textContent = item.details;

    if (modalBtnWhatsApp) {
      modalBtnWhatsApp.onclick = () => reserveViaWhatsApp(item.title, effectivePrice(item));
    }

    const modalElement = document.getElementById('productDetailModal');
    if (modalElement && window.bootstrap) {
      const bsModal = new bootstrap.Modal(modalElement);
      bsModal.show();
    }

  }

  // Initial render: les articles et leurs prix promotionnels viennent de la base.
  fetch('api/get_products.php')
    .then(response => response.ok ? response.json() : Promise.reject())
    .then(payload => {
      if (payload.success && Array.isArray(payload.products)) {
        products = payload.products;
        const filtersContainer = document.getElementById('category-filters');
        if (filtersContainer) {
          const categories = [...new Map(products.map(item => [item.category, item.categoryLabel])).entries()];
          filtersContainer.innerHTML = `<button class="btn filter-badge rounded-pill px-4 py-2 active" data-category="all">Tous</button>` +
            categories.map(([slug, label]) => `<button class="btn filter-badge rounded-pill px-4 py-2" data-category="${slug}">${label}</button>`).join('');
          filtersContainer.querySelectorAll('.filter-badge').forEach(badge => badge.addEventListener('click', () => {
            filtersContainer.querySelectorAll('.filter-badge').forEach(item => item.classList.remove('active'));
            badge.classList.add('active');
            currentCategory = badge.getAttribute('data-category');
            renderProducts();
          }));
        }
      }
      renderProducts();
    })
    .catch(() => renderProducts());
});
