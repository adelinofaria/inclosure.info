require_relative '../application/model/password'
require_relative '../application/model/user'
require 'yaml'

=begin
rspec.configure do |config|

  # Use color on STDOUT
  config.color.enabled = true

  # Use color not on in STDOUT but also in pagers and files
  config.tty = true

  # Use the specied formatter
  config.formatter = :documentation # :documentation, :progress, :html, :textmate

end
=end
