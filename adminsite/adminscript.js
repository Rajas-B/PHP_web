document.addEventListener("DOMContentLoaded", function () {
  changeItems("pizza");

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
