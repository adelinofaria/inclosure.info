require './application'

set :database, ENV['localhost'] || 'postgres://localhost/[inclosure.info]'

run Sinatra::Application