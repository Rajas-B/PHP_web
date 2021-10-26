document.addEventListener("DOMContentLoaded", function () {
  changeItems("pizza");
  showItems();

  
  var modal = document.getElementById("cartModal");

  var btn = document.getElementById("cart_pic");

  var profbtn = document.getElementById("prof_pic");

  var closebtn = document.getElementsByClassName("close-btn")[0];

  var span = document.getElementsByClassName("close")[0];

 

  btn.onclick = function () {
    modal.style.display = "block";
    fcItems();
  };

  profbtn.onclick = function () {
    document.getElementById("sidebar").style.width = "250px";
  };

  closebtn.onclick = function () {
    document.getElementById("sidebar").style.width = "0";
  };

  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
  document.getElementById("testForm").onsubmit = function () {
    return validateForm();
  };
});

items = {
  deals: {
    deals_1: ["deals/deal_1.jpg", "2 pizzas", 230, "Veg"],
    deals_2: ["deals/deal_2.jpg", "2 pizzas", 240, "Non-veg"],
    deals_3: ["deals/deal_3.jpg", "Pizza+Pasta+Coke", 240, "Non-veg"],
    deals_4: ["deals/deal_4.jpeg", "2 pizzas+Coke", 240, "Non-veg"],
    deals_5: ["deals/deal_5.jpg", "Pasta+Coke", 240, "Veg"],
  },
  pizza: {
    pizza_1: ["pizzas/pizza_1.jpg", "Margherita", 200, "Veg"],
    pizza_2: ["pizzas/pizza_2.jpg", "Peppy Paneer", 220, "Veg"],
    pizza_3: ["pizzas/pizza_3.jpeg", "Farm Fresh", 250, "Veg"],
    pizza_4: ["pizzas/pizza_4.png", "Green wave", 250, "Veg"],
    pizza_5: ["pizzas/pizza_5.jpeg", "Pepper Chicken", 300, "Non-veg"],
    pizza_6: ["pizzas/pizza_6.jpeg", "Chicken sausage", 310, "Non-veg"],
  },
  pastas: {
    pastas_1: ["pastas/pasta_1.jpeg", "Penne Alfredo", 180, "Veg"],
    pastas_2: ["pastas/pasta_2.jpeg", "Sicilian spicy", 190, "Veg"],
    pastas_3: ["pastas/pasta_3.jpeg", "Ravioli", 190, "Veg"],
    pastas_4: ["pastas/pasta_4.jpeg", "Chicken pasta", 200, "Non-veg"],
  },
  desserts: {
    desserts_1: ["desserts/dessert_1.jpeg", "Choco Lava cake", 70, "Non-veg"],
    desserts_2: ["desserts/dessert_2.jpeg", "Coke", 50, "Veg"],
    desserts_3: ["desserts/dessert_3.jpeg", "Mousse cake", 70, "Veg"],
  },
};

cart = {};

function add_to_cart(item) {
  if (cart[item.id]) {
    cart[item.id][1] += 1;
  }
  fcItems();
}

function remove_cart(item) {
  if (cart[item.id]) {
    cart[item.id][1] -= 1;
    if (cart[item.id][1] == 0) {
      delete cart[item.id];
    }
  }
  fcItems();
}

function fcItems() {
  fc_list = document.getElementById("fc_list");
  innerHTML = "";
  for (item in cart) {
    actual_item = cart[item];
    innerHTML += `
        <div class="fc_item">
            <img class="fc_item_img" src="${actual_item[0][0]}">
            <div class="fc_item_det">
            <h3>${actual_item[0][1]}</h3>
            <p>${actual_item[0][2]} X ${actual_item[1]}</p>
            </div>
            <div class="fc_item_btns">
            <button class="fc_item_btn" onclick="add_to_cart(${item})">
                Add
            </button><br>
            <button class="fc_item_btn" onclick="remove_cart(${item})">
            Remove
            </button>
            </div>
        </div>
        `;
  }
  if (innerHTML == "") {
    innerHTML = "<h2>Your cart is empty, hope you are hungry</h2>";
  }
  fc_list.innerHTML = innerHTML;
}

function addItem(sub_items) {
  item = sub_items.id;
  item_type = item.slice(0, -2);
  if (!(`${item}` in cart)) {
    cart[`${item}`] = [items[`${item_type}`][`${item}`], 1];
  } else {
    cart[`${item}`][1] += 1;
  }
  console.log(cart);
}
function removeItem(sub_items) {
  item = sub_items.id;
  if (`${item}` in cart) {
    cart[`${item}`][1] -= 1;
    if (cart[`${item}`][1] == 0) {
      delete cart[`${item}`];
    }
  }
  console.log(cart);
}

function showItems() {
  var innerhtml = "";
  for (item_type in items) {
    innerhtml = "";
    for (sub_items in items[`${item_type}`]) {
      var item_prop = items[`${item_type}`][`${sub_items}`];
      innerhtml += `<div class="item" id="${sub_items}">
                            <img class="item_img" src="${item_prop[0]}">
                            <p class="item_name">${item_prop[1]}</p>
                            <p class="item_price">${item_prop[2]} Rs</p>
                            <p class="item_type">${item_prop[3]}</p>
                            <div class="item_btns">
                                <button class="item_btn" id="add" onclick="addItem(${sub_items})">
                                    Add
                                </button>
                                <button class="item_btn" id="remove" onclick="removeItem(${sub_items})">
                                    Remove
                                </button>
                            </div>
                          </div>`;
    }
    document.getElementById(`${item_type}_items`).innerHTML = innerhtml;
  }
}

function changeItems(menu) {
  let items_list = document.getElementsByClassName("items_list");
  let item_list_btns = document.getElementsByClassName("item_list_btns");
  for (const item of items_list) {
    item.style.display = "none";
  }
  for (const item of item_list_btns) {
    item.style.backgroundColor = "#e85d5d";
  }
  document.getElementById(`${menu}`).style.backgroundColor = "#a60505";
  document.getElementById(`${menu}_items`).style.display = "block";
}

function clear_cart() {
  cart = {};
  fcItems();
}

function checkout() {
  var final_amount = 0;
  for (item in cart) {
    final_amount += cart[item][0][2] * cart[item][1];
  }
  if (final_amount == 0) {
    alert("Cart is empty");
  } else {
    document.getElementById("menu").style.display = "none";
    document.getElementById("Check_out").style.display = "block";
    var modal = document.getElementById("cartModal");
    modal.style.display = "none";
    document.getElementById("final").className = final_amount;
    document.getElementById(
      "final"
    ).innerHTML = `Final amount: ${final_amount} rupees`;
    total_price();
  }
}

function go_back() {
  document.getElementById("menu").style.display = "block";
  document.getElementById("Check_out").style.display = "none";
}

let info = {};
let address = [];

function validateForm() {
  var name = document.testForm.name.value;
  var phone = document.testForm.phoneNumber.value;
  var flat = document.testForm.flat.value;
  var locality = document.testForm.locality.value;
  var city = document.testForm.city.value;
  var voucher = document.testForm.voucher_code.value;
  var final_amount = document.getElementById("final").className;
  var error = false;

  if (name == "") {
    error = true;
    alert("Enter a name");
  } else {
    var regex = /^[a-zA-Z\s]+$/i;
    if (regex.test(name) === false) {
      alert("Enter a valid name");
      error = true;
    }
  }
  if (phone == "") {
    error = true;
    alert("Enter a phone number");
  } else {
    var regex = /^\d{10}$/;
    if (regex.test(phone) === false) {
      alert("Enter a valid phone number");
      error = true;
    }
  }
  if (locality == "") {
    error = true;
    alert("Enter a locality");
  } else {
    var regex = /^[a-z\s*]+$/i;
    if (regex.test(locality) === false) {
      alert("Enter a valid locality name");
      error = true;
    }
  }
  if (city == "") {
    error = true;
    alert("Enter a city");
  } else {
    var regex = /^\w+,\s*\d{6}$/i;
    if (regex.test(city) === false) {
      alert("Enter valid city name");
      error = true;
    }
  }

  if (error === true) {
    return false;
  } else {
    info["name"] = name;
    info["phone"] = phone;
    address.push(flat);
    address.push(locality);
    address.push(city);
    info["address"] = address;
    info["voucher"] = voucher;
    info["price"] = final_amount;
    console.log(info);
    exit_page();
    return false;
  }
}
function display_vouch() {
  let checked = event.target.checked;
  let voucher = document.getElementsByClassName("voucher_form")[0];
  if (checked) {
    voucher.style.display = "block";
  } else {
    voucher.style.display = "none";
  }
}
function total_price() {
  var voucher = document.testForm.voucher_code.value;
  voucher = voucher.toUpperCase();
  voucher_codes = ["RJB", "ASD", "HJG", "AFD"];
  final_amount = document.getElementById("final").className;
  if (voucher_codes.includes(voucher)) {
    final_amount = (90 * final_amount) / 100;
  }
  document.getElementById(
    "final"
  ).innerHTML = `Final amount: ${final_amount} rupees`;
}
function exit_page() {
  document.getElementById("Exit_page").style.display = "block";
  document.getElementById("Check_out").className = "greyed";
}
