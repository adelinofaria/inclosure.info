require 'spec_helper'

describe Password do
  before :each do
    @password = Password.new "name", "username", "password"
  end

  describe "#new" do
    it "takes two parameters and returns a Password object" do
      @password.should be_an_instance_of Password
    end
  end

  describe "#username" do
    it "returns the correct username" do
      @password.username.should == "username"
    end
  end

  describe "#password" do
    it "returns the correct password" do
      @password.password.should == "password"
    end
  end

  describe "#save" do
    it "should save if minimum parameters are met" do
    end
  end

  describe "#delete" do
    it "should delete the object" do
    end
  end

  describe "#inJson" do
    it "should return a string" do
    end
    it "should return a json structured" do
    end
    it "should return all public information" do
    end
  end
end