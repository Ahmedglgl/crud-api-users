# User-Friendly Frontend for a RESTful API with CRUD Operation

Author: Ahmed Galal  
ID: 203001

## How to Run

1. Clone or download the project files.
2. Navigate to the project directory.
3. Run the following command to start the containers:
4. Wait for the containers to start. This may take a few minutes.
5. Access the frontend at [http://localhost:9090](http://localhost:9090).
6. Access the PHPMyAdmin at [http://localhost:7070](http://localhost:7070).

## API Endpoints

Use the following endpoints to interact with the API:

1. `GET http://localhost:8080/persons` - List all persons
2. `GET http://localhost:8080/persons/{ID}` - Show person
3. `POST http://localhost:8080/persons` - Create person
4. `PUT http://localhost:8080/persons/{ID}` - Update person
5. `DELETE http://localhost:8080/persons/{ID}` - Delete person

## Frontend Pages

Use the following pages to interact with the frontend:

1. `http://localhost:9090` - List all persons
2. `http://localhost:9090/add.html` - Create person
3. `http://localhost:9090/edit.html?id={ID}` - Edit person
