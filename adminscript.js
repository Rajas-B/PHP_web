document.addEventListener("DOMContentLoaded", function () {
  changeItems("pizza");
  showItems();

  var addbtn = document.getElementById("addbutton");

  var profbtn = document.getElementById("profpic");

  var closebtn = document.getElementsByClassName("close-btn")[0];

  var span = document.getElementsByClassName("close")[0];

  addbtn.onclick = function () {
    add_to_menu.style.display = "block";
  };

  span.onclick = function () {
    add_to_menu.style.display = "none";
  };

  profbtn.onclick = function () {
    addbutton.style.display = "none";
    document.getElementById("sidebar").style.width = "250px";
  };

  closebtn.onclick = function () {
    addbutton.style.display = "block";
    document.getElementById("sidebar").style.width = "0";
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
                                  <button class="item_btn" id="Edit" onclick="addItem(${sub_items})">
                                      Edit
                                  </button>
                                  <button class="item_btn" id="Remove" onclick="removeItem(${sub_items})">
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
