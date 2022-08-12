@product_attribute_group_plugin
Feature: Create attribute with assigned group
  In order to create new attribute
  As an Administrator
  I want to be able to assign group to attribute

  Background:
    Given I am logged in as an administrator
    And the store operates on a single channel in "United States"
    And there is created group with "Custom Group" name
    And there is created group with "Custom Color Group" name

  @ui
  Scenario: Create attribute with assigned group
    When I want to create a new text product attribute
    And I name it "Custom Attribute" in "en_US"
    And I specify its code as "CUSTOM_ATTRIBUTE"
    And I assign group named "Custom Group" to it
    And I add it
    Then this product attribute should have assigned group with name "Custom Group"

  @ui
  Scenario: Change attribute group
    Given there is created text attribute "Custom Attribute" with code "CUSTOM_ATTRIBUTE_CODE" and assigned group "Custom Group"
    When I want to edit attribute with code "CUSTOM_ATTRIBUTE_CODE"
    And I assign group named "Custom Color Group" to it
    And I save my changes
    Then this product attribute should have assigned group with name "Custom Color Group"
