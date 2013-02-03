require "test/unit"

class UserTest < Test::Unit::TestCase
  def test_hi
    s = "Hello, World!"
    assert_equal(13, s.length)
    assert_equal("", s)
  end
end