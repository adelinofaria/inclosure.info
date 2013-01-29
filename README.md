#[api.inclosure.info](http://api.inclosure.info)
==============

### Password management service.

## Goals

* Basic API **[DONE]** - Initial api to development and storage of passwords.
* Web Interface - Basic web interface with responsive design for desktop and mobile.
* SSL - Implement SSL for safe trasactions between server-application.
* iOS and Android applications. **[HOLD]**
* Web browsers extensions. **[HOLD]**

## Avaliable requests for API

```
  ------------------------------------------------------------------------------------------------
 |                   GET                  POST                PUT                DELETE           |
 |------------------------------------------------------------------------------------------------|
 | /users        |   --                   Register user       --                 --               |
 |---------                                                                                       |
 | /users/1      |   User information     --                  Update user        Delete user      |
 |---------                                                                                       |
 | /passwords    |   Owned password list  Save new password   --                 --               |
 |---------                                                                                       |
 | /passwords/1  |   Password info        --                  Update password    Delete password  |
 |---------                                                                                       |
  ------------------------------------------------------------------------------------------------
```

Minimum parameters for user creation

{"email":"email","password":"password"}

Minimum parameters for password creation

{"name":"domain.com","username":"name","password":"password"}
