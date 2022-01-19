@product_attribute_group_plugin
Feature: Create attribute group
  In order to manage product attributes
  As an Administrator
  I want to be able to add new attribute groups

  Background:
    Given I am logged in as an administrator
    And the store operates on a single channel in "United States"

  @ui
  Scenario: Create empty group
    When I want to add a new attribute group
    And I set its name to "Custom Attribute Group"
    And I add it
    Then I should be notified that the group has been created
    And the group "Custom Attribute Group" should appear in the store

  @ui
  Scenario: Create group with attributes
    Given there is created text attribute "Custom Length Attribute" with code "CUSTOM_LENGTH_ATTRIBUTE"
    And there is created text attribute "Custom Color Attribute" with code "CUSTOM_COLOR_ATTRIBUTE"
    When I want to add a new attribute group
    And I set its name to "Attribute Group with attributes"
    And I assign this attributes to group:
      | CUSTOM_LENGTH_ATTRIBUTE |
      | CUSTOM_COLOR_ATTRIBUTE  |
    And I add it
    Then I should be notified that the group has been created
    And the group "Attribute Group with attributes" should appear in the store
    And these attributes should be visible next to the group "Attribute Group with attributes":
      | Custom Color Attribute  |
      | Custom Length Attribute |