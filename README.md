#[api.inclosure.info](http://api.inclosure.info)
==============

###Password management service.

##Avaliable requests for API.

Requests
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
