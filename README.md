#### Movies rent API v0.1

**Install dependencies:** `composer update`

**Install jwt library:** `composer require tymon/jwt-auth`

**Configure jwt library:** `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`

**Generate jwt secret key:** `php artisan jwt:secret`

##### **Instance example** http://movies-rent.herokuapp.com/public/api


### API Documentation
# Users
Used to create/update user data.

**URL** : `/api/user/store`

**Method** : `POST`

**Auth required** : NO

**Data constraints**
```json
{
    "email": "[valid email address]",
    "password": "[Min 8 characters and must contain at least 1 number, 1 symbol]",
    "name": "[name in plain text]",
    "lastname": "[lastname in plain text]",
    "age": "[number between 10 and 150]",
    "role": "[number between 1 and 2]"
}
```
**Data example**
```json
{
    "username": "johndoe1@mail.com",
    "password": "ab@cd1234",
    "name": "John",
    "lastname": "Doe",
    "age": "40",
    "role": "2"    
}
```
## Success Response
**Code** : `200 OK`

## Error Response
**Condition** : If any field does not pass validation.
**Code** : `400 BAD REQUEST`
**Content** :
```json
{
    'status'=>'validation_error',
    'errors'=>[
        'name'  =>  'Name is required.'
    ]
}
```

