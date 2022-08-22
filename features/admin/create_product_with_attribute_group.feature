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
      | Custom length attribute |
      | Custom color attribute  |

  @ui @javascript
  Scenario: Adding attribute group to the product
    When I want to modify the "44_Magnum" product
    And I open "attributes" tab
    And I select attribute group
    And I press the "Add attributes" button
    And I set its "Custom length attribute" attribute to "short"
    And I set its "Custom color attribute" attribute to "red"
    And I save product changes
    Then I should be notified that it has been successfully edited
    And attribute "Custom length attribute" of product "44 Magnum" should be "short"
    And attribute "Custom color attribute" of product "44 Magnum" should be "red"
