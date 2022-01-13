@create_group
Feature: Create attribute group
  In order to manage product attributes
  As an Administrator
  I want to be able to add new attribute groups

  Background:
    Given I am logged in as an administrator

  @ui
  Scenario: Create empty group
    When I want to add a new attribute group
    And I set its name to "Custom Attribute Group"
    And I add it
    Then the group "Custom Attribute Group" should appear in the store
