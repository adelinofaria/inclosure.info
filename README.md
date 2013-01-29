inclosure.info
==============

Password management service.

Avaliable requests for API.

Requests
/users
  GET     --
  POS     Register User
  PUT     --
  DELETE  --

/users/1
  GET     User Information
  POS     --
  PUT     Update user information
  DELETE  Delete user

/passwords
  GET     Owned password list
  POS     Save new password
  PUT     --
  DELETE  --

/passwords/1
  GET     Password info
  POS     --
  PUT     Update password
  DELETE  Delete password

Minimum parameters for user creation 
{"email":"email","password":"password"}

Minimum parameters for password creation 
{"name":"domain.com","username":"name","password":"password"}
