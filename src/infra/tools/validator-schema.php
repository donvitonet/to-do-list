<?php

class ValidatorSchema
{
  public function validate($data = array(), $rules = array(), $required = array())
  {
    $results = filter_var_array($data, $rules, true);
    $results = $this->removeOmittedFields($data, $results);

    if (array_search(null, $results) !== false) {
      throw new Exception('Invalid data');
    }

    if ($this->requiredDataMissing($results, $required)) {
      throw new Exception('Required data missing');
    }

    if ($this->additionalData($data, $rules)) {
      throw new Exception('Invalid additional data');
    }
  }

  private function removeOmittedFields(array $data, array $results)
  {
    foreach ($results as $key => $value) {
      if (!is_null($value)) {
        continue;
      }

      if (array_key_exists($key, $data)) {
        continue;
      }

      unset($results[$key]);
    }

    return $results;
  }

  private function requiredDataMissing(array $results, array $required)
  {
    $resultsKeys = array_keys($results);
    $diff = array_diff($required, $resultsKeys);
    return !empty($diff);
  }

  private function additionalData($data, $rules)
  {
    $dataKeys = array_keys($data);
    $rulesKeys = array_keys($rules);
    $diff = array_diff($dataKeys, $rulesKeys);
    return !empty($diff);
  }
}