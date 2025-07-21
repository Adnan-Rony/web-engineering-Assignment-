const fruits = [
  {
    name: "Fresh Apple",
    category: "Fruit",
    price: 2.5,
    image: "https://images.pexels.com/photos/102104/pexels-photo-102104.jpeg"
  },
  {
    name: "Banana Bunch",
    category: "Fruit",
    price: 1.8,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  },
  {
    name: "Orange Delight",
    category: "Fruit",
    price: 2.0,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  },
  {
    name: "Mango Madness",
    category: "Special",
    price: 3.0,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  },
  {
    name: "Banana Bunch",
    category: "Fruit",
    price: 1.8,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  },
  {
    name: "Orange Delight",
    category: "Fruit",
    price: 2.0,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  },
  {
    name: "Mango Madness",
    category: "Special",
    price: 3.0,
    image: "https://images.pexels.com/photos/208450/pexels-photo-208450.jpeg"
  }
];

const cardContainer = document.querySelector('.card-container');
const cartIcon = document.getElementById('cartIcon');
const cartSidebar = document.getElementById('cartSidebar');
const cartItemsContainer = document.getElementById('cartItems');
const cartCount = document.getElementById('cartCount');

let cart = [];

function renderCards() {
  fruits.forEach((fruit, index) => {
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <img src="${fruit.image}" alt="${fruit.name}" />
      <div class="card-body">
        <h3 class="card-title">${fruit.name}</h3>
        <p class="card-category">${fruit.category}</p>
        <p class="card-price">$${fruit.price.toFixed(2)}</p>
        <button onclick="addToCart(${index})" class="oferButton">Add to Cart</button>
      </div>
    `;
    cardContainer.appendChild(card);
  });
}

function addToCart(index) {
  cart.push(fruits[index]);
  updateCart();
  showCart();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCart();
}

function updateCart() {
  cartItemsContainer.innerHTML = '';
  let total = 0;

  cart.forEach((item, index) => {
    total += item.price;

    const cartItem = document.createElement('div');
    cartItem.className = 'cart-item';
    cartItem.innerHTML = `
      <img src="${item.image}" />
      <div>
        <p>${item.name}</p>
        <p>$${item.price.toFixed(2)}</p>
        <button class="remove-btn" onclick="removeFromCart(${index})">Remove</button>
      </div>
    `;
    cartItemsContainer.appendChild(cartItem);
  });

  const totalElement = document.createElement('div');
  totalElement.innerHTML = `<h3>Total: $${total.toFixed(2)}</h3>`;
  cartItemsContainer.appendChild(totalElement);

  cartCount.innerText = cart.length;
}

function showCart() {
  cartSidebar.classList.add('show');
}

function closeCart() {
  cartSidebar.classList.remove('show');
}

renderCards();
