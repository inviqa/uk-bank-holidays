Feature: Check if a date is a bank holiday in the UK

  Scenario: A date is a bank holiday in a region
    Given the "2019-12-24" is a bank holiday in "england-and-wales"
    When a developer checks if the date "2019-12-24" is bank holiday in "england-and-wales"
    Then the result should be true

  Scenario: A date is not a bank holiday in a region
    Given the "2019-03-03" is not a bank holiday in "scotland"
    When a developer checks if the date "2019-03-03" is bank holiday in "scotland"
    Then the result should be false
