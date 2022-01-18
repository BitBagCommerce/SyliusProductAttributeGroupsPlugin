@product_attribute_group_plugin
Feature: Create attribute with assigned group
  In order to create new attribute
  As an Administrator
  I want to be able to assign group to attribute

  Background:
    Given I am logged in as an administrator
    And the store operates on a single channel in "United States"

  @ui
  Scenario: Create attribute with assigned group
    Given There is created group with name "Custom Group"
    When I want to create a new "text" product attribute
    And I name it "Custom Attribute" in "en_US"
    And I specify its code as "CUSTOM_ATTRIBUTE"
    And I assign group named "Custom Group" to it
    And I add it
    Then this product attribute should have assigned group with name "Custom Group"

#    Update:      * @Given the store has a :type product attribute :name with code :code