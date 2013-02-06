require 'securerandom'

class User
  attr_accessor :username, :password
  def initialize username, password
    @salt = SecureRandom.hex(16)
    @username = username
    @password = password
  end
end