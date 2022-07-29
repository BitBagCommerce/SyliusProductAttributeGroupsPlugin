@product_attribute_group_plugin
Feature: Create attribute group
  In order to manage product attributes
  As an Administrator
  I want to be able to add new attribute groups

  Background:
    Given I am logged in as an administrator
    And the store operates on a single channel in "United States"
    And the store has a product "44 Magnum"
    And the store has a product attribute group "myGroup" with attributes:
      | CUSTOM_LENGTH_ATTRIBUTE |
      | CUSTOM_COLOR_ATTRIBUTE  |

  @ui
  Scenario: Seeing message about no new attributes selected
    Given I want to modify the "44_Magnum" product
    And I want to open attributes tab
    Then I should see button to add AttributesGroup
