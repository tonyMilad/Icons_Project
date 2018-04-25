# API
#### database = icons
#### collation = utf8_general_ci 
#### Base-URL: [http://localhost:8000](http://localhost:8000)

## Creating User

**POST** `[base-url]api/v1/register`

##### Params:
- String 'username'
- String 'email'
- String 'pasword'


> ### email not duplicated
#### Headers:
Response `200 OK`
#### The output will be like
```json
{
	"message": "success",
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
}
```

> ### email duplicated
#### Headers:
Response `409 conflict`
### The output will be
```json
{
   "message":"failed"
}
```

----------

## Login

**POST** `[base-url]/api/login`

##### Params:
- String 'Username'
- String 'password'

> ### PIN is correct and number not validated yet
#### Headers:
Response `200 OK`
### The output will be
```json
{
	"message": "success",
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
}
```

> ### username or password does not match
#### Headers:
Response `406 Not Acceptable`
### The output will be
```json
{
   "message":"failed"
}
```


## CRUD URL's

## Insert URL
**POST** `[base-url]/api/v1/urls`

##### Params:
- String 'url'
- String 'token'

#### Headers:
Response `200 OK`
### The output will be
```json
{
	"message": "success",
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
}
```

#### Headers:
Response `409 Conflict`
### The output will be
```json
{
	"message": "Faild"
}
```

----------

## Get All URL

**GET** `[base-url]/api/v1/urls`

##### Params:
- String 'token'

#### Headers:
Response `200 OK`
### The output will be
```json
{
    "status": "success",
    "message": "success",
    "Urls": [
        {
            "id": 1,
            "user_id": 1,
            "url": "www.url.com",
            "created_at": "2018-04-25 23:01:03",
            "updated_at": "2018-04-25 23:01:03"
        },
        {
            "id": 3,
            "user_id": 1,
            "url": "www.url.com",
            "created_at": "2018-04-25 23:18:12",
            "updated_at": "2018-04-25 23:18:12"
        }
    ],
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvdjEvdXJscyIsImlhdCI6MTUyNDYxMjc5NiwiZXhwIjoxNTI0NjE2Mzk2LCJuYmYiOjE1MjQ2MTI3OTYsImp0aSI6IjNoN1RSVHYwMGw2a3BLSE4ifQ.qFQkSNyI3wsZUiG9gZZgMIThyvoxPb7xcuXBeXxy2Vc"
}
```

> 
#### Headers:
Response `406 Not Acceptable`
### The output will be
```json
{
	"message": "Something went worng"
}
```

----------
## Get URL with ID

**GET** `[base-url]/api/v1/urls?id={id}&&token={token}`

##### Params:
- String 'id'
- String 'token'

#### Headers:
Response `200 OK`
### The output will be
```json
{
    "status": "success",
    "message": "success",
    "Urls": [
        {
            "id": 3,
            "user_id": 1,
            "url": "www.url.com",
            "created_at": "2018-04-25 23:18:12",
            "updated_at": "2018-04-25 23:18:12"
        }
    ],
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvdjEvdXJscyIsImlhdCI6MTUyNDYxMjMwNywiZXhwIjoxNTI0NjE1OTA3LCJuYmYiOjE1MjQ2MTIzMDcsImp0aSI6ImpERW9rQ2lIWGI2dnVOZmwifQ.VJhNN9NU8l89bXLmz39m5XUQIXPhFFnRkY-dWDU5e54"
}
```

#### Headers:
Response `406 Not Acceptable`
### The output will be
```json
{
	"message": "something went worng"
}
```

----------
## Delete URL

**POST** `[base-url]/api/v1/urls`

##### Params:
- String 'id'
- String 'token'

> ### Correct PIN
#### Headers:
Response `200 OK`
### The output will be
```json
{
	"message": "success",
	"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
}
```
#### Headers:
Response `406 Not Acceptable`
### The output will be
```json
{
	"message": "something went worng"
}
```

----------

## update URL

**POST** `[base-url]/api/v1/urls`

##### Params:
- String 'token'
- String 'id'

#### Headers:
Response `200 OK`
### The output will be
```json
{
    "status": "success",
    "message": "success updated",
    "url": {
        "id": 3,
        "user_id": 1,
        "url": "www.facebook.com",
        "created_at": "2018-04-24 23:18:12",
        "updated_at": "2018-04-24 23:34:42"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvdjEvdXJscyIsImlhdCI6MTUyNDYxMjkwMiwiZXhwIjoxNTI0NjE2NTAyLCJuYmYiOjE1MjQ2MTI5MDIsImp0aSI6ImRkR2ptTW5aMHc5dmZWZUwifQ.O5TR6JkssiCV9xHqRTOaewfVw4sVEq3PNWUWooSc_AA"
}
```

#### Headers:
Response `406 Not Acceptable`
### The output will be
```json
{
	"message": "somthing went woring"
}
```
