require 'spec_helper'

describe User do
  before :each do
    @user = User.new "username", "password"
  end

  describe "#username" do
    it "returns the correct username" do
      @user.username.should == "username"
    end
  end

  describe "#password" do
    it "returns the correct password" do
      @user.password.should == "password"
    end
  end

  describe "#new" do
    it "takes two parameters and returns a User object" do
      @user.should be_an_instance_of User
    end
    it "takes array of parameters and returns a User object" do |array|
      # add other parameters
      @user.should be_an_instance_of User
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

  describe "#addPassword" do
    it "should save the password" do
    end
    it "should have the correct amount after the sum" do
    end
  end

  describe "#removePassword" do
    it "should do nothing in case it doesn't belong to the user" do
    end
    it "should remove the password from the array" do
    end
    it "should have the correct count" do
    end
  end

  describe "#changePassword" do
    it "should have the correct old password" do
    end
    it "should encode the new password" do
    end
    it "should match the new password" do
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