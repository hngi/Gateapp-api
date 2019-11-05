## OUTLINE IMPORTANT INFO ABOUT THE TASK ASSIGNED TO US

## Schema

* table `notification`
* columns `id`, `resident_id`, `visitor_id`, `home_id`, `type` => (`visitor_arrival` or `gateman_invite`), `title`, `body`, `read_at`, `resident_id`, `visitor_id`, `home_id`
                            

## super admin login response

```json
{
    "success": true,;lk
    "message": "Admin Login Successful!",
    "user": {
        "id": 32,
        "name": "Super Admin Default",
        "username": "@default",
        "phone": "07060959269",
        "email": "super_admin@gateguard.co",
        "image": "noimage.jpg",
        "user_type": "super_admin",
        "duty_time": null,
        "device_id": null,
        "access": 1,
        "created_at": null,
        "updated_at": null
    },
    "user_type": "super_admin",
    "image_link": "https://res.cloudinary.com/getfiledata/image/upload/",
    "image_small_view_format": "w_200,c_thumb,ar_4:4,g_face/",
    "token": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW5cL2FkbWluIiwiaWF0IjoxNTcyNTEwMjk1LCJleHAiOjE1NzI3MjYyOTUsIm5iZiI6MTU3MjUxMDI5NSwianRpIjoiQUtWRnJvSUNPcENOZzlsdiIsInN1YiI6MzIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.lU76INo64t0ijg1dlOnYBN2CUoY146m2uVmKEGLRaJA",
    "token_type": "bearer",
    "expires_in(minutes)": 3600
}
```

### admin login details

```json
{
    "success": true,
    "message": "Admin Login Successful!",
    "user": {
        "id": 44,
        "name": null,
        "username": null,
        "phone": null,
        "email": "goalsetterapp@gmail.com",
        "image": "noimage.jpg",
        "user_type": "estate_admin",
        "duty_time": null,
        "device_id": null,
        "access": 1,
        "created_at": "2019-10-29 16:25:53",
        "updated_at": "2019-10-29 16:25:53"
    },
    "user_type": "estate_admin",
    "image_link": "https://res.cloudinary.com/getfiledata/image/upload/",
    "image_small_view_format": "w_200,c_thumb,ar_4:4,g_face/",
    "token": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW5cL2FkbWluIiwiaWF0IjoxNTcyNTEwNjM1LCJleHAiOjE1NzI3MjY2MzUsIm5iZiI6MTU3MjUxMDYzNSwianRpIjoiaDFEclRUVjRWQWRhVUtXZCIsInN1YiI6NDQsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.cRZ_woNg7K2IR01s6Y85gClDuCtZoocKEBtCumy9Mkc",
    "token_type": "bearer",
    "expires_in(minutes)": 3600
}
```
