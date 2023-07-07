<?php

class DIContainer {
  private array $entries = array();

  public function __construct(array $entries) {
    foreach ($entries as $entrie) {
      if (!array_key_exists($entrie, $this->entries)) {
        $this->entries[$entrie] = new $entrie($this);
      }
    }
  }

  public function get(string $id) {
    if (array_key_exists($id, $this->entries)) {
      return $this->entries[$id];
    }

    throw new Exception("injection $id not found");
  }
}