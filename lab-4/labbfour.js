const foodItems = [
  {
    name: "Red Apples",
    currentPrice: 120,
    discount: 80,
    applyDiscount: true,
    image: "img/images (3).jpeg",
  },
  {
    name: "Chocolate Cake",
    currentPrice: 320,
    discount: 0,
    applyDiscount: false,
    image: "img/images (4).jpeg",
  },
  {
    name: "Iced Latte",
    currentPrice: 200,
    discount: 50,
    applyDiscount: true,
    image: "img/istockphoto-155302141-612x612.jpg",
  },
  {
    name: "Fresh Garden Salad",
    currentPrice: 150,
    discount: 0,
    applyDiscount: false,
    image: "img/images (2).jpeg",
  },
  {
    name: "Cheeseburger",
    currentPrice: 450,
    discount: 50,
    applyDiscount: true,
    image: "img/images (2).jpeg",
  },
  {
    name: "BBQ Chicken Pizza",
    currentPrice: 700,
    discount: 0,
    applyDiscount: false,
    image: "https://images.pexels.com/photos/845808/pexels-photo-845808.jpeg",
  },
  {
    name: "Club Sandwich",
    currentPrice: 350,
    discount: 25,
    applyDiscount: true,
    image: "https://images.pexels.com/photos/27672768/pexels-photo-27672768.jpeg",
  },
  {
    name: "Hot Dog",
    currentPrice: 250,
    discount: 0,
    applyDiscount: false,
    image: "https://images.pexels.com/photos/4518656/pexels-photo-4518656.jpeg",
  },
];

function getDiscountedPrice(item) {
  if (item.applyDiscount) {
    return item.currentPrice - item.discount;
  }
  return item.currentPrice;
}

let cart = [];

function handleAddToCart(food) {
  const existing = cart.find((item) => item.name === food.name);
  if (existing) {
    existing.quantity++;
  } else {
    cart.push({ ...food, quantity: 1 });
  }
  updateCartUI();
  openCart();
}

function updateCartUI() {
  const cartItemsContainer = document.getElementById("cartItems");
  const cartCount = document.getElementById("cartCount");

  cartItemsContainer.innerHTML = "";

  cart.forEach((item) => {
    const discountPrice = getDiscountedPrice(item) * item.quantity;
    const div = document.createElement("div");
    div.classList.add("cart-item");

    div.innerHTML = `
      <img src="${item.image}" alt="${item.name}" width="50" />
      <div class="cart-item-details">
        <p>${item.name}</p>
        <p>Qty: ${item.quantity}</p>
        <p>Price: ${item.currentPrice * item.quantity}</p>
        <p>Discount Price: ${discountPrice}</p>
      </div>
      <button class="remove-btn">Remove</button>
    `;

    div.querySelector(".remove-btn").addEventListener("click", () => {
      removeFromCart(item.name);
    });

    cartItemsContainer.appendChild(div);
  });

  const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
  cartCount.innerText = totalQuantity;
}

function removeFromCart(itemName) {
  cart = cart.filter((item) => item.name !== itemName);
  updateCartUI();
}

function openCart() {
  document.getElementById("cartSidebar").style.right = "0";
}

function closeCart() {
  document.getElementById("cartSidebar").style.right = "-350px";
}

// Product Cards
function createCard(items = foodItems) {
  const container = document.querySelector(".card-container");
  container.innerHTML = "";

  items.forEach((food) => {
    const card = document.createElement("div");
    card.classList.add("card");

    const button = document.createElement("button");
    button.innerText = "Add To Cart";
    button.addEventListener("click", () => handleAddToCart(food));

    card.innerHTML = `
      <img src="${food.image}" alt="${food.name}" />
      <div class="card-body">
        <div class="card-title">${food.name}</div>
        <div class="card-price">৳${getDiscountedPrice(food)}</div>
      </div>
    `;

    card.querySelector(".card-body").appendChild(button);
    container.appendChild(card);
  });
}

createCard();

// Search functionality
document.getElementById("searchButton").addEventListener("click", () => {
  const query = document.querySelector('input[type="text"]').value.toLowerCase();
  const filteredItems = foodItems.filter((item) =>
    item.name.toLowerCase().includes(query)
  );
  createCard(filteredItems);
});
