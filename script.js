function ajax(url, receive) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) { //readyState 4 = request finished and response is ready // and status is OK (no error message)
      receive(this.responseText); //run user defined function when server has responded and not ^
    }
  };
  xmlhttp.open("GET", url, true); //first parrameter experting an URL // The server to be contacted
  xmlhttp.send(); //contacting server
}

function highlight(n, id) {
  var count = document.getElementById("count_" + id); // referes to (singlePost.php, l. 44)
  count.innerHTML = n;

  if (n==0) {
    count.style.color="black";
  } else if (n<0) {
    count.style.color="red";
  } else if (n>0){
    count.style.color="green";
  }
}

//update() runs when server has a XMLHttpResponse
function update(n) {
  var data = JSON.parse(n); //converts data (n) from json_encode to JavaScript object which can be handled in a foreach - resaults in semi-live functionality since every comment is updated
  data.forEach(element => { //for every index is an array which contains the two elements
    highlight(element['amount'], element['id']); //multidimensional 
  });
}

function save(n, id, postId) {
ajax('rating.php?count=' + n + '&id=' + id + '&postId=' + postId, update); //update() runs when server has a XMLHttpResponse
}
