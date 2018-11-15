function getApi() {
  fetch('http://slimblog.api/api/categories')
    .then(res => res.json())
    .then(data => {
      data.forEach(category => {
        output += `
                        <div>
                            <h3> ${category.cat_name} </h3>
                            <hr>
                        </div>
                        `;
      });
      document.getElementById('output').innerHTML = output;
    });
}

getApi();
