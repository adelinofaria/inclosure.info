inclosure.info
==============

Password management service.

Avaliable requests for API.

Requests
/users
  GET     --
  POST    Register User
  PUT     --
  DELETE  --

/users/1
  GET     User Information
  POST    --
  PUT     Update user information
  DELETE  Delete user

/passwords
  GET     Owned password list
  POST    Save new password
  PUT     --
  DELETE  --

/passwords/1
  GET     Password info
  POST    --
  PUT     Update password
  DELETE  Delete password

Minimum parameters for user creation 
{"email":"email","password":"password"}

Minimum parameters for password creation 
{"name":"domain.com","username":"name","password":"password"}
