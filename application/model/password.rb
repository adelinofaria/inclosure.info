require 'securerandom'

class Password
  attr_accessor :name, :username, :password
  def initialize name, username, password
    @salt = SecureRandom.hex(16)
    @name = name;
    @username = username
    @password = password
  end
end