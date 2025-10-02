// Datos de productos con tus imágenes locales
const products = [
  {
    id: 1,
    name: "REY CORDUROY",
    brand: "dandy",
    price: 849.00,
    image: "../img/hats8.png",
    description: "Gorra de estilo clásico con detalles en cuero."
  },
  {
    id: 2,
    name: "THE DARTHER ALL BLACK SUEDE",
    brand: "31hats",
    price: 799.00,
    image: "../img/31_Hats_EL_Mago.png",
    description: "Diseño moderno ideal para el día a día."
  },
  {
    id: 3,
    name: "BILLS FINALS WRAP TAN",
    brand: "barbas",
    price: 1899.00,
    image: "../img/barbas_hats.png",
    description: "Elegancia y comodidad en una gorra premium."
  },
  {
    id: 4,
    name: "CORONA 3 HUESOS EL MAGO",
    brand: "dandy",
    price: 749.00,
    image: "../img/dandysfondo2.png",
    description: "Estilo retro con materiales de alta calidad."
  },
  {
    id: 5,
    name: "BACKPACK BOYZ COLLECTION",
    brand: "31hats",
    price: 899.00,
    image: "../img/31_Hats_BackPack_Boyz.png",
    description: "Colección exclusiva Backpack Boyz."
  },
  {
    id: 6,
    name: "CLOUDS EDITION",
    brand: "31hats",
    price: 759.00,
    image: "../img/31_hats_clouds.png",
    description: "Edición especial Clouds."
  },
  {
    id: 7,
    name: "LA ELECTRIC SERIES",
    brand: "31hats",
    price: 829.00,
    image: "../img/31_Hats_LAElectric.png",
    description: "Serie LA Electric vibrante."
  },
  {
    id: 8,
    name: "MY CAPS COLLECTION",
    brand: "31hats",
    price: 699.00,
    image: "../img/32_Hats_BlackInBlack.png",
    description: "Colección personal My Caps."
  },
  {
    id: 9,
    name: "NY PEARLS LOVERS",
    brand: "31hats",
    price: 879.00,
    image: "../img/31_Hats_NYPearlsLovers.png",
    description: "Edición NY Pearls Lovers."
  },
  {
    id: 10,
    name: "RICH KIDS LINE",
    brand: "31hats",
    price: 999.00,
    image: "../img/31_Hats_RichKids.png",
    description: "Línea exclusiva Rich Kids."
  },
  {
    id: 11,
    name: "BLACK IN BLACK",
    brand: "31hats",
    price: 729.00,
    image: "../img/32_Hats_BlackInBlack.png",
    description: "Edición totalmente en negro."
  },
  {
    id: 12,
    name: "CLASSIC FINO",
    brand: "dandy",
    price: 899.00,
    image: "../img/fino_brand.png",
    description: "Clásico estilo Fino."
  },
  {
    id: 13,
    name: "VINTAGE COLLECTION",
    brand: "dandy",
    price: 799.00,
    image: "../img/dandysfondo3.png",
    description: "Colección vintage premium."
  },
  {
    id: 14,
    name: "PREMIUM LEATHER",
    brand: "dandy",
    price: 1299.00,
    image: "../img/dandysfondo4.png",
    description: "Cuero premium de primera calidad."
  },
  {
    id: 15,
    name: "URBAN STYLE",
    brand: "dandy",
    price: 849.00,
    image: "../img/dandysfondo5.png",
    description: "Estilo urbano contemporáneo."
  },
  {
    id: 16,
    name: "LIMITED EDITION",
    brand: "dandy",
    price: 1599.00,
    image: "../img/dandysfondo6.png",
    description: "Edición limitada exclusiva."
  },
  {
    id: 17,
    name: "SIGNATURE SERIES",
    brand: "dandy",
    price: 1199.00,
    image: "../img/dandysfondo7.png",
    description: "Serie signature de lujo."
  },
  {
    id: 18,
    name: "HERITAGE COLLECTION",
    brand: "dandy",
    price: 949.00,
    image: "../img/dandysfondo8.png",
    description: "Colección heritage clásica."
  },
  {
    id: 19,
    name: "MODERN CLASSIC",
    brand: "dandy",
    price: 899.00,
    image: "../img/dandysfondo9.png",
    description: "Clásico con toque moderno."
  },
  {
    id: 20,
    name: "BARBAS PREMIUM",
    brand: "barbas",
    price: 1399.00,
    image: "../img/hats1.png",
    description: "Línea premium Barbas."
  },
  {
    id: 21,
    name: "ELEGANCE LINE",
    brand: "barbas",
    price: 1299.00,
    image: "../img/hats2.png",
    description: "Línea elegancia exclusiva."
  },
  {
    id: 22,
    name: "LUXURY COLLECTION",
    brand: "barbas",
    price: 1699.00,
    image: "../img/hats3.png",
    description: "Colección de lujo."
  },
  {
    id: 23,
    name: "PREMIUM FIT",
    brand: "barbas",
    price: 1199.00,
    image: "../img/hats4.png",
    description: "Ajuste premium perfecto."
  },
  {
    id: 24,
    name: "SIGNATURE EDITION",
    brand: "barbas",
    price: 1499.00,
    image: "../img/hats5.png",
    description: "Edición signature."
  },
  {
    id: 25,
    name: "CLASSIC SERIES",
    brand: "barbas",
    price: 999.00,
    image: "../img/hats6.png",
    description: "Serie clásica renovada."
  },
  {
    id: 26,
    name: "DELUXE LINE",
    brand: "barbas",
    price: 1799.00,
    image: "../img/hats7.png",
    description: "Línea deluxe exclusiva."
  }
];

// Cargar productos destacados en la página principal
document.addEventListener('DOMContentLoaded', function() {
  loadFeaturedProducts();
  setupCartFunctionality();
  setupBrandNavigation();
});

let lastScroll = 0;
  const header = document.querySelector("header");

  window.addEventListener("scroll", () =>{
    let currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll){
      header.style.top = "-80px";
    }else{
      header.style.top = "0";
    }
    lastScroll = currentScroll;
  });

// Cargar productos destacados (solo 6 productos para la página principal)
function loadFeaturedProducts() {
  const featuredContainer = document.getElementById('featuredProducts');
  
  if (featuredContainer) {
    // Seleccionar 6 productos destacados (2 de cada marca)
    const featuredProducts = [
      products.find(p => p.id === 1),  // Dandy
      products.find(p => p.id === 4),  // Dandy
      products.find(p => p.id === 2),  // 31 Hats
      products.find(p => p.id === 5),  // 31 Hats
      products.find(p => p.id === 3),  // Barbas
      products.find(p => p.id === 20)  // Barbas
    ].filter(Boolean); // Filtrar cualquier undefined
    
    let html = '';
    featuredProducts.forEach(product => {
      if (product) {
        html += `
          <div class="col-md-6 col-lg-4">
            <div class="product-card">
              <img src="${product.image}" class="product-img w-100" alt="${product.name}" 
                  onerror="this.src='https://via.placeholder.com/300x300/333333/ffffff?text=Imagen+No+Disponible'">
              <div class="product-info">
                <h4 class="product-title">${product.name}</h4>
                <p class="product-description">${getBrandName(product.brand)}</p>
                <p class="product-price">$${product.price.toFixed(2)}</p>
                <button class="btn btn-dark w-100 add-to-cart" data-id="${product.id}">Agregar al carrito</button>
              </div>
            </div>
          </div>
        `;
      }
    });
    
    featuredContainer.innerHTML = html;
  }

}

// ... (el resto del código se mantiene igual) ...