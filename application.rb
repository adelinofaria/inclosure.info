require 'sinatra'

get '/' do
  "Hello World!"
end

get '/passwords' do
  "['password','password']"
end