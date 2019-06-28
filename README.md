# Ingresse-TEST
Development of a REST API which implements GET, PUT, POST, DELETE requests for the management of user information.

## How to setup
The applications needed to run this API are:
- Apache server 2.4
- PHP Version 7.2.6
- MySQL server 10.1.33-MariaDB

The API file have to be located in an folder named "api" and must be together to the "db.php" and "user.php" since these are essential for the API to work.

## How to run this API
This API is designed to excecute different actions according to the method used in the request (POST, GET, PUT, DELETE).

### With a POST request:
When sending data with a POST request, it will add a new user to the database. In order to do this, the API will ask for the following data about the user: name, lastname, age, profession, id, address, marital status, nationality and birthday. All those are identified in the API as:
-name="name"
-lastname="lastname"
-age="age"
-profession="profession"
-Id number="id"
-address="address"
-marital status="m_status"
-nationality="nationality"
-birthday="birthday"