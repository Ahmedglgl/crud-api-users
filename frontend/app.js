const peopleList = document.getElementById('people');
var baseURL = "http://localhost:8080/persons/";


const getBaseURL = () => {
  // Get the base URL depending on the environment from the file getapilink.php in the root folder
  fetch('getapilink.php')
  .then(response => response.text())
  .then(data => {
    baseURL = data;
  })
  .catch(error => {console.error(error)})
  
  
}

window.onload = () => {
getBaseURL();
}



// Function to retrieve all people from the API
const getAllPeople = () => {
  fetch(baseURL, {
    headers: {
      "Content-Type": "application/json"
    },
  })
  .then(response => response.json())
  .then(data => {
      // Loop through the array of people and add them to the list
      data.forEach(person => {
        let personRow = document.createElement('tr');
        personRow.innerHTML = `
          <td>${person.id}</td>
          <td>${person.name}</td>
          <td>${person.age}</td>
          <td>${person.email}</td>
          <td>${person.gender ? "male" : "female"}</td>
          <td>
            <button class="btn btn-danger" onclick="deletePerson(${person.id})">Delete</button>
            <a class="btn btn-warning" href="edit.html?id=${person.id}">Update</a>     
          </td>
        `;
        peopleList.appendChild(personRow);
      });
    })
    .catch(error => {console.error(error)})
}


// Function to add a person to the API
const addPerson = () => {
  // Get the values from the form
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var age = document.getElementById('age').value;
  var gender = document.getElementById('gender').value;

  

  // Create a new person object
  const newPerson = {
    name: name,
    email: email,
    age: age,
    gender:gender
  }

  // Send the POST request to the API
  fetch(baseURL, {
    method: 'POST',
    headers: {
          "Content-Type": "application/json"
    },
    body: JSON.stringify(newPerson)
  })
  .then(response => response.json())
  .then(data => {
    window.location = 'index.html';
  })
  .catch(error => {console.error(error)})
}

// Function to get a person by their ID
const ShowPerson = (id) => {
  fetch(baseURL+id,{
    headers: {
          "Content-Type": "application/json"
    },
  })
  .then(response => response.json())
  .then(data => {
    // Loop through the array of people and add them to form
    data.forEach(person => {
      document.getElementById('name').value = person.name;
      document.getElementById('email').value = person.email;
      document.getElementById('age').value = person.age;
      document.getElementById('gender').value = person.gender;
    });
  })
  .catch(error => {console.error(error)})
}
        


// Function to delete a person by their ID
const deletePerson = (id) => {
  fetch(baseURL+id,{
    method: 'DELETE',
  })
  .then(response => response.json())
  .then(data => {
    // Refresh the list of people
    peopleList.innerHTML = '';
    getAllPeople()
  })
  .catch(error => {console.error(error)})
}

// Function to update a person by their ID
const updatePerson = (id) => {

    // Get the values from the form
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var age = document.getElementById('age').value;
    var gender = document.getElementById('gender').value;
  
    
  
    // Create a edited person object
    const EditedPerson = {
      name: name,
      email: email,
      age: age,
      gender:gender
    }

    fetch(baseURL+id,{
      method: 'PUT',
    headers: {
          "Content-Type": "application/json"
    },
    body: JSON.stringify(EditedPerson)
  })
  .then(response => response.json())
  .then(data => {
    window.location = 'index.html';
  })
  .catch(error => {console.error(error)})
}
