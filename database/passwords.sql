CREATE TABLE passwords (
  id serial PRIMARY KEY,
  userId integer NOT NULL,
  salt varchar(16) NOT NULL,
  name varchar(255) DEFAULT 'New Password',
  url varchar(255) DEFAULT '',
  username varchar(255) DEFAULT 'username',
  password varchar(255) DEFAULT 'password',
  tags varchar(255) DEFAULT '',
  notes text DEFAULT '',
  htmlFields varchar(255) DEFAULT '',
  attachments varchar(255),
  createdAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updatedAt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);