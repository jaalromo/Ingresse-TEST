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
- name="name"
- lastname="lastname"
- age="age"
- profession="profession"
- Id number="id"
- address="address"
- marital status="m_status"
- nationality="nationality"
- birthday="birthday"

After the request is made, it will check that none of these values is empty, and in case there is an empty value it will return:
```
{"message":"empty values are not allowed"}
```
If there are no empty values but the id number to be inserted already exist in the database table, it will be returned:
```
{"message":"A record with this ID already exists"}
```
Finally, if there are no empty values and the id number to be inserted doesn't exist in the database table, it will be returned a message and all the user's information that has just been inserted in the database
```
{"message":"New record successfully created","user":{"name":"user's name","lastname":"user's lastname","age":"user's age","profession":"user's profession","id_Number":"user's id number","address":"user's address","marital_status":"user's marital status","nationality":"user's nationality","birthday":"user's birthday date"}}
```

### With a GET request:
When retrieving data with GET request, it will search for the user users id number in the database table. In order to do this, the API will ask only for the user's id number, which is identified in the API with the word 'id', and will return all the information related it.

If the id number doesn't exist in the database table, it will be returned this message:
```
{"message":"Such ID isn't registered"}
```
in the other hand, if the id number exista in the database table, it will be returned a message and all the user's information related to it:
```
{"message":"Record found","user":{"name":"user's name","lastname":"user's lastname","age":"user's age","profession":"user's profession","id_Number":"user's id number","address":"user's address","marital_status":"user's marital status","nationality":"user's nationality","birthday":"user's birthday date"}}
```


### With a DELETE request:
When deleting data with DELETE request, it will search for the user users id number in the database table. In order to do this, the API will ask only for the user's id number, which is identified in the API with the word 'id', and will delete all the information related it.

If the id number doesn't exist in the database table, it will be returned this message:
```
{"message":"The selected ID doesn't exist"}
```
In the other hand, if the id number exists in the database table, it will be deleted all the user's information related to it and will return a message:
```
{"message":"Record successfully deleted"}
```
