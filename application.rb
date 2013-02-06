require 'sinatra'

get '/user' do
  "hi"
end

post '/user' do
  "hi"
end

put '/user' do
  "hi"
end

delete '/user' do
  "hi"
end

=begin

post '/users' do
end

put '/users' do
  status 404
  headers \
    "Allow"   => "BREW, POST, GET, PROPFIND, WHEN",
end

get '/users/:id' do |n|
  "Hello #{n}!"
end

get '/passwords' do
  "['password','password']"
end

get '/passwords/:id' do
  # matches "GET /hello/foo" and "GET /hello/bar"
  # params[:name] is 'foo' or 'bar'
  "Hello #{params[:id]}!"
end

get '/' do
  #.. show something ..
  "Hello World!"
end

post '/' do
  #.. create something ..
end

put '/' do
  #.. replace something ..
end

patch '/' do
  #.. modify something ..
end

delete '/' do
  #.. annihilate something ..
end

options '/' do
  #.. appease something ..
end

not_found do
  'This is nowhere to be found.'
end

error 403 do
  'Access forbidden'
end

get '/secret' do
  403
end

error 400..510 do
  'Boom'
end
=end