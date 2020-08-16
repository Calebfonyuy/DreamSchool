# DREAM SCHOOL REST API (DSCRA)

## Description
Backend api aimed at data management for DSC user applications(web and mobile). It handles data management through various api calls from the applications.

## Routes and data formats
### Authentication
> __Login route__: **_\<hostname\>/api/login_**
- Incoming data format
    ```
        {
          "username": "your_username_here",
          "password": "your_secret_password"
        }
    ```
- Response format
    - Authentication succeeded
    ```
    {
        "status": 1,
        "token": "A long security token"
    }
    ```
    - Authentication Failed
    ```
    {
        "status": 0,
        "errors": [key-value array of errors]
    }
    ```
Note should be taken that the authentication route is the only route that is available for use without prior authentication. Hence, the API should, prior to its usage have at least one user recorded in the database. 

> __Logout route__: **_\<hostname\>/api/logout_**

### Teacher Management routes
* List all Teachers
> __GET__  **_\<hostname\>/api/teacher_**

* Save a new Teacher
> __POST__  **_\<hostname\>/api/teacher_**

Data format for both post and get routes is as follows:

```
{
    "first_name": "alphanumeric field",
    "last_name": "alphanumeric field",
    "birthday": "date field",
    "gender" : "masculin or feminin",
    "contact": "alphanumeric field",
    "email": "alphanumeric field",
    "address": "alphanumeric field",
    "qualification": "alphanumeric field",
    "username": "alphanumeric field not less than 4 characters and should not clash with already existing values",
    "password": "alphanumeric field not less than 6 characters"
}
```
Error Response format for post route:
```
{
    "status": 0,
    "errors": [key value array of with field name and associated error],
    "data": [key value array of received data]
}
```
Save success response format:
```
{
    "status": 1,
    "data": [Data of newly saved teacher with associated id]
}
```